let config = require("./config.js"),
    fs = require("fs"),
    app = require("express")(),
    server,
    { CronJob } = require("cron"),
    getProtocolOptions = () =>
        config.port === 8443
            ? {
                  protocol: "https",
                  protocolOptions: {
                      key: fs.readFileSync(config.ssl.key),
                      cert: fs.readFileSync(config.ssl.cert),
                  },
              }
            : {
                  protocol: "http",
              },
    options = getProtocolOptions(),
    Redis = require("redis"),
    RedisClient = Redis.createClient(),
    axios = require("axios");

if (options.protocol === "https")
    server = require("https").createServer(options.protocolOptions, app);
else server = require("http").createServer(app);

server.listen(config.port);
console.log("Сервер запущен: " + config.domain + ":" + config.port);

global.io = require("socket.io")(server);

RedisClient.subscribe("live");
RedisClient.subscribe("updateUser");
RedisClient.subscribe("stats");
RedisClient.subscribe("notify");
RedisClient.subscribe("setItemStatus");
RedisClient.subscribe("newMessage");
RedisClient.subscribe("wheelNewBet");

RedisClient.on("message", async (channel, message) => {
    console.log(`Сообщение из Redis: канал = ${channel}, данные = ${message}`);
    io.sockets.emit(channel, JSON.parse(message));
});

axios.defaults.baseURL = `${config.domain}/api`;

let wheel = {
    timer: null,
    time: 20,
    game: null,
    startRoulette: false,
};

const getWithdraws = () => {
    axios
        .post(`/checkItems`)
        .then((r) => {})
        .catch((err) => console.log(err));
};

setInterval(() => getWithdraws(), 20000);

const updatePrice = new CronJob("30 3 * * *", function () {
    axios
        .get(
            `${config.domain}/api/bot/market?secretKey=${process.env.SECRET_KEY}`
        )
        .then((response) => {
            console.log("Обновили цены");
        })
        .catch((error) => {
            console.error(
                "Ошибка при отправке запроса:",
                error.response ? error.response.data : error.message
            );
        });
});

updatePrice.start();

const randomInteger = (min, max) => {
    let rand = min + Math.random() * (max + 1 - min);
    return Math.floor(rand);
};

const startCheckFake = () => {
    const randomTimer = randomInteger(1, 3); // Фиксированная задержка для следующих фейков

    setTimeout(async () => {
        try {
            const resp = await axios.post(
                `${config.domain}/api/bot/fakeOpen?secretKey=${process.env.SECRET_KEY}`
            );
            console.log("Fake opened:", resp.data);
        } catch (error) {
            console.log("Ошибка фейка:", error);
        }

        startCheckFake(); // Повторный вызов
    }, randomTimer * 1000); // Задержка в 1-3 секунды
};

startCheckFake();

const startRaffle = new CronJob("00 * * * *", function () {
    axios
        .post(
            `${config.domain}/api/bot/RaffleNew?secretKey=${process.env.SECRET_KEY}`
        )
        .then((response) => {
            console.log("Обновили лотерею");
        })
        .catch((error) => {
            console.error(
                "Ошибка при отправке запроса:",
                error.response ? error.response.data : error.message
            );
        });
});
const startRaffleDay = new CronJob("0 13 * * *", function () {
    axios
        .post(
            `${config.domain}/api/bot/RaffleDayNew?secretKey=${process.env.SECRET_KEY}`
        )
        .then((response) => {
            console.log("Обновили лотерею");
        })
        .catch((error) => {
            console.error(
                "Ошибка при отправке запроса:",
                error.response ? error.response.data : error.message
            );
        });
});
const startRaffleWeek = new CronJob("0 0 * * 1", function () {
    axios
        .post(
            `${config.domain}/api/bot/RaffleWeekNew?secretKey=${process.env.SECRET_KEY}`
        )
        .then((response) => {
            console.log("Обновили лотерею");
        })
        .catch((error) => {
            console.error(
                "Ошибка при отправке запроса:",
                error.response ? error.response.data : error.message
            );
        });
});
startRaffle.start();
startRaffleDay.start();
startRaffleWeek.start();

const createDailyPromo = new CronJob("1 0 * * *", async function () {
    try {
        const res = await axios.get(`${config.domain}/api/live/dailyPromo`);
        console.log("Промокод на сегодня:", res.data.code);
    } catch (error) {
        console.error(
            "Ошибка генерации промокода:",
            error.response ? error.response.data : error.message
        );
    }
});

createDailyPromo.start();

io.on("connection", (socket) => {
    const multipliedOnline = () => {
        // const currentHour = new Date().getHours();
        // let multiplier;

        // if (currentHour >= 0 && currentHour < 12) {
        //     multiplier = 3; // 00:00 - 12:00
        // } else if (currentHour >= 12 && currentHour < 20) {
        //     multiplier = 4; // 12:00 - 20:00
        // } else {
        //     multiplier = 3; // 20:00 - 24:00
        // }

        const onlineCount = Object.keys(io.sockets.sockets).length;
        return onlineCount + 121 * 2;
    };

    const updateOnline = () => {
        io.sockets.emit("online", multipliedOnline());
    };

    socket.on("disconnect", () => {
        updateOnline();
    });

    updateOnline();
});

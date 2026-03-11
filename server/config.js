let path = require("path");
let envDir = path.resolve(__dirname, "../.env");

let key = path.resolve(__dirname, "./privkey.pem");
let cert = path.resolve(__dirname, "./fullchain.pem");

require("dotenv").config({
    path: envDir,
});

module.exports = {
    domain: process.env.APP_URL,
    secret_key: process.env.APP_URL,
    port: process.env.APP_HTTPS === "true" ? 8443 : 8081,
    ssl: {
        key: key,
        cert: cert,
    },
};

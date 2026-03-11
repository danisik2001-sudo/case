function getItemRarityClass(rarity = "") {
    let style = "rarity--1";
    rarity = rarity.toLowerCase();

    if (rarity.indexOf("industrial") > -1) {
        style = "rarity--1";
    } else if (rarity.indexOf("mil-spec") > -1) {
        style = "rarity--2";
    } else if (rarity.indexOf("restricted") > -1) {
        style = "rarity--3";
    } else if (rarity.indexOf("classified") > -1) {
        style = "rarity--4";
    } else if (rarity.indexOf("covert") > -1) {
        style = "rarity--5";
    } else if (rarity.indexOf("★") > -1) {
        style = "rarity--6";
    }

    // Если это нож с особенностями "covert"
    if (rarity.indexOf("knife") > -1 && rarity.indexOf("covert") > -1) {
        style = "rarity--6";
    }

    return style;
}

function getNameParts(name) {
    return (name ?? "")
        .split("|")
        .map((n) => n.replace(/(^[^\w\d()]|[^\w\d()]$)/gi, ""));
}

function getItemType(name) {
    const nameParts = getNameParts(name);
    if (nameParts.length === 1) return null;
    return nameParts[0].replace(/StatTrak.*?\s/i, "[ST] ");
}

function getItemName(name) {
    const nameParts = getNameParts(name);
    if (nameParts.length === 1) return nameParts[0];
    return nameParts[1].replace(/\(.+\)$/, "");
}

function getExteriorInsideBrackets(exterior) {
    const match = exterior.includes("-")
        ? exterior.split("-")
        : exterior.split(" ");
    return match[0][0] + match[1][0];
}

function stringTruncate(str, length) {
    let dots = str.length > length ? "..." : "";
    return str.substring(0, length) + dots;
}

function randomInteger(min, max) {
    let rand = min + Math.random() * (max + 1 - min);
    return Math.floor(rand);
}

function morph(int, array) {
    return (
        (array = array || ["товар", "товара", "товаров"]) &&
        array[
            int % 100 > 4 && int % 100 < 20
                ? 2
                : [2, 0, 1, 1, 1, 2][int % 10 < 5 ? int % 10 : 5]
        ]
    );
}

function shuffleArray(array) {
    let currentIndex = array.length,
        randomIndex;

    // While there remain elements to shuffle.
    while (currentIndex > 0) {
        // Pick a remaining element.
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex--;

        // And swap it with the current element.
        [array[currentIndex], array[randomIndex]] = [
            array[randomIndex],
            array[currentIndex],
        ];
    }

    return array;
}

export {
    getItemRarityClass,
    getNameParts,
    getItemType,
    getItemName,
    getExteriorInsideBrackets,
    stringTruncate,
    randomInteger,
    morph,
    shuffleArray,
};

import logoutConfirm from "./script/AuthUser/logoutConfirm.js";
import loginButton from "./script/Guest/loginButton.js";
import registerButton from "./script/Guest/registerButton.js";
import getThisYear from "./script/thisYear.js";
import infoFadeOut from "./script/infoFadeOut.js";
import getNewQuote from "./script/AuthUser/Home/getNewQuote.js";
import searchButton from "./script/AuthUser/Database/searchButton.js";
import sortButton from "./script/AuthUser/Database/sortButton.js";
import posterButton from "./script/AuthUser/Database/posterButton.js";
import paginationLinks from "./script/AuthUser/Database/paginationLinks.js";
import detailsButton from "./script/AuthUser/Database/detailsButton.js";

document.addEventListener('DOMContentLoaded', function () {
    getThisYear();
    logoutConfirm();
    loginButton();
    registerButton();
    infoFadeOut();
    setInterval(getNewQuote, 6000);
    searchButton();
    sortButton();
    posterButton();
    paginationLinks();
    detailsButton();
})

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
import collectionFilter from "./script/AuthUser/Collection/collectionFilter.js";
import sortCollection from "./script/AuthUser/Collection/sortCollection.js";
import actionButton from "./script/AuthUser/Collection/actionButton.js";

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
    collectionFilter();
    sortCollection();
    actionButton();
})

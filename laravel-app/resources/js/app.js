import logoutConfirm from "./script/logoutConfirm.js";
import loginButton from "./script/loginButton.js";
import registerButton from "./script/registerButton.js";
import getThisYear from "./script/thisYear.js";
import infoFadeOut from "./script/infoFadeOut.js";
import getNewQuote from "./script/getNewQuote.js";

document.addEventListener('DOMContentLoaded', function () {
    getThisYear();
    logoutConfirm();
    loginButton();
    registerButton();
    infoFadeOut();
    setInterval(getNewQuote, 10000);
})

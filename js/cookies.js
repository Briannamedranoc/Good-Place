document.getElementById('setCookieBtn').addEventListener('click', setCookie);
document.getElementById('getCookieBtn').addEventListener('click', getCookie);
document.getElementById('deleteCookieBtn').addEventListener('click', deleteCookie);

function setCookie() {
    var name = "username";
    var value = "John Doe";
    var days = 30; // Duración de la cookie en días

    var expires = new Date();
    expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
    var expiresStr = "expires=" + expires.toUTCString();

    document.cookie = name + "=" + value + ";" + expiresStr + ";path=/";

    showMessage("Cookie establecida correctamente", "success");
}

function getCookie() {
    var name = "username";
    var cookieArr = document.cookie.split(';');
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split('=');
        if(cookiePair[0].trim() === name) {
            showMessage("El valor de la cookie es: " + cookiePair[1], "success");
            return;
        }
    }
    showMessage("No se encontró la cookie '" + name + "'", "error");
}

function deleteCookie() {
    var name = "username";
    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
    showMessage("Cookie eliminada correctamente", "success");
}

function showMessage(message, type) {
    var messageElem = document.getElementById('message');
    messageElem.innerText = message;
    messageElem.className = "message " + type;
    messageElem.classList.remove('hidden');
    setTimeout(function() {
        messageElem.classList.add('hidden');
    }, 3000);
}

//Cookiek létrehozása
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; SameSite=Strict; " + expires + ";path=/";
}

//Cookiek törlése
function delCookie(cname) {
    document.cookie = cname + "=; SameSite=Strict; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
}

//Bizonyos Cookie lekérése
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}
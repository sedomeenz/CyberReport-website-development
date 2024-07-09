function deleteAllCookies() {
    // Get all cookies
    const cookies = document.cookie.split(";");

    // Iterate through each cookie
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i];
        const eqPos = cookie.indexOf("=");
        const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        
        // Delete each cookie by setting its expiration date to a past date
        
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/;SameSite=None;";
    } 

}



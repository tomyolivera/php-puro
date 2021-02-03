$(document).ready(() => {
    // Global
    const URL = "../../Controllers/LoginController.php";
    let main = new Main();
    
    // Login
    $("#btn_login").click(() => { main.login(URL) });
});
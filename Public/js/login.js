$(document).ready(() => {
    // Global
    const URL = "../../Controllers/LoginController.php";
    let main = new Main();
    
    // Login
    $("#form_login").submit((e) => { e.preventDefault(); main.login(URL) });
});
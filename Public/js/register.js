$(document).ready(() => {
    // Global
    const URL = "../../Controllers/RegisterController.php";
    let main = new Main();

    // console.log(name_min_length);
    const max_lengths = {
        username: $('input#username')[0].maxLength,
        name: $('input#name')[0].maxLength,
        password: $('input#password')[0].maxLength,
    }

    // Show lengths
    $("#username").keyup(() => { main.showActualLength("username", max_lengths) });
    $("#name").keyup(() => { main.showActualLength("name", max_lengths) });
    $("#password").keyup(() => { main.showActualLength("password", max_lengths)});

    // Show / Hide passwords
    $(".btn_toggle_type_password").click(() => {
        let password = document.getElementById("password");
        let repassword = document.getElementById("repassword");

        main.showPassword(password);
        main.showPassword(repassword);
    });

    // Register
    $("#form_register").submit((e) => { e.preventDefault(); main.register(URL) });
});
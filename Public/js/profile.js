$(document).ready(() => {
    const URL = "../../Controllers/ProfileController.php";
    let main = new Main();
    getData();
    
    function getData()
    {   
        const data = {
            getData: true
        }

        $.post(URL, data, (res) => {
            let result = JSON.parse(res);
            let actions = "";

            let status = main.showStatus(result[0].status);
            
            result.forEach(element => {
                actions = `
                    <button class="btn btn-outline-primary mr-2 flex align-center" data-bs-toggle="modal" data-bs-target="#edit"><i class="material-icons">edit</i></button>
                    <button class="btn btn-outline-danger mr-2 flex align-center"><i class="material-icons">delete</i></button>
                    <button class="btn btn-danger mr-2 flex align-center">Disable Account</button>
                `

                $("#actions").html(actions);

                $("#sidebar_img").html(`<img class="rounded-full w-16 h-16" src="${element.photo}">`);
                $("#profile_img").html(`<img class="w-100" src="${element.photo}">`);

                $(".user_name").html(element.name);
                $(".user_username").html(element.username);
                $(".user_email").html(element.email);
                $(".user_created_at").html(element.created_at);
                $(".user_status").html(status);

                // Birthday
                element.birthday == null ? $("#birthday").val(main.getActualDate()) : $("#birthday").val(element.en_birthday);
                $("#birthday_info").html(element.birthday != null ? element.birthday.substr(0, 5) : 'Add your birthday date');

                // Back up email
                $("#backup_email_info").html(element.backup_email != null ? element.backup_email : 'Add a backup email');
            });
        });
        
    }

    // Edit
    $("#form_edit").submit((e) => {
        e.preventDefault();

        const data = {
            name: $("#name").val(),
            username: $("#username").val(),
            email: $("#email").val(),
            status: $("#status").val(),
        }

        $.post(URL, data, (res) => {
            console.log(res);

            getData();
        });
    });


    /** EXTRAS **/
    // Birthday
    $("#birthday").val(main.getActualDate());

    $("#form_birthday").submit((e) => {
        e.preventDefault();

        const data = { birthday: $("#birthday").val() }

        $.post(URL, data, (res) => {
            // let message = JSON.parse(res);
            // main.showMessage(message);
            main.closeModal("birthday_modal");
            getData();
        });
    })

    // Back up email
    $("#form_backup_email").submit((e) => {
        e.preventDefault();

        const data = { backup_email: $("#backup_email").val() }

        $.post(URL, data, (res) => {
            let message = JSON.parse(res);
            main.showMessage(message);
            main.closeModal("backup_email_modal");
            getData();
        });
    });
});
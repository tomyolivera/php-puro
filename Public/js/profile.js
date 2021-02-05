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
            console.log(result);
            let status = "";
            let actions = "";

            switch (result[0].status) {
                case 0:
                    status = "<p class='flex align-center'><i class='material-icons mr-2 text-gray-500'>fiber_manual_record</i>Offline</p>";
                    break;
                    
                case 1:
                    status = "<p class='flex align-center'><i class='material-icons mr-2 text-green-500'>fiber_manual_record</i>Online</p>";
                    break;
                default:
                    status = "<p class='flex align-center'><i class='material-icons mr-2 text-orange-500'>fiber_manual_record</i>Busy</p>";
                    break;
            }
            
            result.forEach(element => {
                actions = `
                    <button class="btn btn-outline-primary mr-2 flex align-center" data-bs-toggle="modal" data-bs-target="#edit"><i class="material-icons">edit</i></button>
                    <button class="btn btn-outline-danger mr-2 flex align-center"><i class="material-icons">delete</i></button>
                    <button class="btn btn-danger mr-2 flex align-center">Disable Account</button>
                `

                $("#actions").html(actions);

                $("#sidebar_img").html(`<img class="rounded-full w-16 h-16" src="${element.photo}">`);
                $("#profile_img").html(`<img class="w-100" src="${element.photo}">`);

                $(".user_name").html(`${element.name}`);
                $(".user_username").html(`${element.username}`);
                $(".user_email").html(`${element.email}`);
                $(".user_created_at").html(`${element.created_at}`);
                $(".user_status").html(status);
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

});
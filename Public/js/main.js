// Global
window.onload = function(){ $(".allPage").fadeOut() }

$("i").addClass("material-icons mr-3");
$("h1").addClass("h1");
$("h2").addClass("h2");
$("h3").addClass("h3");
$("h4").addClass("h4");
$("h5").addClass("h5");
$("h6").addClass("h6");
$(".annotation").addClass("text-gray-600");


// Rows and Cols
$(".col").addClass("col-xs-12 col-sm-12");

// Forms
$(".input-customize").addClass(
    'mb-3 bg-gray-800 border-1 border-gray-600 rounded w-full py-2 px-4 text-gray-400 leading-tight focus:outline-none focus:bg-gray-700 focus:border-gray-400');

// Buttons
$(".button-blue").addClass("btn bg-blue-700 hover:bg-blue-800 focus:bg-blue-800 text-white");
$(".button-green").addClass("btn bg-green-700 hover:bg-green-800 focus:bg-green-800 text-white");
$(".button-red").addClass("btn bg-red-700 hover:bg-red-800 focus:bg-red-800 text-white");
$(".button-yellow").addClass("btn bg-yellow-600 hover:bg-yellow-800 focus:bg-yellow-800 text-white");
$(".button-purple").addClass("btn bg-purple-500 hover:bg-gray-800 focus:bg-gray-800 text-white");
$(".button-pink").addClass("btn bg-pink-500 hover:bg-pink-800 focus:bg-pink-800 text-white");
$(".button-orange").addClass("btn bg-orange-500 hover:bg-orange-800 focus:bg-orange-800 text-white");
$(".button-gray").addClass("btn bg-gray-800 hover:bg-gray-700 focus:bg-gray-700 text-white");
$(".button-dark").addClass("btn bg-gray-900 hover:bg-gray-800 focus:bg-gray-800 text-white d-flex align-center");

$(".button-blue-outline").addClass("btn btn-outline-primary");
$(".button-green-outline").addClass("btn btn-outline-success");
$(".button-red-outline").addClass("btn btn-outline-danger");
$(".button-yellow-outline").addClass("btn btn-outline-warning");
$(".button-dark-outline").addClass("btn btn-outline-dark");

function showMessage(message)
{
    let color = message[1] == "Success" ? "success" : "danger";
    
    let template = `
        <div role="alert">
            <div class="px-3 py-2 bg-${color}-700 rounded bg-${color}-100 text-white shadow-lg">
                <p class="text-center">${message[0]}</p>
            </div>
        </div>
    `

    template = `
        <div class="alert alert-${color} alert-dismissible fade show" role="alert">
            <p class="text-center">${message[0]}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `

    $(".flash_msg").html(template);
    
    setTimeout(() => { $(".flash_msg").html("") }, 5000);
}

class Main{
    showPassword(password)
    {
        let type = password.type;

        password.type = type == "password" ? "text" : "password";
        $(".btn_toggle_type_password").html(type == "password" ? "Hide password" : "Show password");
    }

    createSafePassword()
    {
        // ...
    }

    showMessage(message)
    {
        let color = message[1] == "Success" ? "success" : "danger";
        
        let template = `
            <div role="alert">
                <div class="px-3 py-2 bg-${color}-700 rounded bg-${color}-100 text-white shadow-lg">
                    <p class="text-center">${message[0]}</p>
                </div>
            </div>
        `

        template = `
            <div class="alert alert-${color} alert-dismissible fade show" role="alert">
                <p class="text-center">${message[0]}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `

        $(".flash_msg").html(template);
        
        setTimeout(() => { $(".flash_msg").html("") }, 10000);
    }

    showStatus(status)
    {
        switch (status) {
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

        return status;
    }
                    
    getActualDate()
    {
        let date = new Date();
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();

        day = day < 10 ? '0' + day : day;
        month = month < 10 ? '0' + month : month;

        return year + "-" + month + "-" + day;
    }

    showActualLength(field, max_lengths)
    {
        let actual = $("#" + field).val().length;
        let counter = $("#" + field + "_counter");

        counter.html(actual + "/" + max_lengths[field]);
        actual == max_lengths[field] ? counter.addClass("text-danger").removeClass("annotation") : counter.removeClass("text-danger").addClass("annotation") ;
        actual == 0 ? counter.html("") : '';
    }

    register(URL)
    {
        const data = {
            username: $("#username").val(),
            name: $("#name").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            repassword: $("#repassword").val(),
        }

        $.post(URL, data, (res) => {
            let message = JSON.parse(res);
            this.showMessage(message);
            message[1] == "Success" ? $("#btn_register").attr({disabled: true}).addClass("disabled") : '';
            message[1] == "Success" ? this.redirectToRoute("login", 1) : '';
            
        });
    }

    login(URL)
    {
        const data = {
            email: $("#email").val(),
            password: $("#password").val(),
        }

        $.post(URL, data, (res) => {
            console.log(res);
            let message = JSON.parse(res);
            this.showMessage(message);
            message[1] == "Success" ? $("#btn_login").attr({disabled: true}).addClass("disabled") : '';
            message[1] == "Success" ? this.redirectToRoute("home", 1) : '';
        });
    }

    redirectToRoute(location, wait = 0)
    {
        if(wait !== 0){
            setTimeout(() => {
                window.location = "../" + location;
            }, wait * 1000);
        }else{
            window.location = "../" + location;
        }
    }
   
    closeModal(modal)
    {
        $("#" + modal).modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    }

}
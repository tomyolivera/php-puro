const URL = "../../Controllers/TaskController.php";
$(document).ready(() => {
    main = new Main();
    
    const max_lengths = {
        name: $('#name')[0].maxLength,
        description: $('#description')[0].maxLength,
    }
    
    // Show lengths
    $("#name").keyup(() => { main.showActualLength("name", max_lengths) });
    $("#description").keyup(() => { main.showActualLength("description", max_lengths) });
    setFieldsToDefault();

    $("#btn_add").click(() =>{
        main.closeModal("add");
    });
});

getTasks();

function getTasks()
{
    const data = {
        get: true
    }

    $.post(URL, data, (res) => {
        let result = JSON.parse(res);
        let template = ``;
        
        if(result.length == 0){
            template += `
                <tr>
                    <td class="p-4" colspan="5">
                        <p class="h5">You do not have tasks!</p>
                    </td>
                </tr>
            `;
        }else{
            result.forEach(element => {
                let token = "";

                template += `
                    <tr>
                        <td>${element.name}</td>
                        <td>
                            <textarea disabled class="bg-transparent" style="min-width:200px;max-width:500px;min-height:80px;max-height:130px;">${element.description}</textarea>
                        </td>
                        <td>${element.end_task}</td>
                        <td>
                            <button class="btn btn-outline-warning d-inline"><i class="material-icons">edit</i></button>

                            <form method="POST" class="d-inline">
                                <button type="button" class="btn btn-outline-danger btn_delete" onclick="deleteTask(${element.id})"><i class="material-icons">delete</i></button>
                            </form>
                        </td>
                    </tr>
                `;

                
            });
        }
        $("tbody").html(template);
    });
}

function setFieldsToDefault()
{
    $("#name").val("");
    $("#description").val("");
    $("#date").val(main.getActualDate());
}

$("#form_add").submit((e) => {
    e.preventDefault();

    const data = {
        name: $("#name").val(),
        description: $("#description").val(),
        date: $("#date").val(),
    }

    $.post(URL, data, (res) => {
        // let message = JSON.parse(res);
        // main.showMessage(message);

        getTasks();
        setFieldsToDefault();
    });
});

function deleteTask(id)
{
    const data = {
        delete: true,
        id_delete: id
    }

    $.post(URL, data, (res) => {
        let message = JSON.parse(res);
        main.showMessage(message);
        getTasks();
    });
}
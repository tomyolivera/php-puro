const URL = "../../Controllers/AdminController.php";

function showData(payload)
{
    return `
            <tr>
                <td>${payload.id}</td>
                <td>
                    <img class="rounded-full w-10" src="${payload.photo}">
                </td>
                <td>${payload.name}</td>
                <td>${payload.username}</td>
                <td>${payload.email}</td>
                <td>${payload.status}</td>
                <td>${payload.role}</td>
                <td>${payload.verified}</td>
                <td>${payload.ban}</td>
                <td>${payload.disabled}</td>
                <td>${payload.created}</td>
                <td>
                    <button class="btn btn-outline-warning"><i class="material-icons">edit</i></button>
                    <button class="btn btn-danger"><i class="material-icons">delete</i></button>
                </td>
            </tr>
        `;
}

getUsers();

function getUsers()
{
    const data = {getUsers: true}
    
    $.post(URL, data, (res) => {
        let result = JSON.parse(res);
        let template = ``;

        result.forEach(element => { template += showData(element) });

        $("tbody").html(template);
    });
}

$("#search_by_id").keyup(() => {
    let id = $("#search_by_id").val();

    if(id == "") {
        getUsers(); 
        return;
    }

    const data = {search_by_id: id}

    $.post(URL, data, (res) => {
        let result = JSON.parse(res);
        let template = ``;

        result.forEach(element => { template += showData(element) });

        $("tbody").html(template);
    });
});
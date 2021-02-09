const URL = "../../Controllers/FriendsController.php";

$(document).ready(() => {
    const URL = "../../Controllers/FriendsController.php";
    let main = new Main();

    getMyFriends();
    getFriendsRequests();

    setInterval(() => {
        getMyFriends();
        getFriendsRequests();
    }, 10000);

    function showData(element)
    {
        let status = main.showStatus(element.status);
        return `
                <hr class="my-3">
                    <div class="row" style="overflow:auto;">
                        <div class="col col-md-3">
                            <img src="${element.photo}" class="rounded-full w-16 h-16">
                        </div>

                        <div class="col col-md-9">
                            <div class="mb-2 flex align-center">
                                <p class="text-gray-600 mr-2">Name: </p><p> ${element.name}</p>
                            </div>

                        <div class="mb-2 flex align-center">
                            <p>${status}</p>
                        </div>
            `
    }

    function getMyFriends()
    {
        const data = { getMyFriends: true }
        
        $.post(URL, data, (res) => {
            let result = JSON.parse(res);
            let template = ``;

            if(result.length == 0){
                $("#my_friends").html("<hr><p class='mt-3 h5'>You do not have any friend yet!</p>");
                return;
            }
            
            result.forEach(res => {
                res.forEach(element => {
                    template += showData(element);
                    template += `
                                <div class="mt-3 flex align-center">
                                    <button type="button" class="btn btn-primary mr-2">See profile</button>
                                    <button type="button" class="btn btn-outline-success mr-2">Send message</button>
                                    <button type="button" class="btn btn-danger"><i class="material-icons">delete</i></button>
                                </div>
                            </div>

                        </div>
                    `;
                });
            });

            $("#my_friends").html(template);
        });
    }

    function getFriendsRequests()
    {
        const data = { getFriendsRequests: true }
        
        $.post(URL, data, (res) => {
            let result = JSON.parse(res);
            let template = ``;

            if(result.length == 0){
                $("#friends_requests").html("<hr><p class='mt-3 h5'>You do not have any friend request yet!</p>");
                return;
            }

            result.forEach(element => {
                template += showData(element);
                template += `
                            <div class="mb-2 flex align-center">
                                <p class="text-gray-600 mr-2">Received: </p><p> ${element.received_at == 0 ? 'Today' : element.received_at + ' day/s ago'} </p>
                            </div>

                            <div class="mt-3 flex align-center">
                                <button type="button" class="btn btn-primary mr-2">See profile</button>
                                <button type="button" class="btn btn-outline-success mr-2 btn_accept" onclick="accept(${element.receive_id})">Accept</button>
                                <button type="button" class="btn btn-danger"><i class="material-icons">delete</i></button>
                            </div>
                        </div>

                    </div>
                `;

                $("#friends_requests").html(template);
            });

        });
    }

    function searchByName(name)
    {
        const data = {search: name}

        $.post(URL, data, (res) => {
            let result = JSON.parse(res);
            let template = ``;

            if(result.length == 0){
                $("#search_people").html("<hr><p class='mt-3 h5'>No results!</p>");
                return;
            }

            result.forEach(element => {
                template += showData(element);
                template += `
                            <div class="mt-3 flex align-center">
                                <button type="button" class="btn btn-primary mr-2">See profile</button>
                                <button type="button" class="btn btn-outline-success mr-2" onclick="sendRequest(${element.id})">Send request</button>
                            </div>
                        </div>

                    </div>
                `;
            });
            name == "" ? $("#search_people").html("") : $("#search_people").html(template);
        });
    }

    $("#search").keyup(() => { searchByName($("#search").val()) });

});

function accept(id)
{
    if(!confirm("Do you really want to add the user with id: " + id + " to your friends?")) return
                    
    const data = { accept: true, id: id }

    $.post(URL, data, (res) => {
        let message = JSON.parse(res);
        showMessage(message);
    });
}

function sendRequest(id)
{
    if(!confirm("Do you really want to add the user with id: " + id + " to your friends?")) return

    const data = {sendRequest: true, id: id}

    $.post(URL, data, (res) => {
        let message = JSON.parse(res);
        showMessage(message);
        $("#search").val("");
        $("#search_people").html("")
    });
}
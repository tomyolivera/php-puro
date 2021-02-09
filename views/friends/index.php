<?php require_once '../../views/base/head.php'; ?>

<title>Friends | FACER</title>

<div>
    <div class="row">
        <div class="col col-md-3">
            <h4>Friends</h4>
        </div>

        <div class="col col-md-6 sm-auto flash_msg"></div>
    </div>
    <div class="row">
        <div class="col col-md-4 bg-gray-900 p-3 rounded">
            <h5 class="mb-3">My friends</h5>
            <div id="my_friends"></div>
        </div>

        <div class="col col-md-3 bg-gray-900 p-3 rounded mx-2">
            <h5 class="mb-3">Friends requests</h5>
            <div id="friends_requests"></div>
        </div>

        <div class="col col-md-3 bg-gray-900 p-3 rounded">
            <h5>Find people</h5>
            <form method="POST" class="flex align-center mt-4">
                <input type="text" name="search" id="search" class="input-customize" placeholder="Search by name">
                <div>
                    <button type="button" class="button-green-outline ml-2">Search</button>
                </div>
            </form>
            <div id="search_people"></div>
        </div>

    </div>
</div>

<script src="../../Public/js/friends.js"></script>
<?php require_once '../../views/base/footer.php'; ?>
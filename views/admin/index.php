<?php require_once '../../views/base/head.php'; ?>

<title>Admin | FACER</title>

<div>
    <div class="row">
        <div class="col col-md-3">
            <h4>Admin Control</h4> <hr class="my-3">

            <a href="db.php" class="button-red mb-3">Database Control</a>
            <a href="users.php" class="button-blue mb-3">Users Control</a>
        </div>

        <div class="col col-md-9" id="load"></div>
    </div>
</div>

<script src="../../Public/js/admin.js"></script>
<?php require_once '../../views/base/footer.php'; ?>
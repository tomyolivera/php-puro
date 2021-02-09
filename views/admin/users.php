<?php require_once '../../views/base/head.php'; ?>
<title>Admin | FACER</title>

<div class="bg-gray-900 p-3 rounded shadow-lg">

<h4>Users control</h4>

<div class="m-3">
    <table class="table table-striped table-dark table-responsive table-bordered border-secondary">
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Verified</th>
                <th>Ban</th>
                <th>Disabled</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <td colspan="12">
                    <form method="POST">
                        <input type="number" name="search_by_id" id="search_by_id" class="form-control bg-gray-500 focus:bg-gray-500 text-dark" placeholder="Search by id">
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

</div>

<script src="../../Public/js/admin.js"></script>
<?php require_once '../../views/base/footer.php'; ?>
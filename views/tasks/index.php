<?php require_once '../../views/base/head.php'; ?>

<title>My Tasks | FACER</title>

<div>

    <h4>My Tasks</h4>

    <!-- Add -->
    <div class="row my-3">
        <div class="col col-md-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add"><i class="material-icons m-0 mt-1">add</i></button>
        </div>

        <div class="col col-md-6">
            <div class="flash_msg"></div>
        </div>
    </div>

    <!-- Tasks -->
    <table class="my-3 table table-dark table-striped table-bordered table-lg table-responsive">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Task ends</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <!-- Modals -->
    <!-- Modal Add -->
    <div class="modal fade" id="add">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title">Add task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form method="post" id="form_add">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="input-customize" autocomplete="off" pattern="[a-zA-Z0-9 ]+" minlength="<?php echo $AC::MIN_TASK_NAME ?>" maxlength="<?php echo $AC::MAX_TASK_NAME ?>">
                            <p id="name_counter" class="text-sm annotation"></p>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <input type="text" name="description" id="description" class="input-customize" autocomplete="off" pattern="[a-zA-Z0-9 ]+" minlength="<?php echo $AC::MIN_TASK_DESCRIPTION ?>" maxlength="<?php echo $AC::MAX_TASK_DESCRIPTION ?>">
                            <p id="description_counter" class="text-sm annotation"></p>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="date">Task ends on</label>
                            <input type="date" name="date" id="date" class="input-customize">
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="button-blue" id="btn_add">Add</button>
                            <button type="button" class="button-red" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="../../Public/js/tasks.js"></script>
<?php require_once '../../views/base/footer.php'; ?>
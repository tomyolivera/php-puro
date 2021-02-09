<button class="button-blue-outline flex align-center my-3" data-bs-toggle="modal" data-bs-target="#backup_email_modal"><i>email</i> Add / modify a backup email</button>

<!-- Modal backup_email -->
<div class="modal fade" id="backup_email_modal">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title">Add / modify a backup email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="post" id="form_backup_email">
                    <div class="form-group mb-3">
                        <label for="backup_email">Back up email:</label>
                        <input type="text" name="backup_email" id="backup_email" class="input-customize">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="button-blue">Save changes</button>
                        <button type="button" class="button-red" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
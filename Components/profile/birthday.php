<button class="button-yellow-outline flex align-center my-3" data-bs-toggle="modal" data-bs-target="#birthday_modal"><i>celebration</i> Add / modify your birthday date!</button>

<!-- Modal birthday -->
<div class="modal fade" id="birthday_modal">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title">Add / modify your birthday date!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="post" id="form_birthday">
                    <div class="form-group mb-3">
                        <label for="birthday">Born on:</label>
                        <input type="date" name="birthday" id="birthday" class="input-customize">
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
<?php require_once '../../views/base/head.php'; ?>

<title>My profile | FACER</title>

<div class="row">
    <div class="col col-md-3">
        <h4>My profile</h4>
    </div>

    <div class="col col-md-6 ms-auto flash_msg"></div>
</div>

<div class="row mt-5">
  <div class="col col-md-3">
    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-900">
      <div class="user_img" id="profile_img"></div>

      <div class="px-6 py-4" id="user_data">
          <div class="p-2"><p class="d-inline text-gray-600">Name:</p> <p class="d-inline user_name"></p></div><br>
          <div class="p-2"><p class="d-inline text-gray-600">Email:</p> <p class="d-inline user_email"></p></div><br>
          <div class="p-2"><p class="d-inline text-gray-600">Username:</p> <p class="d-inline user_username"></p></div><br>
          <div class="p-2"><p class="d-inline text-gray-600">Created at:</p> <p class="d-inline user_created_at"></p></div><br>
          <div class="p-2 flex align-center"><p class="text-gray-600 mr-3">Status:</p> <p class="d-inline user_status"></p></div><br>
      </div>

      <div class="pb-2 pl-2 flex align-center" id="actions"></div>
    </div>
  </div>

  <div class="col col-md-3 mx-2">
    <div class="bg-gray-900 shadow-lg p-3 rounded">
        <h5>More settings</h5>

        <button class="button-green-outline flex align-center my-3"><i>vpn_key</i> Change password</button>

        <?php require_once '../../Components/profile/backupemail.php'; ?>

        <?php require_once '../../Components/profile/birthday.php'; ?>
    </div>

    <div class="bg-gray-900 mt-4 shadow-lg rounded p-3">
      <h5>More information about me</h5>

      <div class="mt-3 mb-2"><p class="d-inline text-gray-600">Birthday:</p> <p class="d-inline" id="birthday_info"></p></div><br>
      <div class="mb-2"><p class="d-inline text-gray-600">Back up email:</p> <p class="d-inline" id="backup_email_info"></p></div><br>
    </div>
  </div>

  <div class="col col-md-3 mx-2">
    <div class="bg-gray-900 shadow-lg p-3 rounded">
        <h5>Friends</h5>

        <div>
          <button class="button-green-outline">Change password</button>
        </div>
    </div>
  </div>


</div>


<!-- Modals -->
<!-- Modal Edit -->
<div class="modal fade" id="edit">
      <div class="modal-dialog">
        <div class="modal-content bg-dark">
          <div class="modal-header">
            <h5 class="modal-title">Edit account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form method="post" id="form_edit">
              <div class="form-group mb-3">
                  <label for="photo">Photo</label>
                  <input type="file" name="photo" id="photo" class="input-customize" value="<?php echo $AC->getUser("photo"); ?>">
              </div>

              <div class="form-group mb-3">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="input-customize" value="<?php echo $AC->getUser("name"); ?>">
              </div>

              <div class="form-group mb-3">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" class="input-customize" value="<?php echo $AC->getUser("username"); ?>">
              </div>

              <div class="form-group mb-3">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="input-customize">
                    <option value="0" <?php echo $AC->getUser("status") == 0 ? "selected" : ''; ?>>Offline</option>
                    <option value="1" <?php echo $AC->getUser("status") == 1 ? "selected" : ''; ?>>Online</option>
                    <option value="2" <?php echo $AC->getUser("status") == 2 ? "selected" : ''; ?>>Busy</option>
                  </select>
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
<script src="../../Public/js/profile.js"></script>
<?php require_once '../../views/base/footer.php'; ?>
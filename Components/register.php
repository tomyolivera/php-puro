<div class="row">
    <div class="col col-md-6">
        <h3 class="text-center text-<?php echo $AC->colors["register"] ?>-500">Register</h3>

        <div class="p-4 bg-gray-900 rounded shadow-lg">
            <p class="mb-3 text-<?php echo $AC->colors["register"] ?>-500">Complete the fields with valid data</p>    

            <form method="POST">
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="input-customize" placeholder="examplemail@mail.com">
                </div>

                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="input-customize" pattern="[a-zA-Z0-9_ ]+" placeholder="your_username123" minlength="<?php echo $AC::MIN_USERNAME ?>" maxlength="<?php echo $AC::MAX_USERNAME ?>">
                    <p id="username_counter" class="text-sm annotation"></p>
                </div>
                
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="input-customize" pattern="[a-zA-Z ]+" placeholder="Example Name" minlength="<?php echo $AC::MIN_NAME ?>" maxlength="<?php echo $AC::MAX_NAME ?>">
                    <p id="name_counter" class="text-sm annotation"></p>
                </div>
                
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="input-customize" minlength="<?php echo $AC::MIN_PASSWORD ?>" maxlength="<?php echo $AC::MAX_PASSWORD ?>">
                    <p id="password_counter" class="text-sm annotation"></p>
        
                    <label for="repassword">Repeat your password</label>
                    <input type="password" name="repassword" id="repassword" class="input-customize" minlength="<?php echo $AC::MIN_PASSWORD ?>" maxlength="<?php echo $AC::MAX_PASSWORD ?>">

                    <button type="button" class="btn_toggle_type_password button-yellow-outline">Show Password</button>
                    <button type="button" class="btn_safe_password button-red-outline">Create safe password</button>
                </div>
                

                <button type="button" id="btn_register" class="button-<?php echo $AC->colors["register"] ?>-outline w-full my-3">Register</button>
            </form>

            <p class="my-3 annotation">Do you already have an account? <a class="button-<?php echo $AC->colors["login"] ?>-outline" href="../login">Login here</a></p>
        </div>
    </div>

    <div class="col col-md-6 flash_msg"></div>
</div>
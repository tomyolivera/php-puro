<h3 class="text-center text-<?php echo $AC->colors["login"] ?>-500">Login</h3>
<div class="p-4 bg-gray-900 rounded shadow-lg">
    <div class="row flex justify-between">
        <p class="col col-md-3 mb-3 text-<?php echo $AC->colors["login"] ?>-500">Complete the fields with your data</p>    
        <div class="col col-md-6 flash_msg"></div>
    </div>

    <form method="POST">
        <div class="form-group mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="input-customize">
        </div>
        
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="input-customize">
        </div>
        
        <button type="button" id="btn_login" class="button-<?php echo $AC->colors["login"] ?>-outline w-full my-3">Log In</button>
    </form>

    <!-- Login with social media -->
    <div class="my-3">
        <p class="annotation mb-3">Or login by</p>

        <div class="flex justify-between">
            <button class="button-blue mb-2 form-control btn-sm">
                <div class="row align-items-center">
                    <div class="col-1">
                        <img src="../../Public/img/facebook.png" alt="Facebook">
                    </div>

                    <div class="col-11 text-center">Facebook</div>
                </div>
            </button>

            <button class="button-red mb-2 form-control btn-sm ml-3">
                <div class="row align-items-center">
                    <div class="col-1">
                        <img src="../../Public/img/google.png" alt="Google" class="bg-white rounded-full p-1">
                    </div>

                    <div class="col-11 text-center">Google</div>
                </div>
            </button>
        </div>
    </div>

    <p class="my-3 annotation">Don't you have an account? <a class="ml-3 button-<?php echo $AC->colors["register"] ?>-outline" href="../register">Register here</a></p>
</div>
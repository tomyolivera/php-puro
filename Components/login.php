<div class="row">
    <div class="col col-md-6">
        <h3 class="text-center text-<?php echo $AC->colors["login"] ?>-500">Login</h3>

        <div class="p-4 bg-gray-900 rounded shadow-lg">
            <p class="mb-3 text-<?php echo $AC->colors["login"] ?>-500">Complete the fields with your data</p>    

            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="input-customize">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="input-customize">
                </div>
                
                <button type="button" class="button-<?php echo $AC->colors["login"] ?>-outline w-full">Log In</button>
            </form>

            <!-- Login with social media -->
            <div class="my-3">
                <p class="annotation mb-3">Or login by</p>

                <div class="flex justify-between">
                    <button class="button-blue mb-2 form-control btn-sm">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <img src="../../Public/img/facebook.png" width="200" alt="Facebook">
                            </div>

                            <div class="col-10 text-center">Facebook</div>
                        </div>
                    </button>

                    <button class="button-red mb-2 form-control btn-sm ml-3">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <img src="../../Public/img/google.png" width="200" alt="Google" class="bg-white rounded-full p-1">
                            </div>

                            <div class="col-10 text-center">Google</div>
                        </div>
                    </button>
                </div>
            </div>

            <p class="my-3 annotation">Don't you have an account? <a class="ml-3 button-<?php echo $AC->colors["register"] ?>-outline" href="../register">Register here</a></p>
        </div>
    </div>

    <div class="col col-md-6 flash_msg"></div>
</div>
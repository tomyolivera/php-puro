<?php $class = "d-block p-3 d-flex align-center text-gray-500"; ?>

<div class="sidebar-container text-light shadow-2xl bg-gray-900">
    <div class="logo">
        <h4 class="h4 mt-2">FACER</h4>
    </div>
    <div class="menu">
            <?php $AC = new AbstractController(); if($AC->checkSession()): ?>
                <div class="p-3 row">
                    <div class="col col-md-5 user_img"><?php echo $AC->showUserPhoto(); ?></div>

                    <div class="col col-md-7">
                        <p class="user_name"><?php echo $AC->getUser("name"); ?></p>
                        <p class="user_status"><?php echo $AC->showStatus(); ?></p>
                    </div>
                </div>
                <?php $role = $AC->getUser("role"); if($role == "OWNER" || $role == "ADMIN"): ?>
                    <a href="../admin" class="d-block p-3 d-flex align-center text-yellow-600"><i>admin_panel_settings</i> Admin</a>
                <?php else:; endif; ?>
            <?php else: ?>
                <a href="../login" class="d-block p-3 d-flex align-center text-<?php echo $AC->colors["login"] ?>-500"><i>login</i> Login</a>
                <a href="../register" class="d-block p-3 d-flex align-center text-<?php echo $AC->colors["register"] ?>-500"><i>person_add</i> Register</a>
            <?php endif; ?>
            <!-- <div class="container">
                <p class="text-danger h4">Your account is banned, you only have access to the Home page</p>
                <p>For more info, click <a class="text-info" href="#">here</a></p>
            </div> -->

            <span class="d-block p-2 d-flex align-center bg-gray-800 text-gray-600">Navigation Menu</span>
            <a href="../home" class="<?php echo $class; ?>"><i>home</i> Home</a>
            <a href="../tasks" class="<?php echo $class; ?>"><i>work</i> Tasks</a>
            <a href="../chats" class="<?php echo $class; ?>"><i>chat</i> Chats</a>
            
            <?php if($AC->checkSession()): ?>
                <a href="#" class="<?php echo $class; ?>"><i>group</i> Friends</a>
                <a href="../profile" class="<?php echo $class; ?>"><i>person</i> Profile</a>
                <a href="../logout" class="d-block p-3 d-flex align-center text-red-600"><i>logout</i> Logout</a>
            <?php else:; endif; ?>
    </div>
</div>

<style>
    .sidebar-container{
        min-height: 100vh;
    }
    .logo{
        padding-left: 1rem;
        padding-top: 0.73rem;
        padding-bottom: 0.73rem;
    }
    .menu{
        width: 18rem;
    }
    .menu > a:hover{
        text-decoration: none;
        color:white;
    }
</style>
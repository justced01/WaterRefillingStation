<!-- Login Screen -->

<?php include_once "../views/header.php" ?>
    
    <div class="title"><h1 class="display-1">Water Refilling Station</h1></div>
    <div class="content">
        <h1>Login</h1>
        <p>Please fill in your credentials to login.</p>

        <form>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <a href="personnel/index.php" type="submit" class="btn btn-primary">Login</a>
            <span class="fpsw"><a href="/personnel/forgotpassword.php">Forgot password?</a></span>
        </form>
    </div>

<?php include_once "../views/user/footer.php" ?>
<?php require_once "../../controllers/updatepersonnel_controller.php"; ?>
<?php include_once "../../views/personnel/header.php" ?>

    <h1>Update Personnel Profile (version 1.1)</h1>
    <a href="index.php" type="button" class="btn btn-secondary">Go Back</a>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="" method="post"> <!--do not use "get" when getting username and password-->
        <?php if ($personnel['profilepic']): ?>
            <img src="./picture/<?php echo $personnel['profilepic'] ?>" class="update-image">
        <?php endif; ?>
        <div class="form-group">
            <label>Profile Picture</label>
            <br>
            <input type="file" name="profilepic" value="<?php echo $profilepic ?>" >
        </div>
        
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="fname" class="form-control" value="<?php echo $fname ?>" >
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="lname" class="form-control" value="<?php echo $lname ?>" >
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email ?>" >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>   
    </form>
</body>
</html>
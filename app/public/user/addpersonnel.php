<!-- Owner's Creating Personnel Screen -->

<?php require_once "../../controllers/addpersonnel_controller.php"; ?>
<?php include_once "../../views/user/header.php" ?>

    <h1>Create New Personnel Profile (version 1.1)</h1>

    <a href="index.php" type="button" class="btn btn-secondary">Go Back</a>
    <br>
    <br>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
                
    <form action="" method="post" enctype="multipart/form-data"> <!--do not use "get" when getting username and password-->
        <div class="form-group">
            <label>Profile Picture</label>
            <br>
            <input type="file" name="profpic" value="<?php echo $usrimg ?>" >
        </div>
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="firstname" class="form-control" value="<?php echo $firstname ?>" >
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="lastname" class="form-control" value="<?php echo $lastname ?>" >
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $email ?>" >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

<?php include_once "../../views/user/footer.php" ?>
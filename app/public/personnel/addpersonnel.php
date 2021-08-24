<?php
    require_once "../../core/Application.php"; //Connect to wrs_db

    $errors = []; //Global variables
    $fname = '';
    $lname = '';
    $email = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //only do this if the method is POST
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $date = date('Y-m-d H:i:s');

        if (!$fname) {
            $errors[] = 'First Name is required.';
        }
        if (!$lname) {
            $errors[] = 'Last Name is required.';
        }
        if (!$email) {
            $errors[] = 'Email is required.';
        }

        if (empty($errors)) {
            $profilepic = $_FILES['profilepic'] ?? null;
            if ($profilepic) {
                $imgFile = $_FILES['profilepic']['name'];
                $tmp_dir = $_FILES['profilepic']['tmp_name'];
                $imgSize = $_FILES['profilepic']['size'];
                
                $upload_dir = 'picture/'; // upload directory
                $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
                // valid image extensions
                $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
                // rename uploading image
                $usrimg = rand(1000,1000000).".".$imgExt;
                
                // allow valid image file formats
                if(in_array($imgExt, $valid_extensions)){
                    // Check file size '5MB'
                    if($imgSize < 5000000){
                        move_uploaded_file($tmp_dir,$upload_dir.$usrimg);
                    }
                    else{
                        echo "Sorry, your file is too large.";
                    }
                }
                else{
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                }
                
            }

            $statement = $PDO->prepare("INSERT INTO personnel(profilepic, fname, lname, email , created_at) 
                VALUES (:profilepic, :fname, :lname, :email, :date)");
            $statement->bindValue(':profilepic',$usrimg);
            $statement->bindValue(':fname',$fname);
            $statement->bindValue(':lname',$lname);
            $statement->bindValue(':email',$email);
            $statement->bindValue(':date',$date);
            $statement->execute();
        }
        
    }
?>

<?php include_once "../../views/personnel/header.php" ?>

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
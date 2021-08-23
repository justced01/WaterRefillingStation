<?php
    include "../core/Application.php"; //Connect to wrs_db

    $errors = []; //Global variables
    $fname = '';
    $lname = '';
    $email = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //only do this if the method is POST
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];

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
            $statement = $PDO->prepare("INSERT INTO personnel(fname, lname, email) 
                VALUES (:fname, :lname, :email)");
            $statement->bindValue(':fname',$fname);
            $statement->bindValue(':lname',$lname);
            $statement->bindValue(':email',$email);
            $statement->execute();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Form(Create Data in Database)</title>
</head>
<body>
    <h1>Create New Personnel Profile (version .1000)</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


    <form action="" method="post"> <!--do not use "get" when getting username and password-->
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
        <a href="../core/Database.php" type="button" class="btn btn-secondary">Home</a>
    </form>


</body>
</html>
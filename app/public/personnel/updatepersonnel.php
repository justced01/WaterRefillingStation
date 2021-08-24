<?php
    require_once "../../core/Application.php"; //Connect to wrs_db

    $id = $_GET['id'] ?? null;
    if (!$id) {
        header ('Location: index.php');
        exit;
    }

    $statement = $PDO->prepare('SELECT * FROM personnel WHERE id = :id');
    $statement->bindValue(':id',$id);
    $statement->execute();
    $personnel = $statement->fetch(PDO::FETCH_ASSOC);

    $errors = []; //Global variables
    $fname = $personnel['fname'];
    $lname = $personnel['lname'];
    $email = $personnel['email'];

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
            $statement = $PDO->prepare("UPDATE personnel SET fname = :fname, lname = :lname, email = :email  WHERE id = :id");
            $statement->bindValue(':fname',$fname);
            $statement->bindValue(':lname',$lname);
            $statement->bindValue(':email',$email);
            $statement->bindValue(':id',$id);
            $statement->execute();
        }
    }
?>

<?php include_once "../../views/personnel/header.php" ?>

    <h1>Update Personnel Profile (version .1000)</h1>
    <a href="index.php" type="button" class="btn btn-secondary">Go Back</a>

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
    </form>
</body>
</html>
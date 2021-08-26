<?php
    require_once "../../core/Application.php"; //Connect to wrs_db

    $id = $_GET['id'] ?? null;
    if (!$id) {
        header ('Location: ../personnel/index.php');
        exit;
    }

    $statement = $DB_con->prepare('SELECT * FROM personnel WHERE id = :id');
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
            $usrimg = $_FILES['profilepic'] ?? null;
            $usrimg = '';
  
            if ($usrimg && $usrimg['tmp_name']) {
                $imgFile = $_FILES['profilepic']['name'];
                $tmp_dir = $_FILES['profilepic']['tmp_name'];
                $imgSize = $_FILES['profilepic']['size'];

                if ($personnel['profilepic']){
                    unlink(__DIR__.'../personnel/picture/'.$personnel['profilepic']);
                }
                    
                $upload_dir = '../personnel/picture/'; // upload directory
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
                        $errors[] = 'Sorry, your file is too large.';
                    }
                }
                else{
                    $errors[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
                }
            }
            
            $statement = $DB_con->prepare("UPDATE personnel SET profilepic = :profilepic, fname = :fname, lname = :lname, email = :email  WHERE id = :id");
            $statement->bindValue(':profilepic',$usrimg);
            $statement->bindValue(':fname',$fname);
            $statement->bindValue(':lname',$lname);
            $statement->bindValue(':email',$email);
            $statement->bindValue(':id',$id);
            $statement->execute();
            header('Location: ../personnel/index.php');
        }
    }
?>
<?php 
    require_once "../../core/Application.php"; //Connect to wrs_db
    $errors = []; //Global variables
    $fname = '';
    $lname = '';
    $email = '';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') { //only do this if the method is POST
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
            $usrimg = $_FILES['profilepic'] ?? null;
            if ($usrimg && $usrimg['tmp_name']) {
                $imgFile = $_FILES['profilepic']['name'];
                $tmp_dir = $_FILES['profilepic']['tmp_name'];
                $imgSize = $_FILES['profilepic']['size'];
                
                $upload_dir = '../user/picture/'; // upload directory
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
                        $statement = $DB_con->prepare("INSERT INTO personnel(profilepic, fname, lname, email , created_at) 
                            VALUES (:profilepic, :fname, :lname, :email, :date)");
                        $statement->bindValue(':profilepic',$usrimg);
                        $statement->bindValue(':fname',$fname);
                        $statement->bindValue(':lname',$lname);
                        $statement->bindValue(':email',$email);
                        $statement->bindValue(':date',$date);
                        $statement->execute();
                        header('Location: ../user/index.php');
                    }
                    else{
                        $errors[] = 'Sorry, your file is too large.';
                    }
                }
                else{
                    $errors[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
                }
            }
        }
    }
?>
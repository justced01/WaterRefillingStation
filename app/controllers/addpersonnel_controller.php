<?php 
    require_once "../../core/Application.php"; //Connect to wrs_db
    $errors = []; //Global variables
    $firstname = '';
    $lastname = '';
    $email = '';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') { //only do this if the method is POST
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $date = date('Y-m-d H:i:s');

        if (!$firstname) {
            $errors[] = 'First Name is required.';
        }
        if (!$lastname) {
            $errors[] = 'Last Name is required.';
        }
        if (!$email) {
            $errors[] = 'Email is required.';
        }

        if (empty($errors)) {
            $usrimg = $_FILES['profpic'] ?? null;
            if ($usrimg && $usrimg['tmp_name']) {
                $imgFile = $_FILES['profpic']['name'];
                $tmp_dir = $_FILES['profpic']['tmp_name'];
                $imgSize = $_FILES['profpic']['size'];
                
                $upload_dir = '../../assets/user_profile/'; // upload directory
                $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
                // valid image extensions
                $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
                // rename uploading image
                $usrimg = rand(1000, 1000000).".".$imgExt;
                
                // allow valid image file formats
                if(in_array($imgExt, $valid_extensions)){
                    // Check file size '5MB'
                    if($imgSize < 5000000){
                        move_uploaded_file($tmp_dir,$upload_dir.$usrimg);
                        $statement = $DB_con->prepare("INSERT INTO personnel(profpic, firstname, lastname, email , created_at) 
                            VALUES (:profpic, :firstname, :lastname, :email, :date) ");
                        $statement->bindValue(':profpic',$usrimg);
                        $statement->bindValue(':firstname',$firstname);
                        $statement->bindValue(':lastname',$lastname);
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
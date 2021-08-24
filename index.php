<?php
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];

    $upload_dir = '../assets/img/user_profile/'; // upload directory
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
            $errMSG = "Sorry, your file is too large.";
        }
    }
    else{
        $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
    
?>
blob
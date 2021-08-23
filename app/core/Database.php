<?php
    include "Application.php"; //Connect to wrs_db
?>

<?php
    //Create Perosnnel Table if not exist in wrs_db
    try{
        $SQL = "CREATE TABLE IF NOT EXISTS personnel(
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            fname VARCHAR(255) NOT NULL,
            lname VARCHAR(255) NOT NULL,
            email Varchar(70) NOT NULL UNIQUE
            /*uname VARCHAR(25) NOT NULL
            pword VARCHAR(16)*/
            )";
        $PDO->exec($SQL);
        echo "Table created successfully" . '<br>';
    } catch (PDOException $error){
        die("Error creating table $SQL." . $error->getMessage());
    }

    /*try{
        $SQL = "INSERT INTO personnel (fname, lname, email) VALUES 
                ('James', 'Marañon', 'jamesmaranon@gmail.com')";
        $PDO->exec($SQL);
        echo "Record inserted successfully" . '<br>';
    } catch (PDOException $error){
        die("Error inserting record $SQL." . $error->getMessage());
    }*/
    

    $statement = $PDO->prepare('SELECT * FROM personnel ORDER BY lname ASC');
    $statement->execute();
    $personnel = $statement->fetchall(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Table(Insert Data in Database)</title>
</head>
<body>
    <h1>Personnel Table (version .1000)</h1>

    <p>
        <a href="../controllers/create_new_personnel.php" type="button" class="btn btn-success">Create Profile</a>
    </p>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personnel as $i => $personnel): //$i is for index ?> 
                <tr>
                    <th scope="row"><?php echo $i//increment, index start 1?></th>
                    <td><?php echo $personnel['fname'] ?></td>
                    <td><?php echo $personnel['lname'] ?></td>
                    <td><?php echo $personnel['email'] ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
                        <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
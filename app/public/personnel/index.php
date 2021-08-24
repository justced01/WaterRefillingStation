<?php   
    require_once "../../core/Application.php"; //Connect to wrs_db

    //search
    $search = $_GET['search'] ?? '';
    if ($search) {
        $statement = $PDO->prepare('SELECT * FROM personnel WHERE lname LIKE :lname ORDER BY created_at DESC');
        $statement->bindValue(':lname',"%$search%");
    } else {
        $statement = $PDO->prepare('SELECT * FROM personnel ORDER BY created_at DESC');
    }
    $statement->execute();
    $personnel = $statement->fetchall(PDO::FETCH_ASSOC);
?>

<?php include_once "../../views/personnel/header.php" ?>

    <h1>Personnel Table (version 1.1)</h1>

    <p>
        <a href="addpersonnel.php" type="button" class="btn btn-success">Create Profile</a>
    </p>

    <form>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Personnel's Last Name" name="search" value="<?php echo $search ?>">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Profile Picture</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personnel as $i => $personnel): //$i is for index ?> 
                <tr>
                    <th scope="row"><?php echo $i//increment, index start 1?></th>
                    <td><?php echo $personnel['profilepic'] ?></td>
                    <td><?php echo $personnel['fname'] ?></td>
                    <td><?php echo $personnel['lname'] ?></td>
                    <td><?php echo $personnel['email'] ?></td>
                    <td><?php echo $personnel['created_at'] ?></td>
                    <td>
                        <a href="updatepersonnel.php?id=<?php echo $personnel['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form style="display: inline-block" method="post" action="deletepersonnel.php">
                            <input type="hidden" name="id" value="<?php echo $personnel['id']?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
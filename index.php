<!DOCTYPE>
<html>
    <head>
        <title>GrabJobs</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php require_once 'process.php'; ?>
        
        <?php
        if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
        </div>
        <?php endif ?>

        <div class="container">
        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'grabjobs') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM users");
        ?>
            
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['created']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id'] ?>"
                            class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        
        <div class="row justify-content-center">
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                    <label>Description</label>
                    <input type ="text" name="description" class="form-control" value="<?php echo $description; ?>" placeholder="enter your description">
                    </div>
                    <div class="form-group">
                    <label>Created</label>
                    <input type="date" name="created" class="form-control" value="<?php echo date("Y-m-d", strtotime($date)); ?>" placeholder="enter the date">
                    </div>
                    <div class="form-group">
                    <?php if ($update == true): ?>
                        <button type="submit" class="btn btn-info" name="update">Update</button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                    <?php endif ?>
                    </div>
        </div>
    </body>
</html>
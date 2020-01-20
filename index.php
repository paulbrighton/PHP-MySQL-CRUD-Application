<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP MySQL CRUD Application with Bootstrap</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $db = 'crud';

  $mysqli = new mysqli($servername, $username, $password, $db) or die(mysqli_error($mysqli));
  $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
  // pre_r($result);
  ?>
  <div class="container">
    <header class="text-center mb-5 mt-5">
      <h1>PHP MySQL CRUD Application</h1>
    </header>
    <div class="row justify-content-center mb-5">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Location</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <?php 
          while ($row = $result->fetch_assoc()): ?>

          <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td>
              <a href="index.php?edit=<?php echo $row['id']; ?>"
              class="btn btn-info">Edit</a>
              <a href="index.php?delete=<?php echo $row['id']; ?>"
              class="btn btn-danger">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>
  </div>

  <?php

  function pre_r($array)
  {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
  }
  ?>

  <div class="justify-content-center container" >
  <h2 class="mb-5">Please fill out the form with your name and location and press save to be added to the list.</h2>
    <form action="process.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Enter your name" required>
      </div>
      <div class="form-group">
        <label>Location</label>
        <input type="text" class="form-control" name="location" value="<?php echo $location; ?>" placeholder="Enter your location" required>
      </div>

      <div class="form-group">
        <?php if ($update == true): ?>
          <button class="btn btn-primary" type="submit" name="update">Update</button>
        <?php else: ?>
          <button class="btn btn-primary" type="submit" name="save">Save</button>
        <?php endif; ?>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
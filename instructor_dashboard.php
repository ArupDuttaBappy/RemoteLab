<?php
session_start();
include 'config.php';
$this_userid = $_SESSION['this_userid'];

$name_row = mysqli_fetch_array(mysqli_query($con,"SELECT `password` FROM `instructor_login` WHERE userid='$this_userid'"));

$this_name = $name_row['password'];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Instructor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="container-fluid">
        <!-- profile card -->
        <div class="card text-center">
          <div class="card-header">
            Instructor Profile
          </div>
          <div class="card-body">
            <h5 class="card-title"><?php echo $this_name ?></h5>
            <p class="card-text">Department of Computer Science & Engineering,<br> University of Chittagong.</p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

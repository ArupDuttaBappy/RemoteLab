<?php
session_start();
include 'config.php';
$this_userid = $_SESSION['this_userid'];

$name_row = mysqli_fetch_array(mysqli_query($con,"SELECT `student_name` FROM `student_login` WHERE userid='$this_userid'"));

$this_name = $name_row['student_name'];

// $assignment_rows_count = mysqli_num_rows(mysqli_query($con,"SELECT `assignment_name`, `description`, `due_date` FROM `assignment_list` WHERE userid='$this_userid'"));
//
// $assignment_rows = mysqli_fetch_array(mysqli_query($con,"SELECT `assignment_name`, `description`, `due_date` FROM `assignment_list` WHERE userid='$this_userid'"));

$assignment_query = "SELECT `assignment_name`, `description`, `due_date` FROM `assignment_list` WHERE userid='$this_userid'";
$assignment_data = mysqli_query($con,$assignment_query);
$total_assignment = mysqli_num_rows($assignment_data);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
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
            Lab Profile
          </div>
          <div class="card-body">
            <h5 class="card-title"><?php echo $this_name ?></h5>
            <p class="card-text">Department of Computer Science & Engineering,<br> University of Chittagong.</p>
            <a href="#" class="btn btn-primary">Next Assignment</a>
          </div>
          <div class="card-footer text-muted">
            Total Assignments = <?php echo $total_assignment ?>
          </div>
        </div>

        <?php
        while($assignment_result = mysqli_fetch_assoc($assignment_data))
        {
          echo "
          <div class='jumbotron py-2 pl-3'>
          <h3>".$assignment_result['assignment_name']."</h3>
          <p>".$assignment_result['description']."</p></div>
          ";
        }
        ?>
      </div>
    </div>
  </body>
</html>

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

$download_assignment_query = mysqli_fetch_array(mysqli_query($con,"SELECT `question` FROM `assignment_list` WHERE userid='$this_userid'"));
$download_assignment_query_result = $download_assignment_query['question'];

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
  <body class="bg-light">
    <div class="container">
      <div class="container-fluid">
        <!-- profile card -->
        <div class="card text-center">
          <div class="card-header h3 bg-info text-white">
            Lab Profile [ <?php echo $this_userid ?> ]
          </div>
          <div class="card-body">
            <h4 class="card-title font-weight-bold" style="font-weight:bold"> Name: <?php echo $this_name ?></h4>
            <p class="card-text" style="font-size:18px">Department of Computer Science & Engineering,<br> University of Chittagong.</p>
            <a href="#" class="btn btn-secondary">Next Assignment</a>
          </div>
          <div class="card-footer" style="font-weight:bold">
            Total Assignments = <?php echo $total_assignment ?>
          </div>
        </div>

        <?php
        while($assignment_result = mysqli_fetch_assoc($assignment_data))
        {
          echo "
          <div class='jumbotron py-2 pl-3 border border-info rounded'>
          <h4 style='font-weight:bold'>".$assignment_result['assignment_name']."</h4>
          <h4>Description: ".$assignment_result['description']."</h4>
          <form class='' method='post' enctype='multipart/form-data'>
          <div class='row'>
          <div class='col-3'>
          <a style='width:100px' class='btn btn-secondary' href='pdf/".$download_assignment_query_result."' type='submit' name='download'>Download</a>
          </div>
          <div class='col-6 text-right'>
          <input class='btn btn-secondary py-1' type='submit' name='submit' value='Submit'>
          </div>
          <div class='col-3'>
          <input type='file' name='pdf'>
          </div>
          </div>
          </form>
          </div>
          ";
        }
        ?>
      </div>
    </div>

    <?php
    if(isset($_POST['submit'])){
      $pdf = $_FILES['pdf']['name'];
      $pdf_type = $_FILES['pdf']['type'];
      $pdf_size = $_FILES['pdf']['size'];
      $pdf_tmp_loc = $_FILES['pdf']['tmp_name'];
      $pdf_store = "pdf/".$pdf;
      move_uploaded_file($pdf_tmp_loc, $pdf_store);

      $submit_assignment_query = "UPDATE `assignment_list` SET `answer`='$pdf' WHERE userid='$this_userid'";
      $submit_assignment_query = mysqli_query($con,$submit_assignment_query);
    }

     ?>

  </body>
</html>

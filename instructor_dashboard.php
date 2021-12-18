<?php
session_start();
include 'config.php';
$this_userid = $_SESSION['this_userid'];

$name_row = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `instructor_login` WHERE userid='$this_userid'"));

$this_name = $name_row['instructor_name'];

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

    <style media="screen">

    </style>
  </head>
  <body class="bg-info">
    <div class="container">
      <div class="container-fluid">
        <!-- Instructor card -->
        <div class="card text-center">
          <div class="card-header p-2" style="font-weight:bold; font-size:18px">
            Instructor Workspace
          </div>
          <div class="card-body">
            <h5 class="card-title" style="font-weight:bold; font-size:20px"><?php echo $this_name ?></h5>
            <p class="card-text">Department of Computer Science & Engineering,<br> University of Chittagong.</p>
          </div>
        </div>

        <!-- Workspace Operations -->
        <div class="row text-center">
          <div class="col-6 py-3">
            <div class="card m-3" style="width:100%; height:30vh">
              <div class="card-body">
                <h4 class="card-title pb-3 mb-4 border-bottom border-info" style="font-weight:bold">Assignments</h4>
                <button type="button" class="btn btn-primary btn-lg btn-block">Previous Assignments</button>
                <button type="button" data-toggle="modal" data-target="#addAssignmentModal" class="btn btn-warning btn-lg btn-block">Add Assignment</button>
              </div>
            </div>
          </div>
          <div class="col-6 py-3">
            <div class="card m-3" style="width:96%; height:30vh">
              <div class="card-body">
                <h4 class="card-title pb-3 mb-4 border-bottom border-info" style="font-weight:bold">Submissions</h4>
                <button type="button" class="btn btn-success btn-lg btn-block">View Submissions</button>
                <button type="button" class="btn btn-secondary disabled btn-lg btn-block">Evaluate Submissions</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-6 py-3">
            <div class="card m-3" style="width:100%; height:30vh">
              <div class="card-body">
                <h4 class="card-title pb-3 mb-4 border-bottom border-info" style="font-weight:bold">Calculate Grade</h4>
                <button type="button" class="btn btn-secondary disabled btn-lg btn-block">View Marks</button>
                <button type="button" class="btn btn-secondary disabled btn-lg btn-block">Final Grading System</button>
              </div>
            </div>
          </div>
          <div class="col-6 py-3">
            <div class="card m-3" style="width:96%; height:30vh">
              <div class="card-body">
                <h4 class="card-title pb-3 mb-4 border-bottom border-info" style="font-weight:bold">Publish Result</h4>
                <button type="button" class="btn btn-secondary disabled btn-lg btn-block">Set a Date</button>
                <button type="button" class="btn btn-secondary disabled btn-lg btn-block">Publish Now</button>
              </div>
            </div>
          </div>
        </div>


        <!-- Add Assignment modal -->
        <div class="modal fade" id="addAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="addAssignmentModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title float-center" id="exampleModalLabel">New Assignment</h4>
              </div>
              <form method="POST" enctype='multipart/form-data'>
                <div class="modal-body">
                  <div class="form-group">
                    <label>Assignment Name</label>
                    <input type="text" class="form-control" name="addAssignmentName" id="addAssignmentName">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="addAssignmentDescription" id="addAssignmentDescription" rows="2"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Assign To</label>
                    <input type="text" class="form-control" name="addAssignmentTo" id="addAssignmentTo">
                  </div>
                  <div class="form-group">
                    <label>Add File</label>
                    <input type="file" class="form-control-file" name="addAssignmentFile" id="addAssignmentFile">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="addAssignment" class="btn btn-primary">ADD</button>
                </div>
              </form>
            </div>
          </div>
        </div>



      </div>
    </div>


    <?php

    if(isset($_POST['addAssignment']))
    {
      $assignment_name = $_POST['addAssignmentName'];
      $description = $_POST['addAssignmentDescription'];
      $userid = $_POST['addAssignmentTo'];

      // question file upload
      $addAssignmentFile = $_FILES['addAssignmentFile']['name'];
      $addAssignmentFile_type = $_FILES['addAssignmentFile']['type'];
      $addAssignmentFile_size = $_FILES['addAssignmentFile']['size'];
      $addAssignmentFile_tmp_loc = $_FILES['addAssignmentFile']['tmp_name'];
      $addAssignmentFile_store = "files/questions/".$addAssignmentFile;
      move_uploaded_file($addAssignmentFile_tmp_loc, $addAssignmentFile_store);
      //

      mysqli_query($con,"INSERT INTO assignment_list (`assignment_name`,`description`,`userid`,`question`) VALUES ('$assignment_name','$description','$userid','$addAssignmentFile')");
    }

    ?>

  </body>
</html>

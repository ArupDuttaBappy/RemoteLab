<?php
  session_start();
  include 'config.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>RemoteLab</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
  </head>

  <body>
    <div class="container">
    	<div class="header">
    		<h2>Login</h2>
    	</div>
    	<form id="form" class="form" method="post">
    		<div class="form-control">
    			<label for="userid">User ID</label>
    			<input type="text" id="userid" name="userid"/>
    		</div>
    		<div class="form-control">
    			<label for="userid">Password</label>
    			<input type="password" id="password" name="password"/>
    		</div>
        <input name="student_login" type="submit" class="login_button" value="Student Login">
        </input>
        <input name="instructor_login" type="submit" class="login_button" value="Instructor Login">
        </input>
    	</form>

      <!-- student login -->
      <?php
      if(isset($_POST['student_login'])){
    		$userid = $_POST['userid'];
    		$password = $_POST['password'];
    		$check = "select * from student_login where userid='$userid' AND password ='$password'";
    		$check_work= mysqli_query($con,$check);

    		if($check_work){
    			if(mysqli_num_rows($check_work) > 0 ){

    				echo"
    				<script>
    				alert('Logged in as Student Successfully');
    				window.location.href='student_dashboard.php';
    				</script>
    				";
  			}else{
  				echo"
  				<script>
  				alert('Password or Email not Found ');
  				</script>
  				";
  			}
    		}else{
    				echo"
    				<script>
    				alert('Database Error');
    				</script>
    				";
    		}
  	  }
      ?>

      <!-- instructor login -->
      <?php
      if(isset($_POST['instructor_login'])){
    		$userid = $_POST['userid'];
    		$password = $_POST['password'];
    		$check = "select * from instructor_login where userid='$userid' AND password ='$password'";
    		$check_work= mysqli_query($con,$check);

    		if($check_work){
    			if(mysqli_num_rows($check_work) > 0 ){

    				echo"
    				<script>
    				alert('Logged in as Instructor Successfully');
    				window.location.href='instructor_dashboard.php';
    				</script>
    				";
  			}else{
  				echo"
  				<script>
  				alert('Password or Email not Found ');
  				</script>
  				";
  			}
    		}else{
    				echo"
    				<script>
    				alert('Database Error');
    				</script>
    				";
    		}
  	  }

      $_SESSION['this_userid'] = isset($_POST['userid']) ? $_POST['userid'] : '';

      ?>

    </div>
  </body>
</html>

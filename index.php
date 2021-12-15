<?php
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
    			<i class="fas fa-check-circle"></i>
    			<i class="fas fa-exclamation-circle"></i>
    			<small></small>
    		</div>
    		<div class="form-control">
    			<label for="userid">Password</label>
    			<input type="password" id="password" name="password"/>
    			<i class="fas fa-check-circle"></i>
    			<i class="fas fa-exclamation-circle"></i>
    			<small></small>
    		</div>
    		<!-- <button type="submit" name="submit">Submit</button> -->
        <input name="login" type="submit" id="button" value="LOGIN">
        </input>
    	</form>


      <?php
      if(isset($_POST['login'])){

  		$userid = $_POST['userid'];
  		$password = $_POST['password'];

  		$check = "select * from student_login where userid='$userid' AND password ='$password'";
  		$check_work= mysqli_query($con,$check);

  		if($check_work){
  			if(mysqli_num_rows($check_work) > 0 ){

  				echo"
  				<script>
  				alert('You are Successfully Logged in');
  				window.location.href='dashboard.php';
  				</script>
  				";

  			}else{
  				echo"
  				<script>
  				alert('Password or Email not Found ');
  				window.location.href='dashboard.php';
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

    </div>

    <script src="index.js"></script>
  </body>
</html>

<?php
	include('../database/db_connection.php');
	include('../libaries/auth.php');
	$error = 0;
	$ms = "";
	if(isset($_GET['action']))
	{
		$action = $_GET['action'];
		switch($action){
			case 'login':
				$email = $_POST['txt_email'];
				$pwd = $_POST['txt_pwd'];
				$role = $_POST['txt_role'];
				$result = checkUser($email,$pwd,$role);
				if($result)
				{
					switch ($_SESSION['role'])
					{
						case '1':
							if($_SESSION['status'] == 0)
							{
								$error = 1;
								$ms = "This user is disabled !";
							}
							else
							{
								header("location:../Sale/index.php?page=Sale");
								exit();
								break;
							}
							
						case '2':
							if($_SESSION['status'] == 0)
							{
								$error = 1;
								$ms = "This user is disabled !";
							}
							else
							{
								header("location:../stock/index.php?page=stock");
								exit();
							}
							
							break;
						case '3':
							if($_SESSION['status'] == 0)
							{
								$error = 1;
								$ms = "This user is disabled !";
							}
							else
							{
								header("location:../index.php?page=Admin");
								exit();
							}
							break;
					}
				}
				else{
					$error = 1;
					$ms = "Invalid email, password or role, Please login again !";
				}
			break;
			case 'logout':
				logOut();
				break;
			
		}
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Liquor Store</title>
	  <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
  </head>
  <body>
	  <div class="container w-50 mb-4 mt-5 text-center">
		  <img src="../assets/images/logo-icon.png" width="100px">
		  <h1 class="mt-3"><strong>LIQUOR</strong> STORE</h1>
	  </div>
	  <div class="container text-center mt-5">
		  <box-icon name='lock-open-alt' type='solid' size='lg'></box-icon>
		  <h3>User Login</h3>
	  </div>
   <div class="container w-50 mt-3">
   <?php
	 	if($error == 1)
		 {
	   ?>
	   	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Your Message !</strong> <?=$ms?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>
	   <?php
		 }
	   ?>
		<form action="login.php?page=login&action=login" method="post">
		  <div class="form-group">
			<label for="email"><strong>Email address:</strong></label>
			<input type="email" name="txt_email" class="form-control" placeholder="Enter email" id="email" required>
		  </div>
		  <div class="form-group">
			<label for="pwd"><strong>Password:</strong></label>
			<input type="password" name="txt_pwd" class="form-control" placeholder="Enter password" id="pwd" required>
		  </div>
		<div class="form-group">
			<label for="pwd"><strong>User Role:</strong></label>
			<select class="form-control" required name="txt_role">
				<option>---Select---</option>
				<option value='1'>Sale</option>
				<option value='2'>Stock</option>
				<option value='3'>Admin</option>
			</select>
		  </div>
		  	<button type="submit" class="btn btn-primary w-25 mt-4">Login</button>
			<button type="reset" class="btn btn-danger w-25 mt-4">Clear</button>
		</form>
	  </div>
	  <div class="container w-50 mt-5">
		  <p class="text-primary">If you <strong>forget email or password</strong> Please contact to admin user</p>
	  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
            if (window.history.replaceState ) {
                window.history.replaceState( null, null, "login.php?page=login");  
            }
   </script>  
</body>
</html>
<?php
	mysqli_close($conn);
?>
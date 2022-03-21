<?php
    include('database/db_connection.php');
	$message =-1;
	$messageDailog ="";
	if(isset($_GET['action']))
	{
		$action = $_GET['action'];
		switch($action){
			case '1':
				if(isset($_GET['id']))
				{
					$id = $_GET['id'];
					$sql = "UPDATE `tbl_user` SET `status`='0' WHERE `id`=$id";
					$runsql = mysqli_query($conn,$sql);
					if($runsql)
					{
						$message =1;
						$messageDailog = "User disabled is successfully...";
					}
					else
					{
						$message =0;
						$messageDailog = "User disabled is not successfully...";	
					}
				}
				break;
			case '2':
				if(isset($_GET['id']))
				{
					$id = $_GET['id'];
					$sql = "UPDATE `tbl_user` SET `status`='1' WHERE `id`=$id";
					$runsql = mysqli_query($conn,$sql);
					if($runsql)
					{
						$message =1;
						$messageDailog = "User enabled is successfully...";
					}
					else
					{
						$message =0;
						$messageDailog = "User enabled is not successfully...";	
					}
				}
				break;
			case '3':
				if(isset($_GET['id']))
				{
					$id = $_GET['id'];
					$sql = "UPDATE `tbl_user` SET `gender`='0' WHERE `id`=$id";
					$runsql = mysqli_query($conn,$sql);
					if($runsql)
					{
						$message =1;
						$messageDailog = "User changed gender to female is successfully...";
					}
					else
					{
						$message =0;
						$messageDailog = "User changed gender to female is not successfully...";	
					}
				}
				break;
			case '4':
				if(isset($_GET['id']))
				{
					$id = $_GET['id'];
					$sql = "UPDATE `tbl_user` SET `gender`='1' WHERE `id`=$id";
					$runsql = mysqli_query($conn,$sql);
					if($runsql)
					{
						$message =1;
						$messageDailog = "User changed gender to male is successfully...";
					}
					else
					{
						$message =0;
						$messageDailog = "User changed gender to male is not successfully...";	
					}
				}
				break;
			case '5':
				if(isset($_GET['id']))
				{
					$id = $_GET['id'];
					$sql = "UPDATE `tbl_user` SET `role`='2' WHERE `id`=$id";
					$runsql = mysqli_query($conn,$sql);
					if($runsql)
					{
						$message =1;
						$messageDailog = "User updated role is successfully...";
					}
					else
					{
						$message =0;
						$messageDailog = "User updated role is not successfully...";	
					}
				}
				break;
			case '6':
				if(isset($_GET['id']))
				{
					$id = $_GET['id'];
					$sql = "UPDATE `tbl_user` SET `role`='3' WHERE `id`=$id";
					$runsql = mysqli_query($conn,$sql);
					if($runsql)
					{
						$message =1;
						$messageDailog = "User updated role is successfully...";
					}
					else
					{
						$message =0;
						$messageDailog = "User updated role is not successfully...";	
					}
				}
				break;
			case '7':
				if(isset($_GET['id']))
				{
					$id = $_GET['id'];
					$sql = "UPDATE `tbl_user` SET `role`='1' WHERE `id`=$id";
					$runsql = mysqli_query($conn,$sql);
					if($runsql)
					{
						$message =1;
						$messageDailog = "User updated role is successfully...";
					}
					else
					{
						$message =0;
						$messageDailog = "User updated role is not successfully...";	
					}
				}
				break;
			case '8':
				if(isset($_GET['id']))
				{
					if(isset($_GET['img']))
					{
						$id = $_GET['id'];
						$imagePath = $_GET['img'];
						$path = "images/userImage/".$imagePath;
						$paththumbnail = "images/userImage/thamnail/".$imagePath;
						$trimpaththumbnail = trim($paththumbnail,"");
						$trimpath = trim($path,"");
						if(file_exists($trimpath) && file_exists($trimpaththumbnail))
						{
							$sql ="DELETE FROM `tbl_user` WHERE `id`=$id";
							$runsql = mysqli_query($conn,$sql);
							if($runsql)
							{
								$message =1;
								$messageDailog = "User Deleted is successfully...";
								unlink($trimpath);
								unlink($trimpaththumbnail);
							}
							else
							{
								$message =0;
								$messageDailog = "User Deleted is not successfully...";
							}
						}
						elseif(file_exists($trimpath) && !file_exists($trimpaththumbnail))
						{
							$sql ="DELETE FROM `tbl_user` WHERE `id`=$id";
							$runsql = mysqli_query($conn,$sql);
							if($runsql)
							{
								$message =1;
								$messageDailog = "User Deleted is successfully...";
								unlink($trimpath);
							}
							else
							{
								$message =0;
								$messageDailog = "User Deleted is not successfully...";
							}
						}
						elseif(!file_exists($trimpath) && file_exists($trimpaththumbnail))
						{
							$sql ="DELETE FROM `tbl_user` WHERE `id`=$id";
							$runsql = mysqli_query($conn,$sql);
							if($runsql)
							{
								$message =1;
								$messageDailog = "User Deleted is successfully...";
								unlink($trimpaththumbnail);
							}
							else
							{
								$message =0;
								$messageDailog = "User Deleted is not successfully...";
							}
						}
						else
						{
							$sql ="DELETE FROM `tbl_user` WHERE `id`=$id";
							$runsql = mysqli_query($conn,$sql);
							if($runsql)
							{
								$message =1;
								$messageDailog = "User Deleted is successfully...";
							}
							else
							{
								$message =0;
								$messageDailog = "User Deleted is not successfully...";
							}
						}
						
					}
				}
				break;
			case '9':
				if(isset($_GET['id']))
				{
					$id = $_GET['id'];
					$sql = "SELECT * FROM `tbl_user` WHERE `id`=$id";
					$runsql = mysqli_query($conn,$sql);
					$data = mysqli_fetch_array($runsql);
					
					$fname = $data['fistName'];
					$lname = $data['lastName'];
					$dob = $data['dob'];
					$email = $data['email'];
					$pwd = $data['password'];
					$address = $data['address'];
					$img = $data['image'];
				}
				break;
			case '10':
				if(isset($_POST['txt_ID']))
				{
					$id = $_POST['txt_ID'];
					
					$fname = $_POST['txt_fname'];
					$lname = $_POST['txt_lname'];
					$dob = $_POST['txt_dob'];
					$email = $_POST['txt_email'];
					$password = $_POST['txt_pwd'];
					$address = $_POST['txt_address'];
					
					$image = $_POST['OldImg'];
					if(isset($_FILES['txt_image']))
					{
						$allowedtype = array('jpg','png','jpeg');
						 $imagetype = pathinfo($_FILES['txt_image']['name'],PATHINFO_EXTENSION);
						 if(!in_array($imagetype,$allowedtype))
						 {
							 $message =0;
							$messageDialog = "This file type is not allowed !";
						 }
						 else
						 {
							$image = time().basename($_FILES['txt_image']['name']);
							$part = "images/userImage/".$image;
							move_uploaded_file($_FILES['txt_image']['tmp_name'],$part);
							$nw=50;
							$nh=50;
							$thumbnail = imagecreatetruecolor($nw,$nh);
							$source; //= imagecreatefromjpeg($part);
							if($imagetype == 'jpg' or $imagetype == 'jpeg')
							{
								$source = imagecreatefromjpeg($part);
							}
							elseif($imagetype == 'png')
							{
								$source = imagecreatefrompng($part);
							}
							list($w,$h,$t) = getimagesize($part);
							imagecopyresized($thumbnail,$source,0,0,0,0,$nw,$nh,$w,$h);
							imagejpeg($thumbnail,"images/userImage/thamnail/".$image);
							
							$imgpath = $_POST['OldImg'];
							$path = "images/userImage/".$imgpath;
							$paththumbnail = "images/userImage/thamnail/".$imgpath;
							$trmpath = trim($path);
							$trmpathThumbnail = trim($paththumbnail);
							unlink($trmpath);
							unlink($trmpathThumbnail);
								
						 }
					}
					$sql = "UPDATE `tbl_user` SET `image`='$image',`fistName`='$fname',`lastName`='$lname',`dob`='$dob',`email`='$email',`password`='$password',`address`='$address' WHERE `id` = $id";
					$runsql = mysqli_query($conn,$sql);
					if($runsql)
					{
						$message=1;
						$messageDailog = "User updated is successfully...";
					}
					else
					{
						$message=0;
						$messageDailog = "User updated is not successfully...";
					}
				}
				break;
		}
	}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <?php
        include 'include/head.php';
    ?>
	    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
</head>
<body>

    <?php
        include 'include/pageLorder.php';
    ?>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php
            include 'include/navbar.php';
            include 'include/sidebar.php';
        ?>

        <div class="page-wrapper">
        <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">LIST USERS</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                        <li class="breadcrumb-item"><a href="user.php?page=user">Create User</a>
                                        <li class="breadcrumb-item"><a href="listUser.php?page=listUser">List User</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
				<?php
					if($message == 1)
					{
				?>
					<div class="alert alert-success" role="alert">
					  <h4 class="alert-heading">Success !</h4>
					  <p><?=$messageDailog?></p>
					  <hr>
					</div>
				<?php
					}
					elseif($message == 0)
					{
				?>
					<div class="alert alert-danger" role="alert">
					  <h4 class="alert-heading">Error !</h4>
					  <p><?=$messageDailog?></p>
					  <hr>
					</div>
				<?php
					}
				?>
				<?php
					if(isset($_GET['action']) && $_GET['action']== 9)
					{
				?>
				<strong><h1>UPDATE USER</h1></strong>
				<div class="mt-4">
					
					<form method="post" enctype="multipart/form-data" action="listUser.php?page=listUser&action=10">
						<input type="hidden" value="<?=$id?>" name="txt_ID">
						<input type="hidden" value="<?=$img?>" name="OldImg">
						<div class="row">
							<div class="rounded mb-4 img-thumbnail col col-lg-3" style="width:200px;height:200px;">
								<img id="previewImg" src="images/userImage/<?=$img?>" alt="Preview Image" width="100%" height="100%" class="rounded">
								<div class="input-group mt-2">
									<div class="custom-file">
										<input type="file" name="txt_image" class="custom-file-input" onchange="previewFile(this);" id="customFile"/>
										<input type="button" class="custom-file-label btn bg-danger text-white w-100" value="Upload New Image" for="customFile">
									</div>
								</div>
                        	</div>
							<div class="col">
								<div class="row mt-4">
									<div class="col">
										<label class="form-label" for="fname">First Name:</label>
										<input type="text" name="txt_fname" id="fname" class="form-control" value="<?=$fname?>" placeholder="Update first name" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
									</div>
									<div class="col">
										<label class="form-label" for="lname">Last Name:</label>
										<input type="text" name="txt_lname" id="lname" class="form-control" value="<?=$lname?>" placeholder="Update last name" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
									</div>
									<div class="col">
										<label class="form-label" for="dob">Date Of Birth:</label>
										<input type="date" name="txt_dob" id="dob" class="form-control" value="<?=$dob?>" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
									</div>
								</div>
								<div class="row mt-4">
									<div class="col">
										<label class="form-label" for="mail">Email:</label>
										<input type="email" name="txt_email" id="mail" class="form-control" value="<?=$email?>" placeholder="Update email" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
									</div>
									<div class="col">
										<label class="form-label" for="pwd">Password:</label>
										<input type="password" name="txt_pwd" id="pwd" class="form-control" value="<?=$pwd?>" placeholder="Update password" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<label for="address" class="form-label">Address:</label>
								<textarea rows="5" class="form-control" id="address" name="txt_address" placeholder="Update address" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"><?=$address?></textarea>
							</div>
						</div>
						<div class="mt-4">
							<button type="submit" class="btn btn-primary w-25">Update</button>
							<button type="reset" class="btn btn-danger w-25">Clear</button>
						</div>
					</form>
				</div>
			<?php
					}
					else
					{
				?>
               <table id="list" class="table table-primary">
                   <thead>
                       <th class="text-center">Image</th>
                       <th class="text-center">Name</th>
                       <th class="text-center">Gender</th>
                       <th class="text-center">Role</th>
                       <th class="text-center">Status</th>
                       <th class="text-center">Action</th>
                   </thead>
                   <tbody>
                    <?php
                    $i=1;
                        $sql = "SELECT * FROM `tbl_user`";
                        $runsql = mysqli_query($conn,$sql);
                        while($rows = mysqli_fetch_array($runsql))
                        {
                    ?>
                       <tr>
                           <td class="text-center">
                               <img src="images/userImage/thamnail/<?=$rows['image']?>" class="rounded-circle">
                            </td>
                           <td><?=$rows['fistName']." ".$rows['lastName']?></td>
                           <td class="text-center">
                                <?php
                                    if($rows['gender'] == 1)
                                    {
                                ?>
                                    <a href="listUser.php?page=listUser&action=3&id=<?=$rows['id']?>" class="btn btn-info w-100">Male <i class="fa fa-undo" aria-hidden="true"></i></a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <a href="listUser.php?page=listUser&action=4&id=<?=$rows['id']?>" class="btn btn-warning w-100">Female <i class="fa fa-undo" aria-hidden="true"></i></a>
                                <?php
                                    }
                                ?>
                           </td>
                           <td class="text-center">
							   
                               <?php
                                    if($rows['role'] == 1)
                                    {
								?>
							   		<div class="dropdown">
									  <button class="btn btn-danger w-100 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Sale <i class="fas ml-2 fa-sort-down"></i>
									  </button>
									  <div class="dropdown-menu bg-dark p-1" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item " href="listUser.php?page=listUser&action=5&id=<?=$rows['id']?>">Stock</a>
										<a class="dropdown-item" href="listUser.php?page=listUser&action=6&id=<?=$rows['id']?>">Admin</a>
									  </div>
									</div>
							   	<?php
                                    }
									elseif($rows['role'] == 2)
                                    {
								?>
							   		<div class="dropdown">
									  <button class="btn btn-success w-100 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Stock <i class="fas ml-2 fa-sort-down"></i>
									  </button>
									  <div class="dropdown-menu bg-dark p-1" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="listUser.php?page=listUser&action=7&id=<?=$rows['id']?>">Sale</a>
										<a class="dropdown-item" href="listUser.php?page=listUser&action=6&id=<?=$rows['id']?>">Admin</a>
									  </div>
									</div>
                                   <?php
                                    }
									else
                                    {
									?>
                                    <div class="dropdown">
									  <button class="btn btn-primary w-100 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Admin <i class="fas ml-2 fa-sort-down"></i>
									  </button>
									  <div class="dropdown-menu bg-dark p-1" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="listUser.php?page=listUser&action=7&id=<?=$rows['id']?>">Sale</a>
										<a class="dropdown-item" href="listUser.php?page=listUser&action=5&id=<?=$rows['id']?>">Stock</a>
									  </div>
									</div>
							  		<?php
                                    }
									?>
                           </td>
                           <td class="text-center">
                               <?php
                                    if($rows['status'] == 1)
                                    {
                               ?>
                                <a href="listUser.php?page=listUser&action=1&id=<?=$rows['id']?>" class="btn btn-success w-100">Enable <i class="fa fa-undo" aria-hidden="true"></i></a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                <a href="listUser.php?page=listUser&action=2&id=<?=$rows['id']?>" class="btn btn-warning w-100">Disable <i class="fa fa-undo" aria-hidden="true"></i></a>
                                <?php
                                    }
                                ?>
                           </td>
                           <td class="text-center">
							   		<a href="#">
										<box-icon type='solid' name='user-detail' data-toggle="modal" data-target="#UserModal<?=$rows['id']?>"></box-icon>
							   		</a>
                           			<a href="listUser.php?page=listUser&action=9&id=<?=$rows['id']?>">
										<box-icon name='edit' type='solid'></box-icon>
									</a>
									<a href="#">
										<box-icon name='trash' data-toggle="modal" data-target="#deleteModal<?=$rows['id']?>"></box-icon>
									</a>
                           </td>
                       </tr>

<!-- Modal user detail -->
<div class="modal fade" id="UserModal<?=$rows['id']?>" tabindex="-1" role="dialog" aria-labelledby="UserModal<?=$rows['id']?>" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="UserModal<?=$rows['id']?>">USER INFORMATION</h2>
      </div>
      <div class="modal-body ">
 			<div class="row">
				<div class="col-4 rounded img-thumbnai text-center">
					<img src="images/userImage/<?=$rows['image']?>" width="200" height="200" style="border-radius: 10px">
				</div>
				<div class="col">
					<div class="row">
						<div class="col">
							<label for="name" class="form-label">Fist Name:</label>
							<input type="text" value="<?=$rows['fistName']?>" class="form-control" disabled>
						</div>
						<div class="col">
							<label for="name" class="form-label">Last Name:</label>
							<input type="text" value="<?=$rows['lastName']?>" class="form-control" disabled>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<label for="dob" class="form-label">Date Of Birth:</label>
							<input type="text" value="<?=$rows['dob']?>" class="form-control" disabled>
						</div>
						<div class="col">
							<label for="gender" class="form-label">Gender:</label>
							<?php
								$gen = "";
								$gentype = $rows['gender'];
								if($gentype == 1)
								{
									$gen = "Male";
								}
								else{
									$gen = "Female";
								}
							?>
							<input type="text" value="<?=$gen?>" class="form-control" disabled>
						</div>
					</div>
				</div>
		  	</div>
		  	<div class="row mt-2">
		  		<div class="col">
					<label for="role" class="form-label">Role:</label>
							<?php
								$role = "";
								$roletype = $rows['role'];
								if($roletype == 1)
								{
									$role = "Sale";
								}
								elseif($roletype == 2)
								{
									$role = "Stock";
								}
								else{
									$role = "Admin";
								}
							?>
					<input type="text" value="<?=$role?>" class="form-control" disabled>
				</div>
				<div class="col">
					<label for="status" class="form-label">Status:</label>
							<?php
								$status = "";
								$statustype = $rows['status'];
								if($statustype == 1)
								{
									$status = "Enable";
								}
								else{
									$status = "Disable";
								}
							?>
					<input type="text" value="<?=$status?>" class="form-control" disabled>
				</div>
		  	</div>
		  <div class="row mt-2">
			  <div class="col">
			  	<label for="email" class="form-label">Email:</label>
				<input type="text" value="<?=$rows['email']?>" class="form-control" disabled>
			  </div>
			  <div class="col">
			  	<label for="pwd" class="form-label">Passwrod:</label>
				<input type="password" value="<?=$rows['password']?>" class="form-control" disabled>
			  </div>
		  </div>
		  <div class="row mt-2">
			  <div class="col">
				  <label for="desc" class="form-label">Address:</label>
				  <textarea class="form-control" rows="3" disabled><?=$rows['address']?></textarea>
			  </div>
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success w-25" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
					   

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal<?=$rows['id']?>" tabindex="-1" role="dialog" aria-labelledby="deleteModal<?=$rows['id']?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content alert-warning">
      <div class="modal-header">
        <h3 class="modal-title" id="deleteModal<?=$rows['id']?>">Your Message</h3>
      </div>
      <div class="modal-body">
        Are you sure to delete this user ?
      </div>
      <div class="modal-footer">
		  <a href="listUser.php?page=listUser&action=8&img=<?=$rows['image']?>&id=<?=$rows['id']?>" class="btn btn-primary w-25">Yes</a>
		 <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
					   
                    <?php
                        }
                    ?>
                   </tbody>
               </table>
			<?php
					}
				?>
            </div>

            <footer class="footer text-center text-muted">
                All Rights Reserved by Bunney ThiaReuth.
            </footer>
        </div>

    </div>
<?php
include 'include/scriptFooter.php';
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
	$(document).ready( function () {
    $('#list').DataTable();
} );
</script>
</script>
<script>
    if (window.history.replaceState ) {
         window.history.replaceState( null, null, "listUser.php?page=listUser");  
    }
</script>
</body>

</html>
<?php mysqli_close($conn)?>
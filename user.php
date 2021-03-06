<?php
	include('database/db_connection.php');
    include('libaries/auth.php');
    if(!isLogin(3))
    {
        header("location:login/login.php?page=login");
        exit();
    }
    $message=-1;
    $messageDialog="";
    if(isset($_GET['action']))
    {
        $fistName = $_POST['txt_fistname'];
        $lastName = $_POST['txt_lastname'];
        $dob = $_POST['txt_dob'];
        $gender = $_POST['txt_gender'];
        $role = $_POST['txt_role'];
        $status = $_POST['txt_status'];
        $email = $_POST['txt_email'];
        $pws = $_POST['txt_pwd'];
        $address = $_POST['txt_address'];
		
		
        $image = "noimage.png";
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
                
				 $insertSQL = "INSERT INTO `tbl_user`(`image`, `fistName`, `lastName`, `dob`, `gender`, `role`, `status`, `email`, `password`, `address`) VALUES ('$image','$fistName','$lastName','$dob','$gender','$role','$status','$email',MD5('$pws'),'$address')";
					$runSQL = mysqli_query($conn,$insertSQL);
					if($runSQL)
					{
                        
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

						$message =1;
						$messageDialog = "User created is successfully...";
					}
					else
					{
						$message =0;
						$messageDialog = "User created is not successfully...";
					}
			 }
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">CREAT USERS</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                        <li class="breadcrumb-item"><a href="user.php?page=user">Create User</a>
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
                <div class="alert alert-primary" role="alert">
                    <h3><strong>Success !</strong></h3><p><?=$messageDialog?></p>
                </div>
                <?php
                    }
                    elseif($message == 0)
                    {
                ?>
                <div class="alert alert-danger" role="alert">
                    <h3><strong>Error !</strong></h3><p><?=$messageDialog?></p>
                </div>
                <?php
                    }
                ?>
                <form enctype="multipart/form-data" method="POST" action="user.php?page=user&action=1">
                    <div class="row container">
                        <div class="rounded mb-4 img-thumbnail col col-lg-3" style="width:200px;height:200px;">
                            <img id="previewImg" src="images/defualtImage.png" alt="Preview Image" width="100%" height="100%" class="rounded">
                            <div class="input-group mt-2">
                                <div class="custom-file">
                                    <input type="file" name="txt_image" class="custom-file-input" onchange="previewFile(this);" id="customFile" required/>
                                    <input type="button" class="custom-file-label btn bg-danger text-white w-100" value="Upload Image" for="customFile">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label" id="fistname">Fist Name:</label>
                                    <input type="text" name="txt_fistname" id="fistname" class="form-control" placeholder="Fist Name" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                                </div>
                                <div class="col">
                                    <label class="form-label" id="Listname">Last Name:</label>
                                    <input type="text" name="txt_lastname" id="Listname" class="form-control" placeholder="Last Name" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label class="form-label" id="dob">Date Of Birth:</label>
                                    <input type="date" name="txt_dob" id="dob"  class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                                </div>
                                <div class="col">
                                    <label class="form-label" id="gander">Gender:</label>
                                    <select class="form-control" name="txt_gender" id="gander" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label class="form-label" id="role">Role:</label>
                                    <select class="form-control" name="txt_role" id="role" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                                        <option value="1">Sale</option>
                                        <option value="2">Stock</option>
                                        <option value="3">Admin</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label" id="Status">Status:</label>
                                    <select class="form-control" name="txt_status" id="Status" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                                        <option value="1">Enable</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 container-fluid">
                        <div class="row mt-2">
                            <div class="col">
                                <label class="form-label" id="email">Email:</label>
                                <input type="email" name="txt_email" id="email" class="form-control" placeholder="Email" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                            </div>
                            
                            <div class="col">
                                <label class="form-label" id="pwd">Password Login:</label>
                                <input type="password" name="txt_pwd" id="pwd" class="form-control" placeholder="Password" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                            </div>
                            
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <lable for="address" class="form-label">Address:</label>
                                <textarea id="address" name="txt_address" rows="5" class="form-control" placeholder="User address" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"></textarea>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-25">Save <i class="fas ml-2 fa-save"></i></button>
                            <button type="reset" class="btn btn-dark w-25">Clear <i class="fas ml-2 fa-eraser"></i></button>
                            <a href="listUser.php?page=listUser" class="btn btn-success float-right">User List <i class="fas ml-2 fa-list"></i></a>
                        </div>
                    </div>
                </form>
            </div>
            <footer class="footer text-center text-muted">
                All Rights Reserved by Bunney ThiaReuth.
            </footer>
        </div>
    </div>
<?php
include 'include/scriptFooter.php';
?>
</script>
<script>
    if (window.history.replaceState ) {
         window.history.replaceState( null, null, "user.php?page=user");  
    }
</script>
</body>
</html>
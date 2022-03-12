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
                <form action="#" enctype="multipart/form-data" method="post">
                    <div class="row container">
                        <div class="rounded mb-4 img-thumbnail col col-lg-3" style="width:200px;height:200px;">
                            <img id="previewImg" src="images/defualtImage.png" alt="Preview Image" width="100%" height="100%" class="rounded">
                            <div class="input-group mt-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" onchange="previewFile(this);" id="customFile">
                                    <input type="button" class="custom-file-label btn bg-primary text-white w-100" value="Upload Image" for="customFile">
                                </div>
                            </div>
                        </div>
                        <div class="col text-center">
                            <h1 class="p-2" style="font-size:70px;"><strong>CREATE USER PROFILE</strong></h1>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <label class="form-label" id="fistname">Fist Name:</label>
                            <input type="text" name="txt_fistname" id="fistname" class="form-control" placeholder="Fist Name" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                        </div>
                        <div class="col">
                            <label class="form-label" id="Listname">Fist Name:</label>
                            <input type="text" name="txt_lastname" id="Listname" class="form-control" placeholder="Last Name" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                        </div>
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
                            <label class="form-label" id="email">Email:</label>
                            <input type="email" name="txt_email" id="email" class="form-control" placeholder="Email" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                        </div>
                        <div class="col">
                            <label class="form-label" id="role">Role:</label>
                            <select class="form-control" name="txt_role" id="role" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                                <option value="1">admin</option>
                                <option value="2">sale</option>
                                <option value="3">stock</option>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label" id="pwd">Password Login:</label>
                            <input type="password" name="txt_pwd" id="pwd" class="form-control" placeholder="Password" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                        </div>
                        <div class="col">
                            <label class="form-label" id="Status">Status:</label>
                            <select class="form-control" name="txt_status" id="Status" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <lable for="address" class="form-label">Address:</label>
                            <textarea id="address" name="txt_address" rows="5" class="form-control" placeholder="User address" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"></textarea>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-25">Save</button>
                        <button type="reset" class="btn btn-dark w-25">Clear</button>
                    </div>
                </form>
                <div class="mt-2">
                <table class="table table-primary table-hover">
                    <thead class="bg-primary text-white">
                        <th>image</th>
                        <th>Name</th>
                        <th>Date Of Birth</th>
                        <th>Gander</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Address</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
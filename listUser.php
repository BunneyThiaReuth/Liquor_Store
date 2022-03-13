<?php
    include('database/db_connection.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <?php
        include 'include/head.php';
    ?>
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
               <table id="list" class="table table-primary">
                   <thead>
                       <th class="text-center">Image</th>
                       <th class="text-center">Name</th>
                       <th class="text-center">Date Of Birth</th>
                       <th class="text-center">Gender</th>
                       <th class="text-center">Role</th>
                       <th class="text-center">Status</th>
                       <th class="text-center">Email</th>
                       <th class="text-center">Password</th>
                       <th class="text-center">Address</th>
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
                           <td><?=$rows['dob']?></td>
                           <td class="text-center">
                                <?php
                                    if($rows['gender'] == 1)
                                    {
                                ?>
                                    <a href="#" class="btn btn-info w-100">Male</a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                    <a href="#" class="btn btn-warning w-100">Female</a>
                                <?php
                                    }
                                ?>
                           </td>
                           <td class="text-center">
                               <?php
                                    if($rows['role'] == 1)
                                    {
                                        echo '<div class="btn btn-danger w-100">Sale</div>';
                                    }
                                    elseif($rows['role'] == 2)
                                    {
                                        echo '<div class="btn btn-success w-100">Stock</div>';
                                    }
                                    else
                                    {
                                        echo '<div class="btn btn-primary w-100">Admin</div>';
                                    }
                               ?>
                           </td>
                           <td class="text-center">
                               <?php
                                    if($rows['status'] == 1)
                                    {
                               ?>
                                <a href="#" class="btn btn-success w-100">Enable</a>
                                <?php
                                    }
                                    else
                                    {
                                ?>
                                <a href="#" class="btn btn-warning w-100">Disable</a>
                                <?php
                                    }
                                ?>
                           </td>
                           <td>
                                <?=$rows['email']?>
                           </td>
                           <td>
                               <input type="password" value="<?=$rows['password']?>" class="form-control" disabled/>
                           </td>
                           <td>
                                <?=$rows['address']?>
                           </td>
                           <td class="text-center">
                           <a href="#">
										<box-icon name='edit' type='solid' ></box-icon>
									</a>
									<a href="#">
										<box-icon name='trash' ></box-icon>
									</a>
                           </td>
                       </tr>
                    <?php
                        }
                    ?>
                   </tbody>
               </table>
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
<?php
    include('database/db_connection.php');
    include('libaries/auth.php');
    if(!isLogin())
    {
        header("location:login/login.php?page=login");
        exit();
    }
    $message=-1;
    $messageDialog = "";
    if(isset($_GET['action']))
    {
        $action = $_GET['action'];
        switch ($action)
        {
            case '1':
                if(isset($_GET['delID']))
                {
                    $id = $_GET['delID'];
                    $sql = "DELETE FROM `tbl_discount` WHERE `disID` = $id";
                    $runsql = mysqli_query($conn,$sql);
                    if($runsql)
                    {
                        $message = 1;
                        $messageDialog = "This record deleted is successfully...";
                    }
                    else
                    {
                        $message = 0;
                        $messageDialog = "This record deleted is not successfully...";
                    }
                }
                break;
            case '2':
                if(isset($_GET['updateID']))
                {
                    $id = $_GET['updateID'];
                    $name = $_POST['txt_upname'];
                    $desc = $_POST['txt_desc'];
                    $disPerent = $_POST['txt_discountPerent'];
                    $stDate = $_POST['txt_stDate'];
                    $enDate = $_POST['txt_enDate'];

                    $sql = "UPDATE `tbl_discount` SET `name`='$name',`description`='$desc',`discountPerent`='$disPerent',`startDate`='$stDate',`endDate`='$enDate' WHERE `disID` = $id";
                    $runsql = mysqli_query($conn,$sql);
                    if($runsql)
                    {
                        $message = 1;
                        $messageDialog = "This record updated is successfully...";
                    }
                    else
                    {
                        $message = 0;
                        $messageDialog = "This record updated is not successfully...";
                    }
                }   
                break;
            case '3':
                if(isset($_GET['enableID']))
                {
                    $id = $_GET['enableID'];
                    $sql = "UPDATE `tbl_discount` SET `status`='1' WHERE `disID` = $id";
                    $runsql = mysqli_query($conn,$sql);
                    if($runsql)
                    {
                        $message = 1;
                        $messageDialog = "This record enable is successfully...";
                    }
                    else
                    {
                        $message = 0;
                        $messageDialog = "This record enable is not successfully...";
                    }
                }
                break;
            case '4':
                if(isset($_GET['disableID']))
                {
                    $id = $_GET['disableID'];
                    $sql = "UPDATE `tbl_discount` SET `status`='0' WHERE `disID` = $id";
                    $runsql = mysqli_query($conn,$sql);
                    if($runsql)
                    {
                        $message = 1;
                        $messageDialog = "This record disable is successfully...";
                    }
                    else
                    {
                        $message = 0;
                        $messageDialog = "This record disable is not successfully...";
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">LIST DICOUNT</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                        <li class="breadcrumb-item"><a href="category.php?page=category">Category</a>
                                        <li class="breadcrumb-item">
										<a href="ListCategory.php?page=Listcategory">List Category</a>
                                        <li class="breadcrumb-item">
										<a href="discount.php?page=discount">Discount</a>
                                        <li class="breadcrumb-item">
										<a href="lsitDiscount.php?page=lsitDiscount">List Discount</a>
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
                        <div>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Successfully</h4>
                                <p><?=$messageDialog?></p>
                            </div>
                        </div>
                <?php
                    }
                    elseif($message == 0)
                    {
                ?>
                        <div>
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Oops, Error</h4>
                                <p><?=$messageDialog?></p>
                            </div>
                        </div>
                <?php
                    }
                ?>
                <div>
                <table id="list" class="table-hover table table-success">
						<thead class="bg-success text-white">
							<tr>
								<th class="text-center">#No</th>
								<th>Name</th>
								<th>Description</th>
                                <th>Discount Perent</th>
                                <th>Start Date</th>
                                <th>End Date</th>
								<th class="text-center">Status</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody class="border border-success">
                            <?php
                                $selectDiscount = "SELECT * FROM `tbl_discount`";
                                $runselectDiscount = mysqli_query($conn,$selectDiscount);
                                if(mysqli_num_rows($runselectDiscount)>0)
                                {
                                    $i=1;
                                    while($rows = mysqli_fetch_array($runselectDiscount))
                                    {
                            ?>  
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><?=$rows['name']?></td>
                                        <td><?=$rows['description']?></td>
                                        <td><?=$rows['discountPerent']?>%</td>
                                        <td><?=$rows['startDate']?></td>
                                        <td><?=$rows['endDate']?></td>
                                        <td class="text-center">
                                            <?php
                                                if($rows['status']==1)
                                                {
                                            ?>
                                            <a href="lsitDiscount.php?page=lsitDiscount&action=4&disableID=<?=$rows['disID']?>">
                                                <box-icon name='show' ></box-icon>
                                            </a>
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                            <a href="lsitDiscount.php?page=lsitDiscount&action=3&enableID=<?=$rows['disID']?>">
                                                <box-icon name='hide' ></box-icon>
                                            </a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="#">
                                                <box-icon name='edit' type='solid' data-toggle="modal" data-target="#EditModal<?=$rows['disID']?>"></box-icon>
                                            </a>
                                            <a href="#">
                                                <box-icon name='trash' data-toggle="modal" data-target="#DeleteModal<?=$rows['disID']?>"></box-icon>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="DeleteModal<?=$rows['disID']?>" tabindex="-1" role="dialog" aria-labelledby="DeleteModal<?=$rows['disID']?>" aria-hidden="true">
                                        <div class="modal-dialog alert-warning" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="DeleteModal<?=$rows['disID']?>">Your Message</h5>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to delete this record ?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="lsitDiscount.php?page=lsitDiscount&action=1&delID=<?=$rows['disID']?>" class="btn btn-primary w-25">Yes</a>
                                                <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Update -->
                                    <div class="modal fade" id="EditModal<?=$rows['disID']?>" tabindex="-1" role="dialog" aria-labelledby="EditModal<?=$rows['disID']?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content  alert-warning">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="EditModal<?=$rows['disID']?>">UPDATE DISCOUNT</h3>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" enctype="multipart/form-data" action="lsitDiscount.php?page=lsitDiscount&action=2&updateID=<?=$rows['disID']?>" class="form-group">
                                                    <div>
                                                        <label for="name" class="form-label">Update Name:</label>
                                                        <input type="text" id="name" value="<?=$rows['name']?>" name="txt_upname" class="form-control" placeholder="Update Name" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"/>
                                                    </div>
                                                    <div class="mt-2">
                                                        <label for="desc" class="form-label">Update Description:</label>
                                                        <textarea id="desc" name="txt_desc" rows="5" class="form-control" placeholder="Update description" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"><?=$rows['description']?></textarea>
                                                    </div>
                                                    <div class="mt-2">
                                                        <label for="dicPerent" class="form-label">Update Discount Perent:</label>
                                                        <input type="text" id="dicPerent" value="<?=$rows['discountPerent']?>" name="txt_discountPerent" class="form-control" placeholder="Update discount perent" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"/>
                                                    </div>
                                                    <div class="mt-2">
                                                        <label for="stDate" class="form-label">Update Start Date:</label>
                                                        <input type="date" id="stDate" value="<?=$rows['startDate']?>" name="txt_stDate" class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"/>
                                                    </div>
                                                    <div class="mt-2">
                                                        <label for="enDate" class="form-label">Update End Date:</label>
                                                        <input type="date" id="enDate" value="<?=$rows['endDate']?>" name="txt_enDate" class="form-control" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"/>
                                                    </div>
                                                    <div class="float-right mt-3">
                                                        <button type="submit" class="btn btn-primary">Update <i class="fas ml-2 fa-save"></i></button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                            <?php
                                        $i++;
                                    }
                                }
                            ?>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
	$(document).ready( function () {
    $('#list').DataTable();
} );
</script>
	<script>
    if (window.history.replaceState ) {
         window.history.replaceState( null, null, "lsitDiscount.php?page=lsitDiscount");  
    }
</script>
</body>

</html>
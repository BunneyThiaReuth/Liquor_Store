<?php
    include 'database/db_connection.php';
    $message =-1;
    $messageDailog = "";
    if(isset($_GET['action']))
    {
        $action = $_GET['action'];
        switch($action)
        {
            case '1':
                $cateName = $_POST['txt_cateName'];
                $desc = $_POST['txt_desc'];
                $status = $_POST['txt_status'];
                $insertSQL = "INSERT INTO `tbl_category`(`name`, `description`, `status`) VALUES ('$cateName','$desc','$status')";
                $runSQL = mysqli_query($conn,$insertSQL);
                if($runSQL)
                {
                    $message =1;
                    $messageDailog = "Insert is successfully...";
                }
                else{
                    $message = 0;
                    $messageDailog = "Insert is not successfully...";
                }
                break;
            case '2':
                if(isset($_GET['delectID']))
                {
                    $delectID = $_GET['delectID'];
                    $deleteSQL = "DELETE FROM `tbl_category` WHERE `cateId` = $delectID";
                    $rundeleteSQL = mysqli_query($conn,$deleteSQL);
                    if($rundeleteSQL)
                    {
                        $message =1;
                        $messageDailog = "Delete is successfully...";
                    }
                    else
                    {
                        $message =0;
                        $messageDailog = "Delete is not successfully...";
                    }
                }
                break;
            case '3':
                if(isset($_GET['disableID']))
                {
                    $disableID = $_GET['disableID'];
                    $updatestatusSql = "UPDATE `tbl_category` SET `status`='0' WHERE `cateId` = $disableID";
                    mysqli_query($conn,$updatestatusSql);
                }
                break;
            case '4':
                if(isset($_GET['enableID']))
                {
                    $enableID = $_GET['enableID'];
                    $updatestatusSql = "UPDATE `tbl_category` SET `status`='1' WHERE `cateId` = $enableID";
                    mysqli_query($conn,$updatestatusSql);
                }
                break;
            case '5':
                if(isset($_GET['updateID']))
                {
                    $getData = $_GET['updateID'];
                    $getdataSQL = "SELECT * FROM `tbl_category` WHERE `cateId` = $getData";
                    $rungetdataSQL = mysqli_query($conn,$getdataSQL);
                    $cateData = mysqli_fetch_array($rungetdataSQL);

                    $getName = $cateData['name'];
                    $getDesc = $cateData['description'];
                    $getID = $cateData['cateId'];
                }
                break;
            case '6':
                if(isset($_POST['updatebyID']))
                {
                    $updatebyID = $_POST['updatebyID'];

                    $updateName = $_POST['txt_upName'];
                    $updateDesc = $_POST['txt_updesc'];

                    $updateCateSQL = "UPDATE `tbl_category` SET `name`='$updateName',`description`='$updateDesc' WHERE `cateId` = $updatebyID";
                    $runupdateCateSQL = mysqli_query($conn,$updateCateSQL);
                    if($runupdateCateSQL)
                    {
                        $message =1;
                        $messageDailog = "Update is successfully...";
                    }
                    else
                    {
                        $message =0;
                        $messageDailog = "Update is not successfully...";
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Category</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="category.php?page=category">Category</a>
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
                <div class="alert alert-success">
                    <strong>Message ! </strong> <?php echo($messageDailog)?>
                </div>
            <?php
                }
                elseif($message == 0)
                {
            ?>
                <div class="alert alert-danger">
                    <strong>Message ! </strong> <?php echo($messageDailog)?>
                </div>
            <?php
                }
            ?>
            <?php
                if(isset($_GET['action']) && $_GET['action'] == 5)
                {
            ?>
                <div>
                    <form  method="post" enctype="multipart/form-data" action="category.php?page=category&action=6">
                        <input type="hidden" name="updatebyID" value="<?php echo($getID)?>">
                        <div class="row">
                            <div class="col">
                                <label for="name" class="form-label">Update Name:</label>
                                <input type="text" id="name" value="<?php echo($getName)?>" name="txt_upName" class="form-control" placeholder="Enter category name" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="description" class="form-label">Update Description</label>
                                <textarea id="description" rows="5" class="form-control" name="txt_updesc" required><?php echo($getDesc)?></textarea>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary w-25">Update</button>
                            <a href="category.php?page=category" class="btn btn-dark w-25">Back</a>
                        </div>
                    </form>
                </div>

            <?php
                }
            else
                {
            ?>
                <div>
                    <form  method="post" enctype="multipart/form-data" action="category.php?page=category&action=1">
                        <div class="row">
                            <div class="col">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" id="name" name="txt_cateName" class="form-control" placeholder="Enter category name" required>
                            </div>
                            <div class="col">
                                <label for="status" class="form-label" >Status:</label>
                                <select id="status" class="form-control" name="txt_status" required>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" rows="5" class="form-control" name="txt_desc" required></textarea>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary w-25">Save</button>
                            <button type="reset" class="btn btn-dark w-25">Clear</button>
                        </div>
                    </form>
                </div>

            <?php
                }
            ?>
                

                <div class="mt-5">
                    <table id="cateList" class="table-hover table-success">
                        <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center">#No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-primary">
                            <?php
                                $i=1;
                                $selectCate = "SELECT * FROM `tbl_category`";
                                $runselectCate = mysqli_query($conn,$selectCate);
                                while($rows = mysqli_fetch_array($runselectCate))
                                {
                            ?>
                            <tr>
                                <td class="text-center"><?=$i?></td>
                                <td><?=$rows['name']?></td>
                                <td><?=$rows['description']?></td>
                                <td class="text-center">
                                    <?php
                                        if($rows['status']==1)
                                        {
                                    ?>
                                        <a href="category.php?page=category&action=3&disableID=<?=$rows['cateId']?>">
                                            <box-icon name='show'></box-icon>
                                        </a>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <a href="category.php?page=category&action=4&enableID=<?=$rows['cateId']?>">
                                            <box-icon name='hide' ></box-icon>
                                        </a>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="category.php?page=category&action=5&updateID=<?=$rows['cateId']?>">
                                        <box-icon name='edit-alt'></box-icon>
                                    </a>
                                    <a href="#">
                                        <box-icon name='trash-alt' data-toggle="modal" data-target="#Modal<?=$rows['cateId']?>"></box-icon>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="Modal<?=$rows['cateId']?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?=$rows['cateId']?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="Modal<?=$rows['cateId']?>">Warning Message</h5>
                                </div>
                                <div class="modal-body">
                                    Do you want to delete this category ?
                                </div>
                                <div class="modal-footer">
                                    <a href="category.php?page=category&action=2&delectID=<?=$rows['cateId']?>" class="btn btn-primary w-25">Yes</a>
                                    <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">No</button>
                                </div>
                                </div>
                            </div>
                            </div>

                            <?php
                                $i++;
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
        $('#cateList').DataTable();
    } );
</script>
<script>
    if (window.history.replaceState ) {
         window.history.replaceState( null, null, "category.php?page=category");  
    }
</script>
</body>
</html>
<?php
    mysqli_close($conn);
?>
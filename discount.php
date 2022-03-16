<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <?php
        include 'include/head.php';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="GetData/action.js"></script>
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">CREATE DICOUNT</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                        <li class="breadcrumb-item"><a href="category.php?page=category">Category</a>
                                        <li class="breadcrumb-item">
										<a href="ListCategory.php?page=Listcategory">List Category</a>
                                        <li class="breadcrumb-item">
										<a href="discount.php?page=discount">Discount</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div id="ms1" class="mt-2">
				
				</div>
                <div>
                    <form method="post" enctype="multipart/form-data" id="inserDiscountData">
                        <div class="row">
                            <div class="col">
                                <label class="form-label" for="stDate">Start Date:</label>
                                <input type="date" class="form-control w-50" name="txt_stDate" id="stDate" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="form-label" for="enDate">End Date:</label>
                                <input type="date" class="form-control w-50" name="txt_enDate" id="enDate" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="form-label" for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="txt_name" placeholder="Enter name" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                            </div>
                            <div class="col">
                                <label class="form-label" for="dicPerent">Discount Perent:</label>
                                <input type="text" class="form-control" id="dicPerent" name="txt_dicPerent" placeholder="Enter Discount perent (%)" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                            </div>
                            <div class="col">
                                <label class="form-label" for="Status">Status:</label>
                                <select class="form-control" name="txt_status" id="Status" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 row">
                            <div class="col">
                                <label class="form-label" for="desc">Description:</label>
                                <textarea class="form-control" id="desc" name="txt_desc" placeholder="Enter description" rows="5" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"></textarea>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-25">Save <i class="fas ml-2 fa-save"></i></button>
                            <button type="reset" class="btn btn-dark w-25">Clear <i class="fas ml-2 fa-eraser"></i></button>
                            <a href="lsitDiscount.php?page=lsitDiscount" class="btn btn-success float-right">List Discount <i class="fas ml-2 fa-list"></i></a>
                        </div>
                    </form>
                </div>
                <div class="mt-3">
                    <table class="table-hover table table-primary">
                        <thead class="bg-primary text-white">

                                <th>Name</th>
                                <th>Description</th>
                                <th>Discount Perent</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th class="text-center">Status</th>

                        </thead>
                        <tbody id="displayData" class="text-dark border border-primary">

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
         window.history.replaceState( null, null, "discount.php?page=discount");  
    }
</script>
</body>

</html>
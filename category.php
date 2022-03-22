<?php
    include('libaries/auth.php');
    if(!isLogin())
    {
        header("location:login/login.php?page=login");
        exit();
    }
?>
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">CREATE CATEGORY</h3>
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
				<div id="ms" class="mt-2">
				
				</div>
				
                <div class="mt-2">
                    <form  method="post" enctype="multipart/form-data" id="insertCateFrm">
                        <div class="row">
                            <div class="col">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" id="name" name="txt_cateName" class="form-control" placeholder="Enter category name" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                            </div>
                            <div class="col">
                                <label for="status" class="form-label" >Status:</label>
                                <select id="status" class="form-control" name="txt_status" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;">
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" rows="2" class="form-control" name="txt_desc" required style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;"></textarea>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-25">Save <i class="fas ml-2 fa-save"></i></button>
                            <button type="reset" class="btn btn-dark w-25">Clear <i class="fas ml-2 fa-eraser"></i></button>
							<a href="ListCategory.php?page=ListCategory" class="btn btn-success float-right">Show List <i class="fas ml-2 fa-list"></i></a>
                        </div>
                    </form>
					<div class="mt-3" id="ListcateData">
								<table id="data" class="table-hover table table-primary">

									<thead>
										<tr class="bg-primary text-white">
											<th>Name</th>
											<th>Description</th>
											<th class="text-center">Status</th>
										</tr>
									</thead>

									<tbody id="listCate"  class="text-dark border border-primary">
										
									</tbody>
							</table>
					</div>
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
         window.history.replaceState( null, null, "category.php?page=category");  
    }
</script>
</body>
</html>
	
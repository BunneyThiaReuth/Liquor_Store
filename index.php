<?php
    include('libaries/auth.php');
    include('database/db_connection.php');
    if(!isLogin(3))
    {
        header("location:login/login.php?page=login");
        exit();
    }
	$countuser = "SELECT COUNT(`id`) as 'countuser' FROM `tbl_user`;";
	$runcountuser= mysqli_query($conn,$countuser);
	$countrow = mysqli_fetch_array($runcountuser);
	
	$sumtotalinvocice ="SELECT sum(tbl_invoicedetail.amount) as 'total'
						FROM `tbl_invoice`
						INNER JOIN tbl_invoicedetail ON tbl_invoice.invNumber = tbl_invoicedetail.invNumber
						WHERE tbl_invoice.status =1;";
	$runsumtotalinvocice = mysqli_query($conn,$sumtotalinvocice);
	$totalrow = mysqli_fetch_array($runsumtotalinvocice);

	$countINV = "SELECT COUNT(`invNumber`) as 'countINV' FROM `tbl_invoice`;";
	$runcountINV = mysqli_query($conn,$countINV);
	$countINVrow = mysqli_fetch_array($runcountINV);

	$checkINV = "SELECT COUNT(`invNumber`) as 'checkINV' FROM `tbl_invoice` WHERE `status` =1;";
	$runcheckINV = mysqli_query($conn,$checkINV);
	$checkINVrow = mysqli_fetch_array($runcheckINV);

	$countINVD = "SELECT COUNT(`invNumber`) as 'countINVDrow' FROM `tbl_invoicedetail`;";
	$runcountINVD = mysqli_query($conn,$countINVD);
	$countINVDrow = mysqli_fetch_array($runcountINVD);

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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Dashboard</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.php?page=dashboard">Dashboard</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?=$countrow['countuser']?></h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">User</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                            class="set-doller">$</sup><?= number_format($totalrow['total'],2)?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Earnings
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium"><?=$countINVrow['countINV']?></h2>
                                        <span
                                            class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">Check(<?=$checkINVrow['checkINV']?>)</span>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Invoice</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><?=$countINVDrow['countINVDrow']?></h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Invoice Detail</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				          <div class="table-responsive">
                                    <table id="userlist" class="table no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0 font-14 font-weight-medium text-muted">Uers
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Gender
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Role</th>
                                                <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$user = "SELECT * FROM `tbl_user`";
												$runusers = mysqli_query($conn,$user);
												while($userrows = mysqli_fetch_array($runusers))
												{
											?>
                                            <tr>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img
                                                                src="images/userImage/thamnail/<?=$userrows['image']?>"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" /></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium"><?=$userrows['fistName']." ".$userrows['lastName']?></h5>
                                                            <span class="text-muted font-14"><?=$userrows['email']?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14">
													<?php
														if($userrows['gender']==1)
														{
															echo("Female");
														}
														else
														{
															echo("Male");
														}
													?>
												</td>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="popover-icon">
                                                        <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                            href="javascript:void(0)">
															<?php
																if($userrows['role']==3)
																{
																	echo("AD");
																}
																elseif($userrows['role']==2)
																{
																	echo("ST");
																}
																elseif($userrows['role']==1)
																{
																	echo("SA");
																}
																else
																{
																	echo("GA");
																}
															?>
														</a>

                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-center px-2 py-4">
													<?php
														if($userrows['status']==1)
														{
													?>
													<i class="fa fa-circle text-primary font-12" data-toggle="tooltip"
                                                        data-placement="top" title="Enable">
													<?php
														}
														else
														{
													?>
														<i class="fa fa-circle text-danger font-12" data-toggle="tooltip"
                                                        data-placement="top" title="Disable">
													<?php
														}
													?>
													
													</i>
												</td>
                                            </tr>
											<?php
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
    $('#userlist').DataTable();
} );
</script>
</body>

</html>
<?php mysqli_close($conn)?>
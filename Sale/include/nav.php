<nav class="navbar fixed-top navbar-expand-sm bg-light navbar-light" style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
  <div class="container-fluid">
    <a class="navbar-brand ">
		<img src="../assets/images/logo-icon.png" style="width:35px;"> 
		<strong class="text-primary">LIQ</strong><strong class="text-success">UOR</strong> <strong class="text-danger">STOR</strong>
	  </a>
	  <div class="d-flex">
		  <strong>Today is :<?=" ".date("d-M-Y")?></strong>
	  </div>
	  <div class="dropdown dropstart ">
	  <button type="button" class="btn btn-light" data-bs-toggle="dropdown">
			  <span class="navbar-toggler-icon"></span>
		  </button>
	  <ul class="dropdown-menu">
		<li>
			<a class="dropdown-item"  data-toggle="modal" data-target="#profileModalCenter">
				<i class="material-icons" style="font-size:20px">account_circle</i>
				<strong class="text-dark"><?=$_SESSION['username']?></strong>
			</a>
		</li>
		<li>
			<a class="dropdown-item" href="../login/login.php?page=login&action=logout">
				<i class="material-icons" style="font-size:20px">power_settings_new</i>
				<strong>LogOut</strong>
			</a>
		  </li>
	  </ul>
	</div>
  </div>
</nav>
<nav class="navbar fixed-top navbar-expand-sm bg-light navbar-light" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
  <div class="container">
    <a class="navbar-brand" href="#">
		<img src="../assets/images/logo-icon.png">
		<strong>LIQUOR SORE</strong>
	  </a>
	  <div class="d-flex">
	  	<div class="container-fluid">
		<a class="navbar-brand" href="#">
		  <img src="../images/userImage/thamnail/<?=$_SESSION['img']?>" alt="LIQUOR SORE" style="width:50px;border-radius: 10px"> 
		</a>
			<span class="navbar-text"><strong><?=$_SESSION['username']?></strong></span>
	  </div>
		<div class="dropdown mt-2">
			<button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown">
			  Action
			</button>
			<ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="#">
				  <box-icon type='solid' name='user-detail'></box-icon>
				  Profile
				  </a>
				</li>
			  <li><a class="dropdown-item" href="../login/login.php?page=login&action=logout">
				  <box-icon name='log-out-circle'></box-icon>
				  LogOut
				  </a>
				</li>
			</ul>
  		</div>
	</div>
	  </div>
  </div>
</nav>
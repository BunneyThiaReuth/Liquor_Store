<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo me-5" href="index.php"><img src="../assets/images/logo-icon.png" alt="logo"/ style="width: 40px"></a>
		  <a class="navbar-brand brand-logo-mini" href="index.php"><img src="../assets/images/logo-icon.png" alt="logo"/ style="width: 40px"></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button>
        <ul class="navbar-nav nav-profile navbar-nav-right">
			<li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="../images/userImage/<?=$_SESSION['img']?>" alt="profile"/>
				<span><?=$_SESSION['username']?></span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
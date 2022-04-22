<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=Dashboard">
              <i class="ti-shield menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="ti-printer menu-icon"></i>
              <span class="menu-title">Report</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="INVreport.php?page=InvoiceReport">Invoice Report</a></li>
                <li class="nav-item"> <a class="nav-link" href="importreport.php?page=importreport">Import</a></li>
                <li class="nav-item"> <a class="nav-link" href="prolist.php?page=prolist">Products</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="import.php?page=import">
              <i class="ti-layout-list-post menu-icon"></i>
              <span class="menu-title">Import</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="listimp.php?page=listimp">
              <i class="ti-list menu-icon"></i>
              <span class="menu-title">List Import</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="listproducts.php?page=listproducts">
              <i class="ti-list menu-icon"></i>
              <span class="menu-title">List Products</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../login/login.php?page=login&action=logout">
              <i class="ti-power-off menu-icon"></i>
              <span class="menu-title">LogOut</span>
            </a>
          </li>
        </ul>
      </nav>
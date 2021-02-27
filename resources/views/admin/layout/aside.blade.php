<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="/admin">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    @if (Auth::user()->type == 0)
                    <div class="sb-sidenav-menu-heading">Manage</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/admin/manage-admins">Manage</a>
                        </nav>
                    </div>
                    @endif
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoute" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Students
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayoute" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/admin/manage-users">Manage</a>
                        </nav>
                    </div>
                    @if (Auth::user()->type == 0)
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/reports">
                          <i class="fas fa-scroll"></i>
                          &nbsp;<span>Reports</span></a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/profile">
                          <i class="fas fa-user"></i>
                          &nbsp;<span>Profile</span></a>
                    </li>

            </div>
            
        </nav>
    </div>
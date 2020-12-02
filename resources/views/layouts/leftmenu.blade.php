<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="mdi mdi-close"></i>
    </button>

    <div class="left-side-logo d-block d-lg-none">
        <div class="text-center">
            
            <a href="index.html" class="logo"><img src="assets/images/logo_dark.png" height="20" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        
        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>

                <li>
                    <a href="/finance/public/home" class="waves-effect">
                        <i class="dripicons-home"></i>
                        
                        <b> Dashboard </b>
                    </a>
                </li>

                @can('VIEW PROJECTS')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-briefcase"></i> <span> Projects </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                       
                        <li><a href="/finance/public/projects"><b class="dripicons-briefcase" > Manage Projects </b></a></li>
                      
                    </ul>
                </li>
                @endcan

                @can('VIEW INCOME')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-money-check-alt"></i> <span> Funds </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="/finance/public/funds"><b class="fas fa-money-check-alt" aria-hidden="true"> Manage Funds </b></a></li>
                    </ul>
                </li>
                @endcan

                @can('VIEW EXPENSES')<li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-money-check-alt"></i> <span> Expenses </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="/finance/public/expense"><b class="fas fa-money-check-alt" aria-hidden="true"> Manage Expenses </b></a></li>
                        <li><a href="/finance/public/bills"><b class="fas fa-money-check-alt" aria-hidden="true"> Manage Bills </b></a></li>
                    </ul>
                </li>
                @endcan


                @can('VIEW STAFF')<li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user"></i> <span> Staff </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        
                        <li><a href="/finance/public/staff"> <b class="fa fa-users" > Manage Staff </b></a></li>
                    </ul>
                </li> @endcan

                @can('VIEW SUPPLIERS')<li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user"></i> <span> Suppliers </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        
                        <li><a href="/finance/public/suppliers"> <b class="fa fa-users" > Manage Suppliers </b></a></li>
                    </ul>
                </li> @endcan

                @can('VIEW DONORS')<li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span> Donors </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    
                    <ul class="list-unstyled">
                        <li><a href="/finance/public/sponsors"> <b class="dripicons-user" > Manage Financiers </b></a></li>
                    </ul>
                </li> @endcan

               

                @can('VIEW PETTY CASH')<li class="has_sub"> 
                    <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-dollar-sign"></i> <span> Petty Cash </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        
                        <li><a href="/finance/public/pettycash"> <b class="fas fa-dollar-sign" > Manage Transactions </b></a></li>
                    </ul>
                </li> @endcan

                @can('VIEW ANALYTICS') <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-graph-bar"></i><span> Analytics </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="/finance/public/expenseanalytics">Expenses Trends</a></li>
                        <li><a href="/finance/public/incomeanalytics">Income Trends</a></li>
                    </ul>
                </li> @endcan

                @can('VIEW FINANCE')<li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-view-thumb"></i><span> Finance </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="">Profit & Loss</a></li>
                        <li><a href="">Ledger</a></li>
   
                    </ul>
                </li> @endcan

               

                @can('IS ADMINISTRATOR')
                <li class="menu-title">Administrative</li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-location"></i><span> System Users </span> <span class="badge badge-danger badge-pill float-right"></span></a>
                    <ul class="list-unstyled">
                        <li><a href=""> Add User</a></li>
                        <li><a href=""> Manage Users</a></li>
                    </ul>
                </li> @endcan

                @can('IS ADMINISTRATOR')<li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-copy"></i><span> User Rights </span> <span class="menu-arrow float-right"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="/finance/public/roles">Manage Roles</a></li>
                        <li><a href="/finance/public/permissions">Manage Permissions</a></li>
                    </ul>
                </li> @endcan


            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
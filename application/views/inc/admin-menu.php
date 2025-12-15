 

<style>
/* ================================
   ADMINLTE 2 SIDEBAR IMPROVEMENTS
================================ */

/* Sidebar background */
.skin-blue .main-sidebar,
.skin-blue .left-side {
    background-color: #1e272e;
}
.skin-blue .main-header .navbar {
    background-color: #bca012;
}
.skin-blue .main-header .logo {
    background-color: #bca012;
    color: #fff;
    border-bottom: 0 solid transparent;
}
/* Main menu text */
.skin-blue .sidebar-menu > li > a {
    color: #dcdde1;
    font-weight: 600;
}

/* Main menu hover */
.skin-blue .sidebar-menu > li:hover > a {
    background: #ffffffff;
    color: #000000ff;
}

/* Active main menu */
.skin-blue .sidebar-menu > li.active > a,
.skin-blue .sidebar-menu > li.menu-open > a {
    background: #bca012;
    color: #ffffff;
}

/* Submenu background */
.skin-blue .treeview-menu {
    background: #2f3640;
}

/* Submenu text */
.skin-blue .treeview-menu > li > a {
    color: #dcdde1;
    font-size: 13px;
}

/* Submenu hover */
.skin-blue .treeview-menu > li:hover > a {
    background: #353b48;
    color: #ffffff;
}

/* Active submenu */
.skin-blue .treeview-menu > li.active > a {
    background: #bca012;
    color: #ffffff;
    font-weight: 700;
}

/* Icons spacing */
.sidebar-menu i {
    width: 20px;
}
</style>
<?php
$segment1 = $this->uri->segment(1);
?>
 
    <!-- ================= DASHBOARD ================= -->
    <li class="<?= ($segment1 == 'dash') ? 'active' : '' ?>">
        <a href="<?= site_url('dash') ?>">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- ================= MASTER ================= -->
    <li class="treeview <?= in_array($segment1, [
        'user-list',
        'client-list',
        'project-list',
        'task-list',
        'create-employee',
        'edit-employee',
        'emp-category-list',
        'emp-type-list',
        'blood-group-list'
    ]) ? 'active menu-open' : '' ?>">

        <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Master</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>

        <ul class="treeview-menu">

            <!-- USER LIST -->
            <li class="<?= ($segment1 == 'user-list') ? 'active' : '' ?>">
                <a href="<?= site_url('user-list') ?>">
                    <i class="fa fa-user"></i> User List
                </a>
            </li>

            <!-- CLIENT LIST -->
            <li class="<?= ($segment1 == 'client-list') ? 'active' : '' ?>">
                <a href="<?= site_url('client-list') ?>">
                    <i class="fa fa-address-book"></i> Client List
                </a>
            </li>

            <!-- PROJECT LIST -->
            <li class="<?= ($segment1 == 'project-list') ? 'active' : '' ?>">
                <a href="<?= site_url('project-list') ?>">
                    <i class="fa fa-folder"></i> Project List
                </a>
            </li>

            <!-- TASK LIST -->
            <li class="<?= ($segment1 == 'task-list') ? 'active' : '' ?>">
                <a href="<?= site_url('task-list') ?>">
                    <i class="fa fa-tasks"></i> Task List
                </a>
            </li>

            <li class="divider"></li>

            <!-- CREATE EMPLOYEE -->
            <li class="<?= in_array($segment1, ['create-employee','edit-employee']) ? 'active' : '' ?>">
                <a href="<?= site_url('create-employee') ?>">
                    <i class="fa fa-user-plus"></i> Create Employee
                </a>
            </li>

            <!-- EMP CATEGORY -->
            <li class="<?= ($segment1 == 'emp-category-list') ? 'active' : '' ?>">
                <a href="<?= site_url('emp-category-list') ?>">
                    <i class="fa fa-tags"></i> Employee Category
                </a>
            </li>

            <!-- EMP TYPE -->
            <li class="<?= ($segment1 == 'emp-type-list') ? 'active' : '' ?>">
                <a href="<?= site_url('emp-type-list') ?>">
                    <i class="fa fa-id-badge"></i> Employee Type
                </a>
            </li>

            <!-- BLOOD GROUP -->
            <li class="<?= ($segment1 == 'blood-group-list') ? 'active' : '' ?>">
                <a href="<?= site_url('blood-group-list') ?>">
                    <i class="fa fa-heartbeat"></i> Blood Group
                </a>
            </li>

        </ul>
    </li>

    <!-- ================= SETTINGS ================= -->
    <li class="treeview <?= ($segment1 == 'change-password') ? 'active menu-open' : '' ?>">
        <a href="#">
            <i class="fa fa-cog"></i>
            <span>Settings</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>

        <ul class="treeview-menu">
            <li class="<?= ($segment1 == 'change-password') ? 'active' : '' ?>">
                <a href="<?= site_url('change-password') ?>">
                    <i class="fa fa-lock"></i> Change Password
                </a>
            </li>
        </ul>
    </li>
 

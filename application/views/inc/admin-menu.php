<?php
$current_page = $this->uri->segment(1);
?>

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

<!-- ================= DASHBOARD ================= -->
<li class="<?= ($current_page == 'dash') ? 'active' : '' ?>">
    <a href="<?= site_url('dash') ?>">
        <i class="fa fa-dashboard"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- ================= MASTER ================= -->
<li class="treeview <?= in_array($current_page, ['user-list','project-list','task-list','client-list']) ? 'active menu-open' : '' ?>">
    <a href="#">
        <i class="fa fa-cubes"></i>
        <span>Master</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">

        <li class="<?= ($current_page == 'user-list') ? 'active' : '' ?>">
            <a href="<?= site_url('user-list') ?>">
                <i class="fa fa-user"></i> User List
            </a>
        </li>

        <li class="<?= ($current_page == 'client-list') ? 'active' : '' ?>">
            <a href="<?= site_url('client-list') ?>">
                <i class="fa fa-address-book"></i> Client List
            </a>
        </li>

        <li class="<?= ($current_page == 'project-list') ? 'active' : '' ?>">
            <a href="<?= site_url('project-list') ?>">
                <i class="fa fa-folder"></i> Project List
            </a>
        </li>

        <li class="<?= ($current_page == 'task-list') ? 'active' : '' ?>">
            <a href="<?= site_url('task-list') ?>">
                <i class="fa fa-tasks"></i> Task List
            </a>
        </li>

    </ul>
</li>

<!-- ================= SETTINGS ================= -->
<li class="treeview <?= ($current_page == 'change-password') ? 'active menu-open' : '' ?>">
    <a href="#">
        <i class="fa fa-cog"></i>
        <span>Settings</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <li class="<?= ($current_page == 'change-password') ? 'active' : '' ?>">
            <a href="<?= site_url('change-password') ?>">
                <i class="fa fa-lock"></i> Change Password
            </a>
        </li>
    </ul>
</li>

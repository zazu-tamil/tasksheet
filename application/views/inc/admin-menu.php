<?php
$current_page = $this->uri->segment(1);
?>

<!-- DASHBOARD -->
<li class="<?= ($current_page == 'dash') ? 'active' : '' ?>">
    <a href="<?= site_url('dash') ?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<!-- MASTER -->
<li class="treeview <?= in_array($current_page, ['user-list','project-list','task-list','client-list']) ? 'active' : '' ?>">
    <a href="#">
        <i class="fa fa-cubes"></i>
        <span>Master</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">

        <!-- USERS -->
        <li class="<?= ($current_page == 'user-list') ? 'active' : '' ?>">
            <a href="<?= site_url('user-list') ?>">
                <i class="fa fa-user"></i> User List
            </a>
        </li>

        <!-- CLIENTS -->
        <li class="<?= ($current_page == 'client-list') ? 'active' : '' ?>">
            <a href="<?= site_url('client-list') ?>">
                <i class="fa fa-address-book"></i> Client List
            </a>
        </li>

        <!-- PROJECTS -->
        <li class="<?= ($current_page == 'project-list') ? 'active' : '' ?>">
            <a href="<?= site_url('project-list') ?>">
                <i class="fa fa-folder"></i> Project List
            </a>
        </li>

        <!-- TASKS -->
        <li class="<?= ($current_page == 'task-list') ? 'active' : '' ?>">
            <a href="<?= site_url('task-list') ?>">
                <i class="fa fa-tasks"></i> Task List
            </a>
        </li>

    </ul>
</li>

<!-- SETTINGS -->
<li class="treeview <?= in_array($current_page, ['change-password']) ? 'active' : '' ?>">
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

 
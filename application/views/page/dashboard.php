<?php include_once(VIEWPATH . '/inc/header.php'); ?>

<!-- AdminLTE 2 Enhanced Dashboard -->
<section class="content-header">
    <h1>
        <i class="fa fa-dashboard"></i> Dashboard
        <small>Control Panel Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
    <!-- Stats Cards Row -->
    <div class="row">
        <?php
        $cards = [
            ['title' => 'TOTAL TASKS', 'icon' => 'fa-tasks', 'color' => 'aqua-active', 'value' => $total_tasks ?? 0, 'trend' => '+12%'],
            ['title' => "TODAY'S TASKS", 'icon' => 'fa-calendar', 'color' => 'light-blue-active', 'value' => $today_tasks ?? 0, 'trend' => '+8%'],
            ['title' => 'PENDING TASKS', 'icon' => 'fa-clock-o', 'color' => 'yellow-active', 'value' => $pending_tasks ?? 0, 'trend' => '−2%'],
            ['title' => 'COMPLETED', 'icon' => 'fa-check-circle', 'color' => 'green-active', 'value' => $completed_tasks ?? 0, 'trend' => '+25%'],
            ['title' => 'CLIENTS', 'icon' => 'fa-users', 'color' => 'red-active', 'value' => $client_count ?? 0, 'trend' => '+15%'],
            ['title' => 'PROJECTS', 'icon' => 'fa-cubes', 'color' => 'purple-active', 'value' => $project_count ?? 0, 'trend' => '+10%'],
            ['title' => 'EMPLOYEES', 'icon' => 'fa-user', 'color' => 'navy-active', 'value' => $employee_count ?? 0, 'trend' => '+5%'],
            ['title' => 'DUE 30MIN', 'icon' => 'fa-bell-o', 'color' => 'orange-active', 'value' => $due_30min ?? 0, 'trend' => '!'],
        ];

        foreach ($cards as $c): ?>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-<?php echo $c['color']; ?>">
                    <div class="inner">
                        <h3><?php echo $c['value']; ?></h3>
                        <p><?php echo $c['title']; ?></p>
                    </div>
                    <div class="icon">
                        <i class="fa <?php echo $c['icon']; ?>"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        <?php echo $c['trend']; ?> <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Charts & Info Row -->
    <div class="row">
        <!-- Tasks Chart -->
        <div class="col-md-8">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Tasks Overview <small class="text-muted">(This Month)</small></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <canvas id="tasksChart" style="height: 200px;"></canvas>
                        </div>
                        <div class="col-md-8">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-tasks"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Tasks</span>
                                    <span class="info-box-number"><?php echo $total_tasks ?? 0; ?></span>
                                </div>
                            </div>
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pending</span>
                                    <span class="info-box-number"><?php echo $pending_tasks ?? 0; ?></span>
                                </div>
                            </div>
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-check-circle"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Completed</span>
                                    <span class="info-box-number"><?php echo $completed_tasks ?? 0; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects Chart -->
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Projects Status</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="projectsChart" style="height: 250px;"></canvas>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-6">
                            <small class="text-info">Total: <?php echo $project_count ?? 0; ?></small>
                        </div>
                        <div class="col-sm-6 text-right">
                            <small class="text-success">Completed: <?php echo $completed_tasks ?? 0; ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Quick Stats -->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Recent Activity</h3>
                </div>
                <div class="box-body">
                    <ul class="timeline">
                        <li>
                            <i class="fa fa-check-circle bg-green"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 12 mins ago</span>
                                <h3 class="timeline-header">Task #1234 Completed</h3>
                                <div class="timeline-body">Project delivery completed successfully</div>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-user bg-aqua"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 2 hours ago</span>
                                <h3 class="timeline-header">New Client Added</h3>
                                <div class="timeline-body">ABC Corp registered successfully</div>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-comments bg-yellow"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 5 hours ago</span>
                                <h3 class="timeline-header">New Comments</h3>
                                <div class="timeline-body">5 new comments on Project X</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Quick Stats</h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-condensed">
                        <tr>
                            <td><span class="label label-success">Due Today</span></td>
                            <td><span class="badge bg-green"><?php echo $today_tasks ?? 0; ?></span></td>
                        </tr>
                        <tr>
                            <td><span class="label label-warning">Overdue</span></td>
                            <td><span class="badge bg-orange"><?php echo $due_30min ?? 0; ?></span></td>
                        </tr>
                        <tr>
                            <td><span class="label label-info">Active Projects</span></td>
                            <td><span class="badge bg-aqua"><?php echo $project_count ?? 0; ?></span></td>
                        </tr>
                        <tr>
                            <td><span class="label label-primary">Team Members</span></td>
                            <td><span class="badge bg-light-blue"><?php echo $employee_count ?? 0; ?></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once(VIEWPATH . '/inc/footer.php'); ?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Enhanced Tasks Doughnut Chart
    const tasksCtx = document.getElementById('tasksChart').getContext('2d');
    new Chart(tasksCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'In Progress', 'Completed'],
            datasets: [{
                data: [<?php echo $pending_tasks ?? 0; ?>, <?php echo ($today_tasks ?? 0) - ($pending_tasks ?? 0); ?>, <?php echo $completed_tasks ?? 0; ?>],
                backgroundColor: ['#f39c12', '#3498db', '#2ecc71'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Enhanced Projects Bar Chart
    const projectsCtx = document.getElementById('projectsChart').getContext('2d');
    new Chart(projectsCtx, {
        type: 'bar',
        data: {
            labels: ['Total', 'Active', 'Completed'],
            datasets: [{
                label: 'Projects',
                data: [<?php echo $project_count ?? 0; ?>, <?php echo ($project_count ?? 0) - ($completed_tasks ?? 0); ?>, <?php echo $completed_tasks ?? 0; ?>],
                backgroundColor: ['#3498db', '#f39c12', '#2ecc71'],
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

<style>
    /* AdminLTE 2 Dashboard Enhancements */
    .small-box {
        border-radius: 10px;
        position: relative;
        overflow: hidden;
    }

    .small-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    .small-box .icon {
        font-size: 50px;
        opacity: 0.9;
    }

    .small-box-footer {
        background: rgba(0, 0, 0, 0.1);
        border-top: none;
        padding: 10px 15px;
        font-weight: 600;
    }

    /* Box Enhancements */
    .box {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .box.box-success {
        border-left: 5px solid #00a65a;
    }

    .box.box-primary {
        border-left: 5px solid #3c8dbc;
    }

    .box.box-info {
        border-left: 5px solid #00c0ef;
    }

    .box.box-danger {
        border-left: 5px solid #dd4b39;
    }

    .timeline {
        position: relative;
        margin: 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 3px;
        background: #eee;
        left: 20px;
        margin-left: -5px;
    }

    .timeline>li>.timeline-item {
        margin-top: 0;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .content-wrapper {
        min-height: 100% !important;
        background-color: #e3e4e5 !important;
        z-index: 800 !important;
    }

    /* Perfect Responsive */
    @media (max-width: 768px) {
        .small-box h3 {
            font-size: 2.2rem;
        }

        .timeline::before {
            left: 15px;
        }

        .box-header .box-tools {
            margin-top: 5px;
        }
    }

    @media (max-width: 480px) {
        .content-header h1 {
            font-size: 1.5rem;
        }

        .small-box {
            margin-bottom: 15px;
        }
    }
</style>
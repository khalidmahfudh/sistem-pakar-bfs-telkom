
            <!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand topbar mb-4 static-top shadow">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="d-none d-md-inline ">
                <button class="btn btn-link text-gray-900 rounded-circle" id="sidebarToggleTop">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link text-gray-900 d-md-none rounded-circle mr-3 ">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow mx-1 rounded-circle">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw text-dark"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-light badge-counter text-danger"><?= count($requests); ?></span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header bg-dark">
                  Notifications
                </h6>
                <?php foreach ($requests as $request) : ?>

                <div class="dropdown-item d-flex align-items-center">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="<?= base_url('assets/img/profile/') . $request['image']; ?>" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi Pakar! Request <?= $request['request'] . " " . $request['layanan']; ?></div>
                    <div class="small text-gray-500"><?= $request['name'] ?> &nbsp<h6 class="d-inline"><a href=""><span class="badge badge-primary">TERIMA</span></a></h6>&nbsp<h6 class="d-inline"><a href=""><span class="badge badge-danger">TOLAK</span></a></h6>
                    </div>
                  </div>
                </div>

            <?php endforeach; ?>
             <a class="dropdown-item text-center small text-gray-500" href="<?=base_url('requests');?>">Read More Requests</a>

                
                <!-- <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a> -->
              </div>
            </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-light small">Welcome, <?= $user['name']; ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('user'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->


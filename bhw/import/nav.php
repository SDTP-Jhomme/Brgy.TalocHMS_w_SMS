<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow navbar-fixed">

    <div class="d-flex align-items-center fixed-logo">
        <div class="mh-auto mw-auto">
            <img src="../assets/img/logo-new.png" alt="Logo">
        </div>
        <div class="mh-auto mw-auto">
            <h4 class="m-0 ml-3">Barangay Taloc Online Health Record Management System</h4>
        </div>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow" v-if="this.backToHome">
            <a class="nav-link" href="../bhw" id="" role="button" aria-haspopup="true" aria-expanded="false">
                Back To Home
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $logged_user; ?></span>
                <img class="img-profile rounded-circle" :src="this.avatar">
            </a>
            <!-- Dropdown - User Information -->
            <div id="dropdownMenu" class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="./patient-request">
                    <i class="fas fa-table fa-sm fa-fw mr-2 text-gray-400"></i>
                    Patient(s) Request
                    <span class="badge bg-secondary">
                        <?php
                        $count_request = $db->query("SELECT COUNT(*) as total FROM `pending_request` WHERE status='Pending'");
                        $request = $count_request->fetch_array();

                        echo $request['total'];
                        ?>
                    </span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="./profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" @click="logout" href="#">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
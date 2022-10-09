<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <div class="d-flex align-items-center">
        <div class="mh-auto mw-auto">
            <img src="../assets/img/logo-new.png" style="height: auto; width: auto; max-width: 70px; max-height: 70px;">
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
                <img v-if="avatar" class="img-profile rounded-circle" src="../assets/<?php echo $db_avatar; ?>">
                <img v-else class="img-profile rounded-circle" :src="fileUrl">
            </a>
            <!-- Dropdown - User Information -->
            <div id="dropdownMenu" class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="./profile">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
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
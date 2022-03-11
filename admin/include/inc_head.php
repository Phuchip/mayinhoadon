<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./">
                <div class="sidebar-brand-text mx-3"><img src="../images/logo/logo_admin.png" alt=""></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="./">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Bảng điều khiển</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Quản lý
                </div>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-print"></i>
                    <span>Danh mục sản phẩm</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($active == 'san-pham')? 'active' : '' ?>" href="./san-pham">Máy in</a>
                        <a class="collapse-item <?= ($active == 'hang-san-xuat')? 'active' : '' ?>" href="./hang-san-xuat">Hãng sản xuất</a>
                        <a class="collapse-item <?= ($active == 'loai-may-in')? 'active' : '' ?>" href="./loai-may-in">Loại máy in</a>
                        <a class="collapse-item <?= ($active == 'cong-ket-noi')? 'active' : '' ?>" href="./cong-ket-noi">Cổng kết nối</a>
                        <a class="collapse-item <?= ($active == 'kho-giay')? 'active' : '' ?>" href="./kho-giay">Khổ giấy</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Đơn đặt hàng</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($active == 'don-hang')? 'active' : '' ?>" href="./don-hang">Đơn hàng</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <!-- Comment -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCmt"
                aria-expanded="true" aria-controls="collapseCmt">
                <i class="fas fa-fw fas fa-comments"></i>
                <span>Quản lý bình luận</span>
                </a>
                <div id="collapseCmt" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($active == 'binh-luan')? 'active' : '' ?>" href="./binh-luan">Bình luận</a>
                    </div>
                </div>
            </li>
            <!-- End comment -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Cài đặt
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-user"></i>
                <span>Quản lý tài khoản</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= ($active == 'tai-khoan')? 'active' : '' ?>"" href="./tai-khoan">Tài khoản</a>
                        <a class="collapse-item <?= ($active == 'thong-tin')? 'active' : '' ?>" href="./thong-tin">Thông tin tài khoản</a>
                        <a class="collapse-item <?= ($active == 'doi-mat-khau')? 'active' : '' ?>" href="./doi-mat-khau">Đổi mật khẩu</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION["name"] ?></span>
                        <img class="img-profile rounded-circle"
                        src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="./thong-tin">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Trang cá nhân
                            </a>
                            <a class="dropdown-item" href="./doi-mat-khau">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đổi mật khẩu
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đăng xuất
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
                <!-- End of Topbar -->
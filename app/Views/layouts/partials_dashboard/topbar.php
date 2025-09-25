<!-- Topbar Start -->
<div class="topbar-custom">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li>
                    <button class="button-toggle-menu nav-link">
                        <i data-feather="menu" class="noti-icon"></i>
                    </button>
                </li>
                <li class="d-none d-lg-block">
                    <form class="app-search d-none d-md-block me-auto">
                        <div class="position-relative topbar-search">
                            <input type="text" class="form-control ps-4" placeholder="Search..." />
                            <iconify-icon icon="solar:minimalistic-magnifer-outline" class="align-middle fs-14 position-absolute text-muted top-50 translate-middle-y ms-2"></iconify-icon>
                        </div>
                    </form>
                </li>
            </ul>

            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                <li class="dropdown topbar-dropdown">
                    <a class="nav-link dropdown-toggle me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="/assets/backend/images/flags/us.svg" alt="user-image img-fluid" class="w-100 rounded-2" height="20" width="20" id="selected-language-image" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="en">
                            <img src="/assets/backend/images/flags/us.svg" alt="user-image" class="me-1 rounded" height="18" data-translator-image=""> <span class="align-middle">English</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item" data-translator-lang="hi">
                            <img src="/assets/backend/images/flags/in.svg" alt="user-image" class="me-1 rounded" height="18" data-translator-image=""> <span class="align-middle">Hindi</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="/assets/backend/images/flags/de.svg" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle">German</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="/assets/backend/images/flags/ca.svg" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle">Canada</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="/assets/backend/images/flags/au.svg" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle">Australia</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="/assets/backend/images/flags/ru.svg" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle">Russian</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="/assets/backend/images/flags/si.svg" alt="user-image" class="me-1 rounded" height="18"> <span class="align-middle">Italian</span>
                        </a>
                    </div>
                </li>

                <!-- Button Trigger Customizer Offcanvas -->
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" data-toggle="fullscreen">
                        <iconify-icon icon="solar:minimize-square-outline" class="fs-24 align-middle"></iconify-icon>
                    </button>
                </li>

                <!-- Light/Dark Mode Button Themes -->
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" id="light-dark-mode">
                        <iconify-icon icon="solar:moon-outline" class="fs-24 align-middle dark-mode"></iconify-icon>
                        <iconify-icon icon="solar:sun-2-outline" class="fs-24 align-middle light-mode"></iconify-icon>
                    </button>
                </li>

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <iconify-icon icon="solar:bell-bing-outline" class="fs-24 align-middle light-mode"></iconify-icon>
                        <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0 fs-16 fw-semibold">
                                <span class="float-end"><a href="javascript:void(0);" class="text-dark fs-14"><small class="text-primary">Make all as read</small></a></span>Notification
                            </h5>
                        </div>

                        <div class="noti-scroll" data-simplebar>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                <div class="d-flex align-items-center">
                                    <div class="notify-icon">
                                        <img src="/assets/backend/images/users/avatar/avatar-3.jpg" class="img-fluid rounded-circle" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <p class="notify-details mb-0">Carl Steadham</p>
                                            <iconify-icon icon="solar:record-bold" class="fs-12 text-primary align-middle light-mode"></iconify-icon>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="text-muted mb-0">Thursday 4:20pm</p>
                                            <p class="text-muted mb-0">2 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                <div class="d-flex align-items-start">
                                    <div class="notify-icon">
                                        <img src="/assets/backend/images/users/avatar/avatar-5.jpg" class="img-fluid rounded-circle" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <p class="notify-details mb-0">Carl Steadham</p>
                                            <iconify-icon icon="solar:record-bold" class="fs-12 text-primary align-middle light-mode"></iconify-icon>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <p class="text-muted mb-0">Thursday 4:00pm</p>
                                            <p class="text-muted mb-0">1 hours ago</p>
                                        </div>
                                        <div class="p-2 rounded-2 bg-light">
                                            <p class="text-dark mb-0">Love the background on this! <br> Would love to learn </p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                <div class="d-flex align-items-center">
                                    <div class="notify-icon">
                                        <img src="/assets/backend/images/users/avatar/avatar-1.jpg" class="img-fluid rounded-circle" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <p class="notify-details mb-0">Eleanor Mac </p>
                                            <iconify-icon icon="solar:record-bold" class="fs-12 text-primary align-middle light-mode"></iconify-icon>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="text-muted mb-0">Thursday 3:20pm</p>
                                            <p class="text-muted mb-0">3 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                <div class="d-flex align-items-start">
                                    <div class="notify-icon">
                                        <img src="/assets/backend/images/users/avatar/avatar-7.jpg" class="img-fluid rounded-circle" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <p class="notify-details mb-0">Ollie diggs</p>
                                            <iconify-icon icon="solar:record-bold" class="fs-12 text-primary align-middle light-mode"></iconify-icon>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <p class="text-muted mb-0">Thursday 3:44pm</p>
                                            <p class="text-muted mb-0">2 hours ago</p>
                                        </div>
                                        <div class="d-flex align-items-center gap-1">
                                            <button type="button" class="btn btn-sm bg-white border">Decline</button>
                                            <button type="button" class="btn btn-sm btn-primary">Accept</button>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);"
                            class="dropdown-item text-center text-primary notify-item notify-all fw-bold border-top border-light">View all
                            <i class="fe-arrow-right"></i>
                        </a>
                    </div>
                </li>

                <!-- User Dropdown -->
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <img src="/assets/backend/images/users/profile.jpg" alt="user-image" class="rounded-circle" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome Alex!</h6>
                        </div>

                        <!-- item-->
                        <a href="pages-profile" class="dropdown-item notify-item rounded-2">
                            <iconify-icon icon="solar:shield-user-outline" class="fs-18 align-middle"></iconify-icon>
                            <span>Profile</span>
                        </a>

                        <!-- item-->
                        <a href="pages-profile" class="dropdown-item notify-item rounded-2">
                            <iconify-icon icon="solar:settings-linear" class="fs-18 align-middle"></iconify-icon>
                            <span>Setting</span>
                        </a>

                        <!-- item-->
                        <a href="auth-lock-screen" class="dropdown-item notify-item rounded-2">
                            <iconify-icon icon="solar:lock-keyhole-outline" class="fs-18 align-middle"></iconify-icon>
                            <span>Lock Screen</span>
                        </a>

                        <!-- item-->
                        <a href="auth-logout" class="dropdown-item notify-item rounded-2">
                            <iconify-icon icon="solar:login-3-outline" class="fs-18 align-middle"></iconify-icon>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end Topbar -->
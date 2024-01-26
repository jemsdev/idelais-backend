<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>IDEALIS | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{'/template'}}/src/assets/img/logo.png"/>
    <link href="{{'/template'}}/layouts/vertical-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="{{'/template'}}/layouts/vertical-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{'/template'}}/layouts/vertical-light-menu/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="{{'/template'}}/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{'/template'}}/layouts/vertical-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{'/template'}}/layouts/vertical-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{'/template'}}/src/plugins/src/table/datatable/datatables.css">
    
    <link rel="stylesheet" type="text/css" href="{{'/template'}}/src/plugins/css/light/table/datatable/dt-global_style.css">
    <link href="{{'/template'}}/src/assets/css/light/apps/invoice-list.css" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" type="text/css" href="{{'/template'}}/src/plugins/css/dark/table/datatable/dt-global_style.css">
    <link href="{{'/template'}}/src/assets/css/dark/apps/invoice-list.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->

    <!-- dokumen -->
    <link rel="stylesheet" type="text/css" href="{{'/template'}}/src/plugins/src/tagify/tagify.css">
    <link href="{{'/template'}}/src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{'/template'}}/src/plugins/css/light/tagify/custom-tagify.css">
    <link rel="stylesheet" type="text/css" href="{{'/template'}}/src/plugins/css/light/clipboard/custom-clipboard.css">
    
</head>
<body>

    <!-- BEGIN LOADER -->
     <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">

        <div class="col-md-7"></div>
        {{-- <marquee direction="left">Selamat Datang {{Auth::user()->full_name}}, Akses Anda Adalah {{Auth::user()->role}}</marquee> --}}

            <a href="javascript:void(0);" class="sidebarCollapse">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </a>            

            <ul class="navbar-item flex-row ms-lg-auto ms-0">              

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-container">
                            <div class="avatar avatar-sm avatar-indicators avatar-online">
                                <img alt="avatar" src="{{'/template'}}/src/assets/img/user.png" class="rounded-circle">
                            </div>
                        </div>
                    </a>

                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <div class="emoji me-2">
                                    &#x1F44B;
                                </div>
                                <div class="media-body">
                                    {{-- <h5>{{Auth::user()->full_name}}</h5>
                                    <p>{{Auth::user()->role}}</p> --}}
                                </div>
                            </div>
                        </div>
                        <!-- <div class="dropdown-item">
                            <a href="user-profile.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>Profile</span>
                            </a>
                        </div>                         -->
                        <div class="dropdown-item">                            
                            <a data-bs-toggle="modal" data-bs-target="#registerModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-unlock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 9.9-1"></path></svg> <span>Ubah Password</span>
                            </a>                            
                        </div>
                        <div class="dropdown-item">
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>
                            </a>                                                       
                        </div>
                    </div>
                    
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

        @include('layout.sidebar')

        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    <!-- <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Layouts</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Full Width</li>
                            </ol>
                        </nav>
                    </div> -->
                    
                    @yield('content')
                    
                </div>
                
            </div>

            <!--  BEGIN FOOTER  -->
            <div class="footer-wrapper mt-0">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <span class="dynamic-year">{{date('Y')}}</span> <a target="_blank" href="">IDEALIS</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
            <!--  END FOOTER  -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{'/template'}}/src/plugins/src/global/vendors.min.js"></script>
    <script src="{{'/template'}}/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{'/template'}}/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{'/template'}}/src/plugins/src/mousetrap/mousetrap.min.js"></script>
    <script src="{{'/template'}}/layouts/vertical-light-menu/app.js"></script>
    <script src="{{'/template'}}/src/assets/js/custom.js"></script>

    <link href="{{'/template'}}/src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" type="text/css" href="{{'/template'}}/src/plugins/css/light/editors/quill/quill.snow.css"> -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{'/template'}}/src/plugins/src/table/datatable/datatables.js"></script>
    <script src="{{'/template'}}/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js"></script>

    <script src="{{'/template'}}/src/plugins/src/flatpickr/flatpickr.js"></script>
    <script src="{{'/template'}}/src/plugins/src/flatpickr/custom-flatpickr.js"></script>

    <link href="{{'/template'}}/src/assets/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="{{'/template'}}/src/assets/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" />

    <link href="{{'/template'}}/src/plugins/src/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="{{'/template'}}/src/plugins/src/noUiSlider/nouislider.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="{{'/template'}}/src/plugins/css/light/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">     -->    

    <link rel="stylesheet" href="{{'/template'}}/src/plugins/src/filepond/filepond.min.css">
    <link rel="stylesheet" href="{{'/template'}}/src/plugins/src/filepond/FilePondPluginImagePreview.min.css">
    <link rel="stylesheet" type="text/css" href="{{'/template'}}/src/plugins/src/tagify/tagify.css">
    
    <link rel="stylesheet" type="text/css" href="{{'/template'}}/src/assets/css/light/forms/switches.css">    
    <link rel="stylesheet" type="text/css" href="{{'/template'}}/src/plugins/css/light/tagify/custom-tagify.css">
    <link href="{{'/template'}}/src/plugins/css/light/filepond/custom-filepond.css" rel="stylesheet" type="text/css" />

    <link rel="icon" type="image/x-icon" href="{{'/template'}}/src/assets/img/favicon.ico"/>
    <link href="{{'/template'}}/layouts/vertical-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />    
    <script src="{{'/template'}}/layouts/vertical-light-menu/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="{{'/template'}}/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{'/template'}}/layouts/vertical-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />    

    <!-- documen -->
    <script src="{{'/template'}}/src/plugins/src/tagify/tagify.min.js"></script>
    <script src="{{'/template'}}/src/plugins/src/tagify/custom-tagify.js"></script>

    <script src="{{'/template'}}/src/plugins/src/clipboard/clipboard.min.js"></script>
    <script src="{{'/template'}}/src/plugins/src/clipboard/custom-clipboard.min.js"></script>

    <script>
        $(".point-text").text(function(i, txt) {
            return txt.substring(0,45) + (txt.length > 45 ? ' ...' : '');
        });
    </script>
    
    @stack('custom-scripts')
</body>
</html>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="background-color: #ffff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="" method="POST" id="editForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />                    
                    <div class="col-12" id="f-password">
                        <label class="form-label">Password Lama</label>
                        <input name="current_password" id="current_password" type="password" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-12" id="f-password">
                        <label class="form-label">Password Baru</label>
                        <input name="new_password" id="new_password" type="password" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-12" id="f-con-password">
                        <label class="form-label">Confirm Password</label>
                        <input name="new_confirm_password" id="new_confirm_password" type="password" class="form-control" autocomplete="off">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>
    <link rel="icon" href="{{  asset('assets/img/icon.png') }}" type="image/png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{  asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{  asset('assets/css/ionicons.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 
    <link rel="stylesheet" href="{{  asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    -->
    <!-- iCheck 
    <link rel="stylesheet" href="{{  asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    -->
    <!-- JQVMap 
    <link rel="stylesheet" href="{{  asset('assets/plugins/jqvmap/jqvmap.min.css')}}">
    -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{  asset('assets/css/adminlte.min.css') }}">
    <!-- overlayScrollbars 
    <link rel="stylesheet" href="{{  asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    -->
    <!-- Daterange picker 
    <link rel="stylesheet" href="{{  asset('assets/plugins/daterangepicker/daterangepicker.css')}}"> -->
    <!-- summernote 
    <link rel="stylesheet" href="{{  asset('assets/plugins/summernote/summernote-bs4.min.css')}}"> -->
     @stack("header")
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{url('')}}/admin" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a onclick="alert('Siapa admin kantor? email / no.telepon?')" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{  url('admin') }}" class="brand-link">
                <div class="row">
                    <div class="col-3" style="position: relative;top: 50%;transform: translateY(25%)">
                        <img src="{{  asset('assets/img/icon.png') }}" alt="BPSB" class="brand-image" style="-webkit-filter: drop-shadow(0px 0px 5px #feffd9);filter: drop-shadow(0px 0px 5px #aaaaaa);">
                    </div>
                    <div class="col-9">
                        <span class="brand-text font-weight-light text-center">UPT. PSBTPH<br>Jawa Timur</span>
                    </div>
                </div>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex text-center">
                    <div class="info" style="width: 100%;">
                        <i><a class="d-block" id="akun_name"></a></i>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">MENU UTAMA</li>
                        <li class="nav-item">
                            <a href="{{url('admin')}}" class="nav-link active">
                                <i class="fas fa-home nav-icon"></i>
                                <p>Halaman Utama</p>
                            </a>
                        </li>
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="fas fa-certificate nav-icon"></i>
                                <p>Sertifikasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('admin/sertifikasi/pengajuan')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pengajuan & Fase Lap</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/sertifikasi/pasca')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pasca Lapangan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/sertifikasi/label')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Konsep Label</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="fas fa-flask nav-icon"></i>
                                <p>Laboratorium
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('admin/lab/uji')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Uji Laboratorium</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/lab/buku-induk')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Buku Induk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/lab/log')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laboratorium Log</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="fas fa-database nav-icon"></i>
                                <p>Data Master
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('admin/master/golongan')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Golongan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/kumpulan')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Kumpulan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/jenis-tanaman')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Jenis Tanaman</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/varietas')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Varietas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/gol-kelas-benih')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Gol Kelas Benih</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/kelas-benih')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Kelas Benih</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/penyakit')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Penyakit</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/kabupaten')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Kabupaten</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/kecamatan')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Kecamatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/satuan')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Satuan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/wilayah-kerja')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Wilayah Kerja</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/status')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Status</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/produsen')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Produsen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/pegawai')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master Pegawai</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/m-anggaran')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Master M. Anggaran</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/konfigurasi-user')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Konfigurasi User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/master/daftar-user')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="fas fa-cogs nav-icon"></i>
                                <p>Manajemen Aplikasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('admin/app/serti-log')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Serti Log</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/app/lab-log')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laboratorium Log</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/app/restore-db')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Restore Database</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('admin/app/backup-db')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Backup Database</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/user-info')}}" class="nav-link">
                                <i class="fas fa-info-circle nav-icon"></i>
                                <p>User Info</p>
                            </a>
                        </li>
                        <li class="nav-item menu-close">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user nav-icon"></i>
                                <p>User Menu
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('admin/feedback')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Feedback</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a onclick="logout()" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Logout</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield("title")</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if(session()->has('error'))
                    <div class="alert alert-info">
                        {{ session('error') }}
                    </div>
                    @endif
                    @yield("content")
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
               <!-- <strong><a href="https://wa.me/6289668932031?text=...">FDR</a></strong> -->
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; {{date("Y")}} UPT. PSBTPH Jawa Timur</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{  asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4  -->
    <script src="{{  asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> 
    <!-- Bootstrap 4 -->
    <script src="{{  asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{  asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline 
    <script src="{{  asset('assets/plugins/sparklines/sparkline.js') }}"></script>-->
    <!-- JQVMap 
    <script src="{{  asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{  asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>-->
    <!-- jQuery Knob Chart
    <script src="{{  asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script> -->
    <!-- daterangepicker -->
    <script src="{{  asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{  asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 
    <script src="{{  asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  
    <script src="{{  asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script src="{{  asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
   -->
    <script src="{{  asset('assets/js/adminlte.js') }}"></script>
    <script src="{{  asset('assets/js/helper.js') }}"></script>
    <script>
        var is_admin_provinsi = fetch(api_url + "/admin/is_admin_provinsi", {
            method: "GET",
            headers: {
                Authorization: "Bearer " + localStorage.getItem("token")
            }
        }).then(
            response => {
                if (response.status == 200) {
                    $("#isAdmin").removeClass("d-none");
                    $("#userLink").html(`
                        <a href="{{url('admin/daftar_user')}}/" class="small-box-footer" style="color:white !important;">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    `);
                } else if (response.status == 401) {
                    // throw new Error("Kesalahan Token")
                } else {
                    // throw new Error("Terjadi Kesalahan")
                }
            }
        ).catch(e => alert(e));

        var title = '@yield("title")';
        var ownerTitle = "UPT PENGAWASAN DAN SERTIFIKASI BENIH TANAMAN PANGAN DAN HORTIKULTURA";
        var completeTitle = title + " | ADMIN | " + ownerTitle + " | ";
        (function titleScroller(text) {
            document.title = text;
            setTimeout(function() {
                titleScroller(text.substr(1) + text.substr(0, 1));
            }, 100);
        }(completeTitle));
    </script>
    <script>
        function logout() {
            localStorage.clear();
            window.location.href = "{{url('')}}/login";
        }
        (function() {
            // cekAuth(true);

            // var pathname = window.location.pathname; // Returns path only (/path/example.html)
            var current_url = window.location.href; // Returns full URL (https://example.com/path/example.html)
            // var origin = window.location.origin; // Returns base URL (https://example.com)

            $(".nav-link").removeClass('active')
            $(`.nav-link[href='${current_url}']`).addClass('active')

            user = localStorage.getItem('user')
            $("#akun_name").html(user ? "- " + user + " -" : "- Guest -")
        })()
    </script>

    @stack("footer")

</body>

</html>
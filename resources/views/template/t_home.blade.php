<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>
    <link rel="icon" href="{{  url('') }}/assets/img/icon.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{  url('') }}/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{  url('') }}/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{  url('') }}/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="{{  url('') }}/assets/css/falling-leaves.css">
    @stack("header")
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-lg navbar-light navbar-white">
            <div class="container">
                <a href="{{  url('') }}/daftar_detail" class="navbar-brand">
                    <img src="{{  url('') }}/assets/img/icon.png" alt="BPSB" class="brand-image" style="-webkit-filter: drop-shadow(0px 0px 5px #feffd9);filter: drop-shadow(0px 0px 5px #aaaaaa);">
                    <span class="brand-text font-weight-light" style="color:#15a4d9">UPT. PSBTPH Jawa Timur</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <!-- dropdown -->
                            <!-- <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Pendaftaran</a> -->
                            <!-- <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"> -->
                            <!-- <li></li> -->
                            <!-- <li class="dropdown-divider"></li> -->
                            <!-- <li></li> -->
                            <!-- Level two dropdown-->
                            <!-- <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                        </li>

                                        <li class="dropdown-submenu">
                                            <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                                            <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                                            </ul>
                                        </li>

                                        <li><a href="#" class="dropdown-item">level 2</a></li>
                                        <li><a href="#" class="dropdown-item">level 2</a></li>
                                    </ul>
                                </li> -->
                            <!-- End Level two -->
                            <!-- </ul> -->
                        </li>

                        <li class="nav-item">
                            <a href="{{url('')}}/daftar_detail" class="nav-link">Berkas Pengajuan Awal</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('')}}/rekap_pengajuan_tanaman" class="nav-link">Rekap Pengajuan Sertifikasi</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">List Sertifikat</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{url('certrecom')}}">Sertifikat Rekomendasi/Kompetensi</a>
                                <a class="dropdown-item" href="{{url('sertifikat')}}/">Sertifikat Benih</a>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto" style="max-width:18%;">

                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown" style="max-width:100%;">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <!-- <span class="badge badge-warning navbar-badge">15</span> -->
                        </a>
                        <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div> -->
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link rounded border border-primary" data-toggle="dropdown" style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;max-width: 70%;max-width: calc(100% - 4em);" href="#">
                            <i class="fas fa-user-circle"></i> <span id="akun_name" style="" title=""></span>
                            <!-- <span class="badge badge-danger navbar-badge">3</span> -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                            <a href="{{url('')}}/ubah" class="dropdown-item">
                                <i class="fas fa-recycle mr-1"></i> Ubah Data Pribadi
                            </a>
                            <a href="https://wa.me/6285234400071?text=Hai Admin BPSB Saya ingin bertanya....." target="_blank" class="dropdown-item">
                                <i class="fas fa-phone mr-1"></i> Hubungi Admin
                            </a>
                            <a onclick="showLogoutConfirm()" class="dropdown-item">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section>

                <div class="set set2">
                    <div><img src="{{  url('') }}/assets/img/1.png"></div>
                    <div><img src="{{  url('') }}/assets/img/4.png"></div>
                    <div><img src="{{  url('') }}/assets/img/5.png"></div>
                    <div><img src="{{  url('') }}/assets/img/3.png"></div>
                    <div><img src="{{  url('') }}/assets/img/2.png"></div>

                </div>
                <div class="set">
                    <div><img src="{{  url('') }}/assets/img/3.png"></div>
                    <div><img src="{{  url('') }}/assets/img/5.png"></div>
                    <div><img src="{{  url('') }}/assets/img/4.png"></div>
                    <div><img src="{{  url('') }}/assets/img/1.png"></div>
                    <div><img src="{{  url('') }}/assets/img/2.png"></div>
                    <div><img src="{{  url('') }}/assets/img/3.png"></div>

                </div>

                <!-- <div class="set set3">
                    <div><img src="{{  url('') }}/assets/img/1.png"></div>
                    <div><img src="{{  url('') }}/assets/img/2.png"></div>
                </div> -->
                @yield("content")

            </section>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
             <!--   <strong><a href="https://wa.me/6282231001560?text=Hi mas faizal, Perkenalkan saya... ,ingin membuat aplikasi untuk ...">FDR</a></strong> -->
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; {{date("Y")}} UPT. PSBTPH Jawa Timur</strong>
        </footer>
    </div>

    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        // ga('create', 'UA-46156385-1', 'cssscript.com');
        ga('send', 'pageview');
    </script>
    <!-- jQuery -->
    <script src="{{  url('') }}/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{  url('') }}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{  url('') }}/assets/js/adminlte.min.js"></script>
    <script>
        (function titleScroller(text) {
            document.title = text;
            setTimeout(function() {
                titleScroller(text.substr(1) + text.substr(0, 1));
            }, 100);
        }('@yield("title")' + " | Badan Sertifikasi Benih Tanaman Pangan Hortikultura (BPSBTPH) Provinsi Jawa Timur | "));
    </script>
    <script src="{{  url('') }}/assets/js/helper.js"></script>
    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutConfirmModal" tabindex="-1" role="dialog" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutConfirmModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar dari aplikasi?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="confirmLogout()">Logout</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showLogoutConfirm() {
            $('#logoutConfirmModal').modal('show');
        }

        function confirmLogout() {
            $('#logoutConfirmModal').modal('hide');
            localStorage.clear();
            window.location = b_url;
        }

        function logout() {
            localStorage.clear();
            window.location = b_url;
        }
        (function() {
            cekAuth();

            user = localStorage.getItem('user')
            $("#akun_name").html(user)
            $('#akun_name').prop('title', user);
        })()
    </script>
    @stack("footer")
</body>

</html>
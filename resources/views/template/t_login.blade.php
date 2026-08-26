<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>
    <link rel="icon" href="{{  url('') }}/assets/img/icon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{  url('') }}/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{  url('') }}/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{  url('') }}/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="{{  url('') }}/assets/css/falling-leaves.css">
    <style>
        b, strong{
            font-weight: 600 !important;
        }
    </style>
    @stack("header")
</head>

<body class="hold-transition login-page">
    <section>
        <div class="set">
            <div><img src="{{  url('') }}/assets/img/1.png"></div>
            <div><img src="{{  url('') }}/assets/img/4.png"></div>
            <div><img src="{{  url('') }}/assets/img/2.png"></div>
            <div><img src="{{  url('') }}/assets/img/5.png"></div>
            <div><img src="{{  url('') }}/assets/img/3.png"></div>

        </div>
        <div class="set set2">
            <div><img src="{{  url('') }}/assets/img/4.png"></div>
            <div><img src="{{  url('') }}/assets/img/5.png"></div>
            <div><img src="{{  url('') }}/assets/img/4.png"></div>
            <div><img src="{{  url('') }}/assets/img/2.png"></div>
            <div><img src="{{  url('') }}/assets/img/1.png"></div>

        </div>
        @yield("content")


    </section>
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
    <script src="{{  url('') }}/assets/js/helper.js"></script>
    <script>
        (function titleScroller(text) {
            document.title = text;
            setTimeout(function() {
                titleScroller(text.substr(1) + text.substr(0, 1));
            }, 100);
        }('@yield("title")' + " | UPT. Pengawasan dan Sertifikasi Benih Tanaman Pangan dan Hortikultura | "));
    </script>
    @stack("footer")
</body>

</html>
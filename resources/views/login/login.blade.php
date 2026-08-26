@extends("template.t_login")

@section("title", "Login")
@push('header')
<style>
    /* Gaya tombol WhatsApp */
    .whatsapp-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #25d366;
        background-image: url("assets/whatsapp.png");
            color: #fff;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        text-align: center;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    /* Gaya saat hover */
    .whatsapp-button:hover {
        background-color: #128c7e;
    }
</style>
@endpush
@section("content")
<div class="login-box" style="box-shadow: 0px 0px 20px #283618;">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <br>
            <img src="{{  url('') }}/assets/img/icon.png" alt="LOGO BPSBTPH" height="100px">
            <br>
            <span class="h6" style="font-size: 11pt !important;">
                <span style="line-height: 3;font-size: 10pt; color: #283618;">DINAS PERTANIAN DAN KETAHANAN PANGAN
                </span><br>
                <b style="line-height: 1; color: #283618;">UPT PENGAWASAN DAN SERTIFIKASI BENIH TANAMAN PANGAN DAN HORTIKULTURA<br>
                </b>
            </span>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center text-center">
                <?= $info ?>
            </div>
            <p class="text-center" style="font-size: 10pt;"><?= $info2 ?></p>

            <form id="formLogin" method='post'>
                <div class="input-group mb-3">
                    <input id="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <?= $link_daftar ?>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" id="btRegister" class="btn btn-primary btn-block">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loading"></span>
                            Sign In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<a href="https://api.whatsapp.com/send?phone=6289668932031" target="_blank" class="whatsapp-button"><img src='{{ url("") }}/assets/img/whatsapp.png' /></a>
@endsection

@push('footer')
<script>
    (() => {
        $("#loading").hide()

        var fLogin = document.querySelector("#formLogin")

        fLogin.addEventListener("submit", function(ev) {
            ev.preventDefault();
            $("#loading").show()
            email = document.querySelector("#email").value;
            password = document.querySelector("#password").value;
            fd = new FormData();
            fd.append("username", email)
            fd.append("password", password)
            fd.append("_token", document.querySelector('meta[name="csrf-token"]').content)
            fetch("{{$url_login}}", {
                method: "POST",
                body: fd
            }).then(
                response => {
                    if (response.status == 202 || response.status == 406 || response.status == 422) {
                        return response.json();
                    } else if (response.status == 200) {
                        return response.json();
                    } else {
                        throw new Error('Terjadi Kesalahan, Silahkan coba lagi')
                    }
                }
            ).then(
                a => {
                    if (a.sukses == true) {
                        alertAksiLogin("Berhasil Login", tipe = 'bg-success')
                        localStorage.setItem('token', a.data.token)
                        localStorage.setItem('user', a.data.user[0].name)
                        window.location.href = a.data.url
                    } else {
                        if (typeof a.data === "object") {
                            info = infoForm(a.data)
                            alertAksiLogin(info)
                        } else {
                            alertAksiLogin(a.data)
                        }
                    }
                    $("#loading").hide()

                }
            ).catch(e => {
                alert(e);
                $("#loading").hide()
            })
        })
    })()
</script>
<!-- /.login-box -->
@endpush
// assets/js/helper.js

var b_url = "https://daftar.bpsbjatim.com"

// var b_url = "http://192.168.10.181:8000"
var api_url = b_url + "/api"
var url_login = api_url + "/login";
var url_register = api_url + "/register";

var url_tambah_user_pemohon_ulang = api_url + "/user_pemohon/daftar_ulang"
var url_tambah_user_pemohon = api_url + "/user_pemohon/tambah"
var url_detail_user_pemohon = api_url + "/user_pemohon/detail"

var url_tambah_permohonan_pendaftaran = api_url + "/permohonan_pendaftaran/tambah"

var token = localStorage.getItem('token')

function infoForm(obj) {
    operasi = Object.keys(obj)
    var hasil = "",
        h = ""
    operasi.forEach(key => {
        // console.log(obj[key])
        obj[key].forEach(k => {
            h += `<li>${k}</li>`
        })
        hasil += `<li>${key}<ul>${h}</ul></li>`
        h = ""
    });
    return "<ol>" + hasil + "</ol>"
}

function alertAksiLogin(info, tipe = 'bg-danger', judul = 'Aksi Login') {
    $(document).Toasts('create', {
        class: tipe,
        title: judul,
        body: info
    })
}
// function infoForm(obj) {
//     operasi = Object.keys(obj)
//         .reduce(function(hasil, key) {
//             info = obj[key].reduce(function(h, k) {
//                 h += `<li>${k}</li>`
//                 console.log(h)
//                 return h
//             })
//             hasil += `<li>${key}<ul>${info}</ul></li>`
//             console.log(hasil)
//             return hasil
//         });
//     return "<ol>" + operasi + "</ol>"
// }

function kapitalisasi(teks, jk = [true, 1]) {
    // console.log(jk);

    if (jk[0]) {
        teks = teks.replaceAll('_', ' ')
    }
    switch (jk[1]) {
        case 1:
            return teks.toLowerCase().replace(/^(.)|(\s|\-)(.)/g,
                function (c) {
                    return c.toUpperCase();
                })
        case 2:
            return teks.toUpperCase()
        case 3:
            return teks.toLowerCase()
        default:
            return teks;
    }
}

function parseJwt(token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
};


function isAuthenticated() {
    const token = localStorage.getItem('token');
    const refreshToken = localStorage.getItem('refreshToken');
    try {
        // decode(token);
        const { exp } = parseJwt(token);
        //   if (exp < (new Date().getTime() + 1) / 1000) {
        //     return false;
        //   }

        if (Date.now() >= exp * 1000) {
            return false;
        }
    } catch (err) {
        return false;
    }
    return true;
}
function cekAuth(isAdmin = false) {
    setTimeout(() => {
        isAuthenticate = isAuthenticated();
        if (!isAuthenticate) {
            alert("Sesi Login Anda Telah Berahir");
            if (isAdmin) {
                window.location = b_url+"/login_admin"
            } else {
                window.location = b_url
            }
        }
        cekAuth();
    }, 1000);
}
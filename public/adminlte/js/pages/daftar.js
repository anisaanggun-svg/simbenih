var noLangkah = 1;
var fd1 = new FormData();
var berkas = [`nama_usaha`, 'jenis_pengajuan', `nama_pimpinan`,
    `jl`, `rt`, `rw`, `dusun_kampung`,
    `id_user_desa`, `status_usaha`,
    `bentuk_usaha`, `telepon`, `fax`,
    `komoditas`, 'no_tdpb', 'badan_usaha'
]

var parameterInput1 = [
    // ["gambar", "image/jpg", "fa-image"],
    [`surat_permohonan`, "application/pdf", "fa-newspaper"],
    [`profil_usaha`, "application/pdf", "fa-business-time"],
    [`akte_pendirian_usaha`, "application/pdf", "fa-sticky-note"],
    [`surat_kuasa_direktur_utama`, "application/pdf", "fa-hand-paper"],
    [`ktp`, "application/pdf", "fa-credit-card", [true, 2]],
    [`npwp`, "application/pdf", "fa-paperclip", [true, 2]],
    [`siup`, "application/pdf", "fa-paper-plane", [true, 2]],
    [`foto`, "application/pdf", "fa-camera"],
    [`surat_keterangan_domisili_usaha`, "application/pdf", "fa-newspaper"],
    [`peta`, "application/pdf", "fa-map"],
    [`foto_dokumentasi`, "application/pdf", "fa-photo-video"],
    [`surat_pernyataan`, "application/pdf", "fa-hand-paper"],
    [`rekomendasi`, "application/pdf", "fa-shopping-bag"],
    [`hasil_peninjauan_ulang`, "application/pdf", "fa-shopping-bag"],
]

var kab = $("#kabupaten");
var kec = $("#kecamatan");
var des = $("#desa");

var kabupaten_kota
var kecamatan
var desa
async function createTemplate(inisialTemplate, elemenId, parameterInput, n_fd) {
    var formBerkasPengajuan = document.getElementById(elemenId)
    var inputTemplate = inisialTemplate
    await parameterInput.forEach(e => {
        // console.log(typeof e[3]  !=  "undefined");
        
        var isSiup = e[0] == "siup" ? "SIUP/NIB":e[0];

        inputTemplate +=
            `<div class="form-group col-12 col-md-6 col-sm-6">
        <label class="btn btn-block btn-dark"  id="area${e[0]}" ${e[0] == "rekomendasi" ? 'style="border-color:red;"':""}>
            <i class="fas ${e[2]}"></i> ${(typeof e[3] == "undefined") ? kapitalisasi(e[0]) : kapitalisasi(isSiup, e[3])}<br>
            <div class="previewFile" id="${e[0]}">Letakkan file (.PDF) Disini</div>
                <input name="${e[0]}" type="file" id="fileInput" style="display: none;"  accept="${Array.isArray(e[1]) ? e[1].join(', ') : e[1]}" />
        </label></div>`
    })
    formBerkasPengajuan.innerHTML = inputTemplate


    await parameterInput.forEach(e => {
        let dropContainer = document.getElementById("area" + e[0])
        let dragText = document.getElementById(e[0])
        input = dropContainer.querySelector("input");

        input.addEventListener("change", function () {
            file = this.files[0];
            dropContainer.classList.add("active");
            nama = this.attributes["name"].value
            // console.log(nama);

            viewfile(nama);
        });

        dropContainer.ondragover = dropContainer.ondragenter = function (evt) {
            evt.preventDefault();
        };
        dropContainer.addEventListener("drop", (event) => {
            event.preventDefault();
            file = event.dataTransfer.files[0];
            input.files = event.dataTransfer.files;
            nama = dropContainer.querySelector("input").attributes["name"].value

            viewfile(nama);
        });

        async function viewfile(nama) {
            let fileType = file.type;
            let namaFile = input.value.split("\\");
            let validExtensions = ["image/jpeg", "image/jpg"];
            let validExtensionsPDF = ["application/pdf"];

            if (e[1].includes(fileType)) {
                if (validExtensions.includes(fileType)) {
                    let fileReader = await new FileReader();
                    fileReader.onload = async () => {
                        let fileURL = await fileReader.result;
                        let imgTag = `<img class="preview-img" src="${fileURL}" alt="image" height="150px">
                <br><span>${namaFile[namaFile.length - 1]}</span>`;
                        dragText.innerHTML = await imgTag;
                    }
                    fileReader.readAsDataURL(file);

                    if (n_fd == 1) {
                        await fd1.set(nama, file)
                    } else if (n_fd == 2) {
                        await fd2.set(nama, file)
                    }

                } else if (validExtensionsPDF.includes(fileType)) {
                    let fileReader = await new FileReader();
                    fileReader.onload = async () => {
                        let fileURL = await fileReader.result;
                        let imgTag = `<iframe id="iframePDF" class="preview-iframe" src="${fileURL}" frameborder="0">`;
                        dragText.innerHTML = await imgTag;
                    }
                    fileReader.readAsDataURL(file);

                    if (n_fd == 1) {
                        await fd1.set(nama, file)
                    } else if (n_fd == 2) {
                        await fd2.set(nama, file)
                    }
                } else {
                    alert("Silakan Upload File yang Sesuai");
                }
            } else {
                alert("Silakan Upload File yang Sesuai");
            }
        }
    })
}

$(document).ready(async function () {
    // $('#myModal').modal('show');

    createTemplate("", "berkasPengajuan1", parameterInput1, 1)


    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })


    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $(".next").click(async function () {


        if (noLangkah === 1) {
            var frm = document.getElementById('formBerkasPengajuan');

            for (var i = 0; i < frm.elements.length; i++) {
                if (frm.elements[i].value === '' && frm.elements[i].hasAttribute('required')) {
                    alert('Semua form harus terisi terlebih dahulu : ' + frm.elements[i].attributes["placeholder"].value);

                    return;
                }
            }
        } else if (noLangkah === 2) {
            if (!confirm("Apakah anda yakin data sudah sesuai?")) {
                return;
            }
            berkas.forEach(e => {
                // console.log(e);
                // console.log(document.getElementsByName(e)[0].value);

                fd1.set(e, document.getElementsByName(e)[0].value)
            })
            parameterInputValidasi = parameterInput1.map((a) => a[0]).concat(berkas)
            // console.log(parameterInputValidasi);

            var arrFD = []
            for (var z of fd1) {
                arrFD.push(z[0])
            }
            // console.log(arrFD)
            // cek semua berkas
            // if (JSON.stringify(parameterInputValidasi.sort()) !== JSON.stringify(arrFD.sort())) {
            //     let difference = parameterInputValidasi.filter(x => !arrFD.includes(x));
            //     arrFDMap = difference.reduce((p, cv) => {
            //         return p + cv.replaceAll("_", " ") + ", "
            //     }, "")
            //     alert('Semua form harus terisi terlebih dahulu : ' + arrFDMap);
            //     return;
            // } else {
                $('#myModal').modal('show');

                if (!await kirimBerkas()) {
                    // console.log("ces");

                    return;
                }
                // console.log("ces2");

            // }

        }
        noLangkah++

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({ 'opacity': opacity });
            },
            duration: 600
        });
    });

    $(".previous").click(function () {
        noLangkah--

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 600
        });
    });

    $('.radio-group .radio').click(function () {
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });

    $(".submit").click(function () {
        return false;
    })

    kabupaten_kota = await fetch(api_url + "/kabupaten_kota")
        .then(response => response.json())
        .then(async (hasil) => {
            // k = document.getElementById("kabupaten").querySelector("option")
            tmpl = `<option value="" disabled selected>Kabupaten...</option>`
            await hasil.forEach(d => {
                tmpl += `<option value="${d["id_kabupaten_kota"]}">${d["nama_kabupaten_kota"]}</option>`
            })
            // k.insertAdjacentHTML('afterend', template);
            kab.html(tmpl)
            return hasil
        })
    kecamatan = await fetch(api_url + "/kecamatan").then(response => response.json())
    desa = await fetch(api_url + "/desa").then(response => response.json())

    kab.change(function () {
        des.html(`<option value="" disabled selected>Desa...</option>`);

        tmpl = `<option value="" disabled selected>Kota/Kecamatan...</option>`

        kecamatan
            .filter(dt => {

                return dt["id_kecamatan_kabupaten_kota"] === kab.val()
            })
            .forEach(d => {
                //hapus yg lama
                tmpl += `<option value="${d["id_kecamatan"]}">${d["nama_kecamatan"].toUpperCase()}</option>`
            })
        // sub_kec = kec.find("option")
        // sub_kec.after(template);
        kec.html(tmpl);
    });

    kec.change(function () {
        tmpl = `<option value="" disabled selected>Desa...</option>`
        // console.log(kec.val());

        desa
            .filter(dt => {

                return dt["id_desa_kecamatan"] === kec.val()
            })
            .forEach(d => {
                //hapus yg lama
                tmpl += `<option value="${d["id_desa"]}">${d["nama_desa"].toUpperCase()}</option>`
            })
        // sub_kec = kec.find("option")
        // sub_kec.after(template);
        des.html(tmpl);
    });
});

async function kirimBerkas() {
    let response = await fetch(url_tambah_user_pemohon, {
        method: "post",
        body: fd1,
        headers: {
            Authorization: 'Bearer ' + token
        }
    }).then(
        response => {
            $('#myModal').modal('hide');

            if (response.status == 202 || response.status == 400) {
                return response.json();
            } else {
                throw new Error('Terjadi Kesalahan')
            }
        }
    ).then(
        a => {
            if (a.sukses == true) {
                alertAksiLogin("Berhasil Kirim Berkas", tipe = 'bg-success', judul = "Kirim Berkas")
                return true;
            } else {
                if (typeof a.data === "object") {
                    info = infoForm(a.data)
                    alertAksiLogin(info, judul = "Kirim Berkas")
                } else if (a.data == "Token has expired") {
                    alertAksiLogin("Token Expired")
                    window.location.href = b_url
                } else {
                    alertAksiLogin(a.data, judul = "Kirim Berkas")
                }
                return false;
            }
        }
    ).catch(e => {
        $('#myModal').modal('hide');

        alert(e);
        // console.log(e);
        return false;
    });

    // console.log(response);
    return response

    // document.getElementById("berkasPengajuan").submit()
}

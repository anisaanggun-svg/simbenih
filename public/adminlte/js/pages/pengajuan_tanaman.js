var fd2 = new FormData();

var parameterInput2 = [
    [`surat_permohonan`, "application/pdf", "fa-newspaper"],
    [`surat_pernyataan`, "application/pdf", "fa-hand-paper"],
    [`kemasan`, "application/pdf", "fa-shopping-bag"],
]

initBerkasPengajuan2 = `
<div class="form-group col-12 col-md-12 col-sm-12">
<select id="jenis_pengajuan" name="jenis_pengajuan" class="form-control" aria-label="Default select example">
    <option value="" selected disabled>Pilih Jenis Pengajuan</option>
    <option>Tanaman Pangan</option>
    <option>Hortikultura</option>
</select>
</div>
`

async function createTemplate(inisialTemplate, elemenId, parameterInput, n_fd) {
    var formBerkasPengajuan = document.getElementById(elemenId)
    var inputTemplate = inisialTemplate
    await parameterInput.forEach(e => {
        inputTemplate +=
            `<div class="form-group col-12 col-md-6 col-sm-6">
        <label class="btn btn-block btn-dark"  id="area${e[0]}">
            <i class="fas ${e[2]}"></i> ${e[0].replaceAll('_', ' ').toLowerCase().replace(/^(.)|(\s|\-)(.)/g,
                function (c) {
                    return c.toUpperCase();
                })}<br>
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

                    await fd2.set(nama, file)

                } else if (validExtensionsPDF.includes(fileType)) {
                    let fileReader = await new FileReader();
                    fileReader.onload = async () => {
                        let fileURL = await fileReader.result;
                        let imgTag = `<iframe id="iframePDF" class="preview-iframe" src="${fileURL}" frameborder="0">`;
                        dragText.innerHTML = await imgTag;
                    }
                    fileReader.readAsDataURL(file);

                    await fd2.set(nama, file)
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
    createTemplate("", "berkasPengajuan1", parameterInput1, 1)

    $(".simpan").click(async function () {

        let jenis_pengajuan = document.getElementsByName("jenis_pengajuan")[0].value
        fd2.set("jenis_pengajuan", jenis_pengajuan)
        parameterInputValidasi2 = parameterInput2.map((a) => a[0]).concat(["jenis_pengajuan"])
        // console.log(parameterInputValidasi2);

        var arrFD2 = []
        for (var z of fd2) {
            arrFD2.push(z[0])
        }
        if (JSON.stringify(parameterInputValidasi2.sort()) !== JSON.stringify(arrFD2.sort())) {
            let difference = parameterInputValidasi2.filter(x => !arrFD2.includes(x));
            arrFDMap = difference.reduce((p, cv) => {
                return p + cv.replaceAll("_", " ") + ", "
            }, "")
            alert('Semua form harus terisi terlebih dahulu : ' + arrFDMap);
            return;
        } else {
            if (!await kirimBerkas2()) {
                // console.log("ces");
                return;
            }
            // console.log("ces2");
        }

    });
});

async function kirimBerkas2() {
    let response = await fetch(url_tambah_permohonan_pendaftaran, {
        method: "post",
        body: fd2,
        headers: {
            Authorization: 'Bearer ' + token
        }
    }).then(
        response => {
            if (response.status == 202 || response.status == 400) {
                return response.json();
            } else {
                throw new Error('Terjadi Kesalahan')
            }
        }
    ).then(
        a => {
            if (a.sukses == true) {
                alertAksiLogin("Berhasil Kirim Berkas", tipe = 'bg-success')
                return true;
            } else {
                if (typeof a.data === "object") {
                    info = infoForm(a.data)
                    alertAksiLogin(info)
                } else if (a.data == "Token has expired") {
                    alertAksiLogin("Token Expired")
                    window.location.href = b_url
                } else {
                    alertAksiLogin(a.data)
                }
                return false;
            }
        }
    ).catch(e => {
        alert(e);
        // console.log(e);
        return false;
    })
    // console.log(response);
    return response

    // document.getElementById("berkasPengajuan").submit()
}
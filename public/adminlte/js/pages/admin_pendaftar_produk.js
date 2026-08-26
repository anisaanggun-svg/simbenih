if (localStorage.getItem("token") == null) {
    window.location.href = b_url + "/login_admin"
    alert("Anda belum login")
}

// var judulMenu = $("#judul-menu")
// var judulLink = $("#judul-link")
// var judulKonten = $("#judul-konten")
var menuUser = $("#daftar-user")
var menuBarang = $("#daftar-barang")
// var isiKonten = $("#isi-konten")

function tableUserDataTable(data) {
    $('#example tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });

    // DataTable
    var table = $('#example').DataTable({
        "language": {
            "emptyTable": "Belum Ada Pendaftar Produk"
        },
        data: data,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
            "data": "id"
        },
        {
            "targets": 1,
            "data": "email"
        },
        {
            "targets": 2,
            "data": "role"
        },
        {
            "targets": 3,
            "data": "is_superuser"
        },
        {
            "targets": 4,
            "data": "is_active"
        },
        {
            "targets": 5,
            "data": "is_staff"
        },
        {
            "targets": 6,
            "data": "hashid",
            "render": function (data, type, row) {
                return '<button class="btn btn-danger" onclick=hapusDataUser("' + data + '")' + ">hapus</button>"
            }
        },
        ],
        initComplete: function () {
            // Apply the search
            this.api().columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change clear', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        }
    });
    table.on('order.dt search.dt', function () {
        table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}
async function hapusDataUser(id) {
    if (confirm("hapus data ?")) {
        return await fetch(url_all_user + "/" + id, {
            method: "delete",
            headers: {
                Authorization: "JWT " + localStorage.getItem("token")
            }
        }).then(
            response => {
                if (response.status == 200) {
                    return response.json()
                } else if (response.status == 401) {
                    throw new Error("Kesalahan Token")
                } else {
                    throw new Error("Terjadi Kesalahan")
                }
            }
        ).then(
            a => {
                if (a.sukses == true) {
                    alert("Data Berhasil Dihapus")
                    isiTabelUser()
                } else {
                    throw new Error(a.pesan)
                }
            }
        ).catch(e => alert(e))
    }

}
async function ambilDataUser() {
    return await fetch(url_all_user, {
        headers: {
            Authorization: "JWT " + localStorage.getItem("token")
        }
    }).then(
        response => {
            if (response.status == 200) {
                return response.json()
            } else if (response.status == 401) {
                throw new Error("Kesalahan Token")
            } else {
                throw new Error("Terjadi Kesalahan")
            }
        }
    ).then(
        a => {
            if (a.sukses == true) {
                return a.user
            }
        }
    ).catch(e => alert(e))
}

async function isiTabelUser() {
    judulMenu.html("Daftar User")
    judulLink.html("/Daftar-User")
    judulKonten.html("Data Table")

    var data = await ambilDataUser()

    // console.log(data)

    await $("#isi-konten").load("page/tabel-user.html", function (e) {
        tableUserDataTable(data != null ? data : [])
    })
    // await tableUserDataTable()
}

menuUser.click(isiTabelUser)

// //////////////////////////////////////////////////


function tableBarangDataTable(data) {
    $('#example tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });

    // DataTable
    var table = $('#example').DataTable({
        data: data,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        columns: [
            { data: 'nama_usaha' },
            { data: 'nama_usaha' },
            { data: 'nama_pimpinan' },
            { data: 'bentuk_usaha' }
        ],
        // "columnDefs": [{
        //         "searchable": false,
        //         "orderable": false,
        //         "targets": 0,
        //         "data": "Nama"
        //     },
        //     {
        //         "targets": 1,
        //         "data": "Nama"
        //     },
        //     {
        //         "targets": 2,
        //         "data": "Jumlah"
        //     },
        //     {
        //         "targets": 3,
        //         "data": "Harga"
        //     },
        //     {
        //         "targets": 4,
        //         "data": "Foto",
        //         "render": function(data, type, row) {
        //             return '<img src="' + url + data + '"></img>'
        //         }
        //     },
        // ],
        initComplete: function () {
            // Apply the search
            this.api().columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change clear', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        }
    });
    table.on('order.dt search.dt', function () {
        table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

async function ambilDataBarang() {
    return await fetch(api_url + "/admin/permohonan_pendaftaran", {
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        }
    }).then(
        response => {
            if (response.status == 200) {
                return response.json()
            } else if (response.status == 401) {
                throw new Error("Kesalahan Token")
            } else {
                throw new Error("Terjadi Kesalahan")
            }
        }
    ).then(
        a => {
            if (a.sukses == true) {
                return a.data
            }
        }
    ).catch(e => alert(e))
}

async function isiTabelBarang() {
    // judulMenu.html("Daftar User")
    // judulLink.html("/Daftar-User")
    // judulKonten.html("Data Table")

    var data = await ambilDataBarang()

    // console.log(data)
    tableBarangDataTable(data != null ? data : [])
    // await $("#isi-konten").load("page/tabel-barang.html", function(e) {
    //         tableBarangDataTable(data != null ? data : [])
    //     })
    // await tableUserDataTable()
}

isiTabelBarang()
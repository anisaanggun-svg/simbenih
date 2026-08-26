@extends("template.t_admin")

@section("title", "Dashboard")
@push('header')
@endpush
@section("content")
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3 id="pendaftar_produk">0</h3>

                <p>Sertifikasi Lapang</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('')}}/admin/sertifikasi_lapang" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3 id="data_permohonan">0</h3>

                <p>Pasca Lapang</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('')}}/admin/pasca_lapang" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3 id="perlu_review">0</h3>

                <p>Konsep Label</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <span class="small-box-footer"> - </span>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 id="daftar_user">0</h3>

                <p>Jumlah Pengguna</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <div id="userLink" class="small-box-footer">
                <a>-</a>
            </div>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i> Grafik Data tahun : <strong id="tahun"></strong>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                        <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->

</div>
<!-- /.row (main row) -->
@endsection

@push('footer')

<!-- AdminLTE for demo purposes 
<script src="{{  url('') }}/assets/js/demo.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{  url('') }}/assets/js/pages/dashboard.js"></script> -->
<script>
    $(async function() {
        var tahunSekarang = new Date().getFullYear();
        $("#tahun").html(tahunSekarang);

        // Fetch blangko stats
        var blankoResponse = await fetch("{{url('')}}/admin/dashboard/blangko-stats", {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + localStorage.getItem("token")
            }
        }).then(response => response.json()).catch(e => ({data: {count: 0}}));

        // Fetch permohonan stats
        var permohonanResponse = await fetch("{{url('')}}/admin/dashboard/permohonan-stats", {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + localStorage.getItem("token")
            }
        }).then(response => response.json()).catch(e => ({data: {count: 0}}));

        // Fetch user stats
        var userResponse = await fetch("{{url('')}}/admin/dashboard/user-stats", {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + localStorage.getItem("token")
            }
        }).then(response => response.json()).catch(e => ({data: {count: 0}}));

        // Fetch chart data
        var chartResponse = await fetch("{{url('')}}/admin/dashboard/chart-data?tahun=" + tahunSekarang, {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + localStorage.getItem("token")
            }
        }).then(response => response.json()).catch(e => ({data: {blangko: [], permohonan: [], user: []}}));

        var blankoCt = blankoResponse.data?.count || 0;
        var permohonanCt = permohonanResponse.data?.count || 0;
        var userCt = userResponse.data?.count || 0;

        $("#pendaftar_produk").html(blankoCt);
        $("#data_permohonan").html(permohonanCt);
        $("#daftar_user").html(userCt);
        $("#perlu_review").html(blankoCt + permohonanCt);

        // Make the dashboard widgets sortable Using jquery UI
        $('.connectedSortable').sortable({
            placeholder: 'sort-highlight',
            connectWith: '.connectedSortable',
            handle: '.card-header, .nav-tabs',
            forcePlaceholderSize: true,
            zIndex: 999999
        })
        $('.connectedSortable .card-header').css('cursor', 'move')

        // jQuery UI sortable for the todo list
        $('.todo-list').sortable({
            placeholder: 'sort-highlight',
            handle: '.handle',
            forcePlaceholderSize: true,
            zIndex: 999999
        })

        /* Chart.js Charts */
        // Sales chart
        var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')

        const arr_pendaftar_produk = chartResponse.data?.blangko || new Array(12).fill(0);
        const arr_data_permohonan = chartResponse.data?.permohonan || new Array(12).fill(0);
        const arr_daftar_user = chartResponse.data?.user || new Array(12).fill(0);

        var salesChartData = {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                    label: 'Pendaftar Produk',
                    backgroundColor: '#17a2b850',
                    borderColor: '#17a2b880',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: arr_pendaftar_produk
                },
                {
                    label: 'Data Pemohon',
                    backgroundColor: '#28a74550',
                    borderColor: '#28a74580',
                    pointRadius: false,
                    pointColor: '#28a745',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: arr_data_permohonan
                },
                {
                    label: 'Pengguna Terdaftar',
                    backgroundColor: '#ffc10f50',
                    borderColor: '#ffc10f80',
                    pointRadius: false,
                    pointColor: '#ffc10f',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: arr_daftar_user
                }
            ]
        }

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        })

    })
</script>
@endpush
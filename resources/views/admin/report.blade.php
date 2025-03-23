@extends('admin.layouts.app')
@section('content')
    <div class="text-center">
        <h2>Laporan Penjualan</h2>
    </div>
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-4">
        <div class="d-flex flex-wrap gap-3 align-items-center">
            <div class="d-flex gap-2 align-items-center">
                <div class="position-relative">
                    <select class="form-select" id="select_type_grafik" style="width: 200px; height: 36px;">
                        <option value="">Pilih Type Grafik</option>
                        <option value="line">Line</option>
                        <option value="bar">Bar</option>
                        <option value="area">Area</option>
                    </select>
                    <i class="ri-arrow-down-s-line position-absolute top-50 end-0 translate-middle-y pe-3"></i>
                </div>
            </div>
            <div class="position-relative">
                <input type="text" name="dates" class="form-control" id="range_datepicker"
                    style="width: 230px; height: 36px; padding-left: 35px;" placeholder="29/10/2024 - 28/11/2024" />
                <i class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y ps-3"></i>
            </div>
        </div>
    </div>

    <div class="main-content-container overflow-hidden">
        <div class="card bg-white border-0 rounded-3 p-4 pb-0 mb-4">
            <div class="col-md-12 col-sm-12 col-xl-12 mb-3">
                <div class="default-table-area style-two default-table-width">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Sales</th>
                                    <th scope="col">Total Pembelian</th>
                                    <th scope="col">Total Pembayaran</th>
                                    <th scope="col">Sisa Pembayaran</th>
                                    <th scope="col">Jatuh Tempo</th>

                                </tr>
                            </thead>
                            <tbody id="customers">
                                <tr>

                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="card bg-white border-0 rounded-3 p-4 pb-0 mb-4">

            <div class="row">
                <div class="col-sm-4 col-xxl-4">
                    <div class="card mb-3">
                        <div class="card-header">Grafik Hari Ini</div>
                        <div class="card-body mb-3" id="chartDay"></div>
                        <div class="p-4 flex justify-content-between" id="day_report">

                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xxl-4">
                    <div class="card mb-3">
                        <div class="card-header">Grafik Minguan</div>
                        <div class="card-body mb-3" id="chartWeek"></div>
                        <div class="p-4 flex justify-content-between" id="week_report">

                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xxl-4">
                    <div class="card mb-3">
                        <div class="card-header">Grafik Bulanan</div>
                        <div class="card-body mb-3" id="chartMonth">

                        </div>
                        <div class="p-4 flex justify-content-between" id="month_report">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-white border-0 rounded-3 p-4 pb-0 mb-4">
            <div class="row">
                <div class="col-sm-4 col-xxl-4">
                    <div class="card mb-3">
                        <div class="card-header">Grafik Sales Hari Ini</div>
                        <div class="card-body mb-3" id="chartSalesDay"></div>
                        <div class="p-4 flex justify-content-between" id="day_Salesreport">

                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xxl-4">
                    <div class="card mb-3">
                        <div class="card-header">Grafik Sales Minguan</div>
                        <div class="card-body mb-3" id="chartSalesWeek"></div>
                        <div class="p-4 flex justify-content-between" id="week_Salesreport">

                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xxl-4">
                    <div class="card mb-3">
                        <div class="card-header">Grafik Sales Bulanan</div>
                        <div class="card-body mb-3" id="chartSalesMonth">

                        </div>
                        <div class="p-4 flex justify-content-between" id="month_Salesreport">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $('input[name="dates"]').daterangepicker();
        getData();

        function getData(type = 'bar', date = '') {
            $.get(`{{ route('admin.report.data') }}?type=${type}&date=${date}`, function(data) {
                if (!data || !data.week || !data.month || !data.today) {
                    console.error("Data tidak valid:", data);
                    return;
                }

                let statusColors = data.week.statusColors;
                let statusLabels = data.week.statusLabels;

                // Hapus isi laporan sebelum diisi ulang
                $('#day_report, #month_report, #week_report').html('');
                $('#day_Salesreport, #month_Salesreport, #week_Salesreport').html('');


                ['chartWeek', 'chartMonth', 'chartDay'].forEach(chart => {
                    if (window[chart] && typeof window[chart].destroy === 'function') {
                        window[chart].destroy();
                    }
                });

                ['chartSalesWeek', 'chartSalesMonth', 'chartSalesDay'].forEach(chart => {
                    if (window[chart] && typeof window[chart].destroy === 'function') {
                        window[chart].destroy();
                    }
                });

                // Fungsi untuk render chart dan laporan
                function renderReport(chartKey, selector, chartData, reportData) {
                    if (chartData) {
                        if (window[chartKey] && typeof window[chartKey].destroy === 'function') {
                            window[chartKey].destroy();
                        }

                        window[chartKey] = new ApexCharts(document.querySelector(selector), chartData);
                        window[chartKey].render();
                    }

                    $.each(reportData, function(key, value) {
                        $(selector.replace("chart", "report")).append(`
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="badge bg-${statusColors[key]} me-2">${statusLabels[key]}</div>
                                </div>
                                <div>${formatRupiah(value)}</div>
                            </div>
                        `);
                    });
                }

                renderReport("chartWeek", "#chartWeek", data.week.chart, data.week.total);
                renderReport("chartMonth", "#chartMonth", data.month.chart, data.month.total);
                renderReport("chartDay", "#chartDay", data.today.chart, data.today.total);
                renderReport("chartSalesWeek", "#chartSalesWeek", data.sales.week.chart, data.sales.week
                    .total_sales);
                renderReport("chartSalesMonth", "#chartSalesMonth", data.sales.month.chart, data.sales.month
                    .total_sales);
                renderReport("chartSalesDay", "#chartSalesDay", data.sales.today.chart, data.sales.today
                    .total_sales);

                $.each(data.customers.data, function(key, value) {
                    let dueDateText = "";

                    if (value.payment_due_date && value.min_payment_due_date) {
                        let date = new Date(value.payment_due_date);
                        date.setMonth(date.getMonth() + 1);

                        let formattedDate = formatTanggal(date); // Ubah format tanggal

                        // Jika payment_due_date == min_payment_due_date, tampilkan satu tanggal saja
                        dueDateText = (value.payment_due_date === value.min_payment_due_date) ?
                            formatTanggal(new Date(value.payment_due_date)) :
                            `${formatTanggal(new Date(value.min_payment_due_date))} - ${formattedDate}`;
                    }

                    $('#customers').append(`
                        <tr>
                            <td>${formatTanggalTunggal(value.order.created_at)}</td>
                            <td>${value.name}</td>
                            <td>${value.sales.name}</td>
                            <td>${formatRupiah(Number(value.total_order_value))}</td>
                            <td>${formatRupiah(Number(value.total_order_value) - Number(value.total_remaining))}</td>
                            <td>${formatRupiah(Number(value.total_remaining))}</td>
                            ${dueDateText ? `<td>${dueDateText}</td>` : ""}
                        </tr>
                    `);
                });

                function formatTanggal(date) {
                    const bulan = [
                        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                    ];
                    return `${date.getDate()} ${bulan[date.getMonth()]} ${date.getFullYear()}`;
                }

                function formatTanggalTunggal(dateString) {
                    if (!dateString) return "-"; // Menangani nilai null/undefined
                    const date = new Date(dateString);
                    if (isNaN(date)) return "-"; // Menangani format yang tidak valid

                    const bulan = [
                        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                    ];

                    // Format jam dan menit dengan leading zero jika perlu
                    const jam = date.getHours().toString().padStart(2, "0");
                    const menit = date.getMinutes().toString().padStart(2, "0");

                    return `${date.getDate()} ${bulan[date.getMonth()]} ${date.getFullYear()} ${jam}:${menit}`;
                }


            });
        }

        // Event listener untuk perubahan jenis grafik
        $('#select_type_grafik').change(function() {
            getData($(this).val(), $('#range_datepicker').val());
        });


        $('#range_datepicker').change(function(e) {
            e.defaultPrevented;
            let date = $(this).val();
            let type = $('#select_type_grafik').val();
            getData(type, date)
        })
    </script>
@endpush

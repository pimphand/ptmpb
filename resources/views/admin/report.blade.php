@extends('admin.layouts.app')
@section('content')
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-4">
        <h3 class="fs-24 fw-normal mb-0">Report</h3>
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
                       style="width: 230px; height: 36px; padding-left: 35px;"
                       placeholder="29/10/2024 - 28/11/2024"/>
                <i class="ri-calendar-line position-absolute top-50 start-0 translate-middle-y ps-3"></i>
            </div>
        </div>
    </div>
    <div class="main-content-container overflow-hidden">
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

        function getData(type = 'bar') {
            $.get(`{{ route('admin.report.data') }}?type=${type}`, function (data) {
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

                    $.each(reportData, function (key, value) {
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

                // Render laporan dan chart untuk minggu, bulan, dan hari ini
                renderReport("chartWeek", "#chartWeek", data.week.chart, data.week.total);
                renderReport("chartMonth", "#chartMonth", data.month.chart, data.month.total);
                renderReport("chartDay", "#chartDay", data.today.chart, data.today.total);
                renderReport("chartSalesWeek", "#chartSalesWeek", data.sales.week.chart, data.sales.week.total_sales);
                renderReport("chartSalesMonth", "#chartSalesMonth", data.sales.month.chart, data.sales.month.total_sales);
                renderReport("chartSalesDay", "#chartSalesDay", data.sales.today.chart, data.sales.today.total_sales);
            });
        }

        // Event listener untuk perubahan jenis grafik
        $('#select_type_grafik').change(function () {
            getData($(this).val());
        });


    </script>
@endpush

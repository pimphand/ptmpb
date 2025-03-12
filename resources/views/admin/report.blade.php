@extends('admin.layouts.app')
@section('content')
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-4">
        <h3 class="fs-24 fw-normal mb-0">Report</h3>
        <div class="d-flex flex-wrap gap-3 align-items-center">
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
                <div class="col-sm-6 col-xxl-6">
                    <div class="card mb-3">
                        <div class="card-header">Grafik Minguan</div>
                        <div class="card-body mb-3" id="chartWeek">

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xxl-6">
                    <div class="card mb-3">
                        <div class="card-header">Grafik Bulanan</div>
                        <div class="card-body mb-3" id="chartMonth">

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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $('input[name="dates"]').daterangepicker();
        const options = {
            chart: {
                type: 'bar'
            },
            series: [
                {
                    name: 'Pending',
                    data: [12, 40, 45, 50, 49, 60, 70]
                },
                {
                    name: 'Success',
                    data: [15, 35, 50, 55, 52, 65, 75]
                },
                {
                    name: 'Cancel',
                    data: [5, 20, 25, 30, 28, 35, 40]
                },
                {
                    name: 'Process',
                    data: [8, 25, 30, 35, 33, 40, 45]
                }
            ],
            xaxis: {
                categories: ["5 Mar", "6 Mar", "7 Mar", "8 Mar", "9 Mar", "10 Mar", "11 Mar"]
            }
        };


        const chart = new ApexCharts(document.querySelector("#chartWeek"), options);

        chart.render();

        const month = new ApexCharts(document.querySelector("#chartMonth"), options);

        month.render();
    </script>
@endpush

@extends('layouts.web')

@section('content')
    <style>
        .thin-line {
            border-bottom: 1px solid #f0f0f0;
        }
        .entreaty-detail {
        }
    </style>
    <div class="slash pt-2" style="height: 50px;">
        <div class="row boxed ">
            <h5>{{$entreaty->title}}</h5>
        </div>
    </div>


    <div class="container pt-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="row .entreaty-detail">
                            <div class="col-12">
                                <h5>{{$entreaty->title}}</h5>
                            </div>
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{$entreaty->getImage()}}" />
                            </div>
                            <div class="col-md-8">
                                <p>{{$entreaty->description}}</p>
                            </div>
                            <div class="col-12 mt-3">
                                <h6 class="thin-line">Details</h6>
                                <p>{{ $entreaty->long_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-custom mt-3">
                    <div class="card-header">Contributions</div>
                    <div class="card-body">

                    </div>
                </div>

            </div>
            <div class="d-none d-md-block col-md-4">

                <div class="card card-custom mt-2">
                    <div class="card-header">
                        Contribution Method
                    </div>
                    <div class="card-body">
                        <div id="">
                            <ol>
                                <li>Dial *150*00#</li>
                                <li>Select Pay Bill</li>
                                <li>Select Enter Business Number</li>
                                <li>Enter Business Number: <strong>222444</strong></li>
                                <li>Enter Reference of payment: <strong>{{$entreaty->getReferenceNumber()}}</strong></li>
                                <li>Enter Amount</li>
                                <li>Enter Your Pin</li>
                            </ol>
                        </div>
                        <div class="mt-2 text-center">
                            <button onclick="contribute()" class="btn btn-custom btn-lg btn-bock">Contribute Online</button>
                        </div>
                    </div>
                </div>

                <div class="card card-custom mt-2">
                    <div class="card-body">
                        <div id="pie-chart"></div>
                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection

@section('script')
    <script>
        $(function() {
            initializeChart();
        });

        function initializeChart() {
            Highcharts.chart('pie-chart', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: 'Active Contributions'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: [

                        {
                            name: 'Paid',
                            y: <?php echo $entreaty->getPaidAmount() ?>,
                            sliced: true,
                            selected: true
                        },{
                            name: 'Remaining',
                            y: <?php echo $entreaty->getRemainingAmount() ?>,
                            sliced: true,
                            selected: true
                        },
                    ]
                }]
            });
        }


        function contribute() {
            console.log('Contribute...');
        }
    </script>
@endsection

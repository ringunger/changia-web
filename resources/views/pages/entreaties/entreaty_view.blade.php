@extends('layouts.web')

@section('content')
    <style>

    </style>
    @if(!is_null($entreaty))
        <div class="slash pt-2" style="height: 50px;">
            <div class="row boxed ">
                <h5>{{$entreaty->title ?? ''}}</h5>
            </div>
        </div>


        <div class="container pt-5">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card card-custom">
                        <div class="card-body">
                            <div class="row .entreaty-detail">
                                <div class="col-12">
                                    <h5>{{$entreaty->title ?? ''}}
                                    <span class="float-right badge badge-secondary" id="state-status">{{ $entreaty->status }}</span>
                                    </h5>
                                </div>
                                <div class="col-md-4">
                                    <img class="img-fluid" src="{{$entreaty->getImage()}}" />
                                </div>
                                <div class="col-md-8">
                                    <p>{{$entreaty->description ?? ''}}</p>
                                </div>
                                <div class="col-12 mt-3">
                                    <h6 class="thin-line">Details</h6>
                                    <p>{{ $entreaty->long_description ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-custom mt-3">
                        <div class="card-header">Contributions
                            <span class="float-right" style="max-width: 200px;">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ $entreaty->getPaidPercentage() }}%" aria-valuenow="{{ $entreaty->getPaidPercentage() }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </span>
                        </div>
                        <div class="card-body">

                            <table class="table">
                                <tr>
                                    <td>Target Amount:</td>
                                    <td width="120" id="state-amount" class="text-right">{{ $entreaty->getAmount() > 0 ? number_format($entreaty->getAmount(), 2) : 'No Target'}}</td>
                                </tr>
                                <tr>
                                    <td>Collected Amount:</td>
                                    <td width="120" id="state-paid" class="text-right">{{ number_format($entreaty->getPaidAmount(), 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Remaining Amount:</td>
                                    <td width="120" id="state-remaining" class="text-right">{{ $entreaty->getAmount() > 0 ? number_format($entreaty->getRemainingAmount(), 2) : 'No Applicable' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card card-custom mt-3">
                        <div class="card-header">Contributions <span class="pull-right"><button class="btn btn-sm btn-custom float-right" onclick="$('#pay-list').slideToggle();"><i class="la la-chevron-down"></i> Contributors</button></span> </div>
                        <div id="pay-list"  class="card-body table-responsive-sm" style="max-height: 200px; display: none;">
                            <table class="table table-sm">
                                <tr><th width="30"></th><th>Number</th><th width="100">Amount</th> </tr>
                                @forelse ($entreaty->contributions as $contribution)
                                    <tr><td>{{$loop->index + 1}}</td><td>{{$contribution['subscriber_msisdn']}}</td><td class="text-right">{{ number_format($contribution->amount_collected) }}</td></tr>
                                @empty

                                @endforelse
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-4">

                    <div class="card card-custom mt-2">
                        <div class="card-header">
                            Contribution Method
                        </div>
                        <div class="card-body">

                            @if($entreaty->status !== 'COMPLETED')
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
                            @else
                                <div class="alert alert-success">Completed</div>
                            @endif

                            <div class=" p-3" style="display:none" id="contribute-form">
                                <hr />
                                <form method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" id="input-phone" placeholder="255#########" />
                                    </div>
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" class="form-control" id="input-amount" value="0" name="amount" />
                                    </div>
                                    <div class="">
                                        <button type="button" class="btn btn-custom" onclick="initContribution()">Contribute</button>
                                    </div>
                                </form>
                            </div>
                            <div id="beamDiv" style="display:none">
                                <x-beem-checkout></x-beem-checkout>
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

    @else
        <div class="jumbotron">
            <h5>Record not found</h5>
            <p>
                Sorry! This record doesn't exist anymore. It might have been deleted!
            </p>
        </div>
    @endif

@endsection

@section('script')
    <script>
        var chart_paid = <?php echo $entreaty->getPaidAmount() ?>;
        var chart_remaining  = <?php echo $entreaty->getRemainingAmount() ?>;
        var state = `<?php echo (string) json_encode($entreaty->getStateData(), true); ?>`;
        var e_reference = "<?php echo $entreaty->reference_number ; ?>";
        var e_transaction = "<?php echo \Illuminate\Support\Str::uuid()->toString(); ?>"

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
                            y: chart_paid,
                            sliced: true,
                            selected: true
                        },{
                            name: 'Remaining',
                            y: chart_remaining,
                            sliced: true,
                            selected: true
                        },
                    ]
                }]
            });
        }


        function contribute() {
            console.log('Contribute...');
            $("#contribute-form").slideToggle();
        }


        function initContribution() {
            var phone = $("#input-phone").val();
            var amount = $("#input-amount").val();
            if(phone && amount){
                $("#beem-button").attr('data-price', amount);
                $("#beem-button").attr('data-reference', e_reference);
                $("#beem-button").attr('data-mobile', phone);
                $("#beem-button").attr('data-transaction', e_transaction);

                InitializeBeem();
                $("#beamDiv").show();
                $("contribute-form").slideToggle();
            } else {

            }
        }

        function refreshState() {
            $.ajax({
                url: "/e_state/<?php echo $entreaty->id; ?>",
                type: 'POST',
                data: {_token: "<?php echo csrf_token(); ?>" }
            }).done(function(res) {

                if(JSON.stringify(res) == JSON.stringify(state)){
                    console.log('The same');
                } else {
                    data = res;

                    $("#state-amount").html(money_format(data.amount));
                    $("#state-paid").html(money_format(data.paid));
                    $("#state-remaining").html(money_format(data.remaining));
                    $("#state-status").html(data.status);

                    chart_paid = data.paid;
                    chart_remaining = data.remaining;
                    initializeChart();

                    state = res;
                }
            });
            setTimeout(function() {
                refreshState();
            }, 5000);
        }
        refreshState();

        function money_format(value){
            return parseFloat(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');;
        }
    </script>
@endsection




@extends('layouts.web')

@section('content')
    <div class="slash" style="height: 60px;">
        <div class="row boxed">
            <h3>Terms and Conditions</h3>
        </div>
    </div>


    <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card card-custom">
                        <?php
                            $x = new \App\Classes\BeemBroker();

//                            $Y = $x->sendSms('0769588442', 'Hello bro, You cool? ');

//                            dump($Y);

                            dump($x->checkOut('0769588442', '7000'));

                        ?>

                        <x-beem-checkout></x-beem-checkout>
                    </div>
                </div>
            </div>
    </div>

@endsection

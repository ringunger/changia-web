@extends('layouts.web')

@section('content')
    <style>
        .stat-box {
            border: 1px solid #E84A66;
            color: #E84A66;
            padding: .3rem;
            border-radius: 1rem;
        }
        .dates {
            margin-top: .7rem;
            font-size: 12px;
            font-weight: 400;
            color: #999;
        }
        .form-control.search {
            background: unset;
            border: 1px solid #888;
            border-radius: 1rem;
            color: #E84A66;
        }
    </style>
    <div class="slash" >
        <div class="row boxed">
            <div class="col-12 col-sm-8 col-xl-9">
                <h6 class="text-black-50">ARE YOU STUCK SOMEWHERE?</h6>
                <h3>Solve Big Challenges by Power of the People</h3>
                <h4 class=""><i>Transparent, Trustable, Reliable</i></h4>
                <p></p>
            </div>
            <div class="col-12 col-sm-4 col-xl-3">
                <div class="action">
                    <div class="w-100">
                        <i class="la-4x la la-arrow-circle-right"></i>
                        <span class="float-right">
                            <a href="{{ route('create_entreaty') }}" class="btn btn-outline-light ">New Entreaty</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row my-4 ">
            <div class="col-12 col-sm-8 col-xl-9">
                <h1 class="">Active Entreaties
                    <i class="small"> | Public</i>
                </h1>
            </div>
            <div class="col-12 col-sm-4 col-xl-3">
                <form autocomplete="off">
                    <input name="search" class="form-control search" placeholder="Search..." type="search" />
                </form>
            </div>
        </div>


        <div>


            @foreach($entreaties as $entreaty)
                <div class="row mt-3">
                    <div class="col-md-5 col-lg-4 col-xl-3">
                        <a href="#">
                            <img class="img-fluid rounded mb-3 mb-md-0" src="{{ asset($entreaty->getImage()) }}" alt="">
                        </a>
                    </div>
                    <div class="col-md-7 col-lg-8 col-xl-9" >
                        <h3>
                            <span  style="margin-right: 120px;">{{$entreaty->title}}</span>
                            <span class="float-right dates">
                        {{ \Carbon\Carbon::createFromDate(date('Y-m-d'))->format('Y, d M') }}
                    </span>
                        </h3>
                        <p>{{ $entreaty->description }}</p>
                        <div class="w-100">
                            <a class="btn btn-outline-custom float-right" href="{{ route('entreaty_view', ['uid' => $entreaty->uid]) }}">View Entreaty</a>
                            <div class="pt-2 d-none d-lg-block">
                                <span title="Number of Contributions" data-toggle="tooltip" class="stat-box px-2"><i class="la la-users"></i>&nbsp;| {{ count($entreaty->contributions)}}</span>
                                <span title="Amount Targeted" data-toggle="tooltip" class="stat-box px-2"><i class="la la-money-check"></i>&nbsp;| {{ ($entreaty->getAmount() > 0) ? number_format($entreaty->getAmount()) ." ". $entreaty->currency->symbol : 'N/A' }}</span>
                                <span title="Amount contributed" data-toggle="tooltip" class="stat-box px-2"><i class="la la-check"></i>&nbsp;| {{ number_format($entreaty->getPaidAmount()) }} {{$entreaty->currency->symbol}}</span>
                                <span title="Amount Remaining" data-toggle="tooltip" class="stat-box px-2"><i class="la la-clock-o"></i>&nbsp;| {{ number_format($entreaty->getRemainingAmount()) }} {{$entreaty->currency->symbol}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
{{--                <div class="d-flex justify-content-center">--}}
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            {!! $entreaties->links() !!}
                        </ul>
                    </nav>
{{--                </div>--}}
        </div>

    </div>





@endsection
@section('script')

@endsection

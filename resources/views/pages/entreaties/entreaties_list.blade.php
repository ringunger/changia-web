@extends('layouts.web')

@section('content')
    <div class="slash" style="height: 100px;">
        <div class="row boxed">
            <h3>My Entreaties</h3>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-9">
                <h4 class="thin-line mb-3">My Entreaties</h4>
                <div class="card card-custom">
                    <div class="card-body">
                        @forelse($entreaties as $entreaty)
                            <div class="row mt-1 thin-line">
                                <div class="col-12 col-md-3">
                                    <img class="img-fluid mb-2" src="{{ asset($entreaty->getImage()) }}" />
                                </div>
                                <div class="col-12 col-md-9">
                                    <h4><a href="{{ route('entreaty_view', ['uid' => $entreaty->uid]) }}">{{$entreaty->title}}</a> </h4>
                                    <h6>{{$entreaty->subtitle}}</h6>
                                    <p>
                                        {{$entreaty->description}}
                                    </p>
                                </div>
                            </div>
                            <br />
                        @empty
                            <div class="card card-custom">
                                <div class="card-body align-content-center">
                                    You currently have no Entreaties!
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-3">

            </div>
        </div>
    </div>
@endsection

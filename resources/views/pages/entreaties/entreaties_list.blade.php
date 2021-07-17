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
                <div>
                    <div>
                        <a href="{{ route('create_entreaty') }}" class="btn btn-custom float-right"><i class="la la-plus"></i> New Entreaty</a>
                    </div>
                    <h4 class="thin-line mb-2 pb-4">My Entreaties</h4>
                </div>

                <div class="card card-custom">
                    <div class="card-body">
                        @forelse($entreaties as $entreaty)
                            <div class="row mt-1 thin-line">
                                <div class="col-12 col-md-3">
                                    <img class="img-fluid mb-2" src="{{ asset($entreaty->getImage()) }}" />
                                </div>
                                <div class="col-12 col-md-9">
                                    <h4><a href="{{ route('entreaty_view', ['uid' => $entreaty->uid]) }}">{{$entreaty->title}}</a> </h4>
                                    <h6>{{$entreaty->subtitle}}
                                    <span class="float-right text-black-50"><span class="label label-secondary">{{$entreaty->is_public ? 'Public' : 'Private'}}</span></span>
                                    </h6>
                                    <p>
                                        {{$entreaty->description}}
                                    </p>
                                    <div class="pb-3">
                                        <span class="float-right">
                                            <span id="link-text-{{$entreaty->id}}" style="display:none;"><input type="text" value="{{ route('entreaty_view', ['uid' => $entreaty->uid]) }}" /></span>
                                            <span class="btn btn-sm btn-custom" onclick="toggleLink({{$entreaty->id}})"><i class="la la-share">&nbsp;</i>Share</span>
                                        </span>
                                        <br />
                                    </div>
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
    <script>
        function toggleLink(id) {
            $("#link-text-"+id).toggle();
        }
    </script>
@endsection

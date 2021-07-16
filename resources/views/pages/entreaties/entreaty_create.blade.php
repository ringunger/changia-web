@extends('layouts.web')

@section('content')
    <div class="slash" style="height: 100px;">
        <div class="row boxed">
            <h3>Create New Entreaty</h3>
        </div>
    </div>
    <div class="container">
        <div class="row my-5">

            <div class="d-none d-md-block col-sm-4 col-md-3 col-xl-5">
                <div class="jumbotron h-100 align-content-center text-center">
                    <i>"Should Be impressive"</i>
                </div>
            </div>
            <div class="col-sm-8 col-ld-9 col-xl-7 mb-xl-0">
                <div  class="card">
                    <div  class="card-body p-4 p-sm-5">
                        <div  class="h4 text-center mb-4">
                            Create a new Entreaty<br > <i>Tell the community what you need them to contribute for</i>
                        </div>
                        <div class="mb-4">
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <div class="me-3 fw-600">Total:</div>--}}
{{--                                <div class="fst-italic"><span>$5</span><!----><!---->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <div class="me-3 fw-600">Subscription:</div>--}}
{{--                                <div class="fst-italic">--}}
{{--                                    <span>Monthly<fa-icon placement="left" ngbtooltip="Your card will be billed the subscription amount each month." class="ng-fa-icon ms-1 text-gray-500">--}}
{{--                                            <svg role="img" aria-hidden="true" focusable="false" data-prefix="fad" data-icon="info-circle" class="svg-inline--fa fa-info-circle fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M256 8C119 8 8 119.08 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 110a42 42 0 1 1-42 42 42 42 0 0 1 42-42zm56 254a12 12 0 0 1-12 12h-88a12 12 0 0 1-12-12v-24a12 12 0 0 1 12-12h12v-64h-12a12 12 0 0 1-12-12v-24a12 12 0 0 1 12-12h64a12 12 0 0 1 12 12v100h12a12 12 0 0 1 12 12z"></path><path class="fa-primary" fill="currentColor" d="M256 202a42 42 0 1 0-42-42 42 42 0 0 0 42 42zm44 134h-12V236a12 12 0 0 0-12-12h-64a12 12 0 0 0-12 12v24a12 12 0 0 0 12 12h12v64h-12a12 12 0 0 0-12 12v24a12 12 0 0 0 12 12h88a12 12 0 0 0 12-12v-24a12 12 0 0 0-12-12z"></path></g></svg>--}}
{{--                                        </fa-icon>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <form  id="entreaty_form" method="post" enctype="multipart/form-data" autocomplete="off" class="row">
                            @csrf
                            <div class="mb-3 col-12">
                                <label for="title" class="small mb-1">Title of the Entreaty</label>
                                <input id="title" name="title" type="text" placeholder="Title of the entreaty" required=""  class="form-control">
                                <div class="invalid-feedback">Name required</div>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="subtitle" class="small mb-1">Subtitle</label>
                                <input id="subtitle" name="subtitle" type="text" placeholder="Subtitle" required=""  class="form-control">
                                <div class="invalid-feedback">Name required</div>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="description" class="small mb-1">Description</label>
                                <textarea id="description" name="description" placeholder="Description of purpose the Entreaty" required=""  class="form-control"></textarea>
                                <div class="invalid-feedback">Name required</div>
                            </div>

                            <div class="mb-3 col-12">
                                <label for="long_description" class="small mb-1">Detailed Description</label>
                                <textarea rows="4" id="long_description" name="long_description" type="text" placeholder="A long description about the entreaty" required=""  class="form-control"></textarea>
                                <div class="invalid-feedback">Name required</div>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="name" class="small mb-1">Target amount <i>(optional)</i></label>
                                <div class="input-group">
                                    <input id="name" type="number" min="0" placeholder="Targeted amount"   class="form-control number-only">
                                    <select class="input-group-append form-control" style="max-width: 80px;">
                                        @foreach($currencies as $currency)
                                        <option value="{{$currency->id}}">{{$currency->symbol}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Name required</div>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="deadline" class="small mb-1">Deadline Date  <i>(optional)</i></label>
                                <input id="deadline" name="deadline" type="text" placeholder="Deadline of the need"   class="form-control datepicker">
                                <div class="invalid-feedback">Name required</div>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="is_public" class="small mb-1">Publicity</label>
                                <select id="is_public" name="is_public" placeholder="Publicity" required=""  class="form-control">
                                    <option value="1">Public (Everyone Sees)</option>
                                    <option value="0">Private (Only people you share link with)</option>
                                </select>
                                <div class="invalid-feedback">Name required</div>
                            </div>



                            <div class="mb-3 col-12">
                                <div id="card-errors" data-cy="cardErrors" class="small text-danger"></div></div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input id="termsCheckbox"  type="checkbox" formcontrolname="termsAndConditions" class="form-check-input ">
                                    <label for="termsCheckbox" class="form-check-label small terms-label">I have read and agree to the website
                                        <a target="_blank" class="text-reset fw-bold" href="{{ route('terms') }}">terms &amp; conditions</a>
                                    </label>
                                    <div class="invalid-feedback">You must accept the terms &amp; conditions.</div>
                                </div>
                            </div>
                            <div class="col-6 offset-6 col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                                <button type="submit" id="btn-submit" disabled name="createEntreaty" class="btn btn-outline-custom btn-block btn-lg fw-500" disabled=""><span>Submit</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('script')
    <script>
        $("#termsCheckbox").on('change', function() {
            var state = $(this).prop('checked');
            if(state) {
                $("#btn-submit").prop('disabled', false);
            } else {
                $("#btn-submit").prop('disabled', true);
            }
        })
    </script>
@endsection

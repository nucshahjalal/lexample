@extends('master')

@section('content')

<div class="example">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#preview-1022"  role="tab">
            <svg class="icon me-2">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
            </svg>Send Email</a>
        </li>  
    </ul>
    <div class="tab-content rounded-bottom">
        <form method="post" action="{{ url('mail') }}">
            @csrf
            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1022">
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Message</label>
                    <div class="col-sm-4">
                        <input class="form-control" name="message" id="message" type="text">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Body</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
              <div class="col-8">
              </div>
              <div class="col-4">
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </div>
        </form>
        
    </div>
</div>

@endsection

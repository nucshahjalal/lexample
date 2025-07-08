@extends('master')

@section('content')

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="car"></div>
            <div class="card mb-4">
            <div class="card-header"><strong>Vr Code Generate</strong></a></div>
            <div class="card-body">
              <div class="example">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"                  href="#preview-557" role="tab">
                      <svg class="icon me-2">
                        <use xlink:href="#"></use> 
                      </svg>Vr Code Generate</a>
                    </li>
                </ul>
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-557">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">School Link</th>
                          <th scope="col">School Image</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td>{!! $school_details !!}</td>
                            <td><img src="{!! $changeColor !!} "></td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

@endsection
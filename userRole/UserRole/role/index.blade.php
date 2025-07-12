@extends('master')

@section('content')

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="car"></div>
            <div class="card mb-4">
            <div class="card-header"><strong>Role Information</strong><a class="nav-link active" 
             href="{{ url('role/create') }}"><span style="text-align: right !important"><button class="btn btn-success">Add Role</button></span></a></div>
            <div class="card-body">
              <div class="example">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"                  href="#preview-557" role="tab">
                      <svg class="icon me-2">
                        <use xlink:href="#"></use> 
                      </svg>Role List</a>
                    </li>
                </ul>
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-557">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Note</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($roles as $obj)
                          <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $obj->name }}</td>
                            <td>{{ $obj->note }}</td>
                            <td>
                              <a href="{{ url('role/edit', $obj->id) }}">Edit</a>
                              <a href="{{ url('role/delete', $obj->id) }}">Delete</a>
                              
                            </td>
                          </tr>
                        @endforeach
                                 
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
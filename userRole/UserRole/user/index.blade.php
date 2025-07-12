@extends('master')

@section('content')

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="car"></div>
            <div class="card mb-4">
            @can('user-create')  
            <div class="card-header"><strong></strong><a class="nav-link active" 
             href="{{ url('user/create') }}"><span style="text-align: right !important"><button class="btn btn-success">Add User</button></span></a>
            @endcan
            </div>
            <div class="card-body">
              <div class="example">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"
                        href="#preview-557" role="tab">
                      <svg class="icon me-2">
                        <use xlink:href="#"></use> 
                      </svg>User List</a>
                    </li>
                </ul>
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-557">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Role</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $obj)
                          <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $obj->name }}</td>
                            <td>{{ $obj->email }}</td>
                            <td>
                                @foreach ($obj->getRoleNames() as $role)
                                <button class="btn btn-info">{{$role}}</button>
                                @endforeach
                            </td>
                            <td>
                              @can('user-edit')                     
                              <a href="{{ url('user/edit', $obj->id) }}">Edit</a>
                              @endcan
                              @can('user-delete') 
                              <a href="{{ url('user/delete', $obj->id) }}">Delete</a>
                              @endcan
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
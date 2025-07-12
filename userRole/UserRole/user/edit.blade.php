@extends('master')

@section('content')

<div class="example">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" 
                                href="#preview-1022"  role="tab">
            <svg class="icon me-2">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
            </svg>Update User</a>
        </li>  
    </ul>
    <div class="tab-content rounded-bottom">
        <form method="post" action="{{ url('user/update') }}">
            @csrf

            <input class="form-control" name="id" id="id" value="{{ $user->id }}" type="text">
            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1022">
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Name</label>
                    <div class="col-sm-4">
                        <input class="form-control" name="name" id="name" value = "{{ $user->name }}" type="text">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Email</label>
                    <div class="col-sm-4">
                        <input class="form-control" name="email" id="email" value = "{{ $user->email }}" type="text">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Password</label>
                    <div class="col-sm-4">
                        <input class="form-control" name="password" id="password" value = "" type="text">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Role</label>
                    <div class="col-sm-4">
                        <select class="form-select" name="roles[]" multiple="">
                            <option selected="">--Select--</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? "selected" : " " }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
              <div class="col-8">
              </div>
              <div class="col-4">
                <button class="btn btn-primary" type="submit">Update</button>
              </div>
            </div>
        </form>
        
    </div>
</div>

@endsection
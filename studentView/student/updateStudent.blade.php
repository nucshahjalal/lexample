@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-gears "></i><small> Manage Update Student</small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content quick-link">
               @include('student.quick-link')              
            </div>
            <div class="x_content">
                <div class="row">
                    <form method="get" action="{{ route('update-student.list') }}" accept-charset="UTF-8" class="form-horizontal">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="item form-group">                             
                                <input class="form-control col-md-7 col-xs-12 " name="filter" id="filter"  value="{{ @$filter }}" placeholder="Search Student..." type="text">
                                @error('filter')
                                    <div class="help-block error">{{ $message }}</div>                                        
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="form-group">
                                <button id="send" type="submit" class="btn btn-success btn-sm">Find</button>
                            </div>
                        </div>
                    </form>           
                </div> 
            </div>
            <div class="x_content">

                <ul class="nav nav-tabs bar_tabs">
                    <li class="nav-item">
                        <a href="{{ route('update-student.list') }}"  class="nav-link <?php if(isset($list)){ echo 'active'; }?>" ><i class="fa fa-list "></i> Update List</a>
                    </li>
                    <li class="li-class-list">
                        <form method="get" action="{{ route('update-student.list') }}" accept-charset="UTF-8" class="form-horizontal">
                            <select class="form-control col-md-7 col-xs-6 " name="class_id" style="width:auto;">
                                <option value="0" > --Select Class-- </option>
                                @foreach($classes as $obj)
                                    <option value="{{ $obj->id }}"> {{ $obj->name }}</option>
                                @endforeach                                             
                            </select>
                            <div class="col-md-2 col-sm-2 col-xs-6">
                                <div class="form-group">
                                    <button id="send" type="submit" class="btn btn-success btn-sm">Find</button>
                                </div>
                            </div>
                        </form>           
                    </li>
                </ul>
             
                <div class="tab-content"> 
                    @isset($list)
                    <div class="tab-pane fade in active show" >
                        <div class="x_content">
                            <div class="card-box table-responsive">
                                
                                <table id="datatable-buttons" class="table table-striped table-bordered table-hover" style="width:100%">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Photo</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Phone</th>
                                            <th>Father's Name</th>
                                            <th>Mather's Name</th>
                                            <th>Photo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse($students as $obj)
                                        @csrf
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td><img src="{{ asset(config('constants.UPLOAD_PATH').'student/'.$obj->photo) }}" alt="" width="50" style="padding: 3px;" /></td>
                                                <td><input type="text"  name = "first_name[]" class="form-control" value="{{ $obj->first_name }}" id="first_name"></td>
                                                <td><input type="text"  name = "middle_name[]" class="form-control" value="{{ $obj->middle_name }}" id="middle_name"></td>
                                                <td><input type="text"  name = "last_name[]" class="form-control" value="{{ $obj->last_name }}" id="last_name"></td>
                                                <td><input type="number"  name = "phone[]" class="form-control" value="{{ $obj->phone }}" id="phone"></td>
                                                <td><input type="text"  name = "father_name[]" class="form-control" value="{{ $obj->father_name }}" id="father_name"></td>
                                                <td><input type="text"  name = "mother_name[]" class="form-control" value="{{ $obj->mother_name }}" id="mother_name"></td>
                                                <td>
                                                    <div class="btn btn-default btn-file">
                                                        <i class="fa fa-paperclip"></i> Upload 
                                                        <input  class="" name="photo[]"  id="photo" type="file" >
                                                        <input name="photo_prev" id="photo_prev" type="hidden" value="">
                                                    </div>
                                                    <input type="hidden" id="student_id" name = "student_id[]" value="{{ $obj->id }}" >
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">There are no data found.</td>
                                            </tr>
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                                    <div class="col-md-3 col-sm-3 col-xs-12" style="float:right;">
                                        <div class="form-group">
                                            <div class="col-md-12 text-right">
                                                <button type="button" id="fn_update_student" class="btn btn-success ">Update Student</button>
                                            </div>
                                        </div> 
                                    </div>
                                
                                {!! $students->withQueryString()->links('pagination::bootstrap-5') !!}
                                
                            </div>
                        </div>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

 
<script type="text/javascript">

        $('#fn_update_student').on('click', function () {
            
        var student_id = '';
        var first_name = '';
        var middle_name = '';
        var last_name = '';
        var phone = '';
        var father_name = '';
        var mother_name = '';
        var photo = '';
        
        $("input[name^='first_name']").each(function() {
            first_name += $(this).val()+',';
        });
        $("input[name^='middle_name']").each(function() {
            middle_name += $(this).val()+',';
        });
        $("input[name^='last_name']").each(function() {
           last_name += $(this).val()+',';
        });
        $("input[name^='phone']").each(function() {
            phone += $(this).val()+',';
        });
        $("input[name^='father_name']").each(function() {
          father_name += $(this).val()+',';
        });
       
        $("input[name^='mother_name']").each(function() {
            mother_name += $(this).val()+',';
        });
        $("input[type^='photo']").each(function() {
          photo =  photo += $(this).val()+',';
        });
        
        $("input[name^='student_id']").each(function() {
            student_id += $(this).val()+',';
        });
        
            $.ajax({
                url: '/student/manage-student/update_student',
                type: 'POST',
                data: {
                    first_name : first_name,
                    middle_name : middle_name,
                    last_name : last_name,
                    phone : phone,
                    father_name : father_name,
                    mother_name : mother_name,
                    photo : photo,
                    student_id : student_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                //console.log(data);
                toastr.success('Update Success'); 
                //location.reload();
                },
                error: function (error) {                     
                  //console.log(error);
                toastr.error('Update failed. Please try again.');
                }
            });
        });    
        
</script>

@endsection

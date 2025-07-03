@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bars "></i><small> Manage Student Activity</small></h3>
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
                    <form method="get" action="{{ route('activity.list') }}" accept-charset="UTF-8" class="form-horizontal">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="item form-group">                             
                                <input class="form-control col-md-7 col-xs-12 " name="filter" id="filter"  value="{{ @$filter }}" placeholder="Search Student Activity..." type="text">
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
                        <a href="{{ route('activity.list') }}"  class="nav-link <?php if(isset($list)){ echo 'active'; }?>" ><i class="fa fa-list "></i> List</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('activity.add') }}" class="nav-link <?php if(isset($add)){ echo 'active'; }?>" ><i class="fa fa-plus "></i> Add</a>
                    </li> 
                    @isset($edit)
                        <li class="nav-item">
                            <a class="nav-link active" ><i class="fa fa-edit "></i> Edit</a>
                        </li>
                    @endisset
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
                                            <th>Student</th>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th>Date</th>
                                            <th>Activity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse($activities as $obj)
                                        
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $obj->first_name . ' ' . $obj->middle_name .' ' . $obj->last_name }}</td>
                                                <td>{{ $obj->class_name }}</td>
                                                <td>{{ $obj->section_name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($obj->activity_date)) }}</td>
                                                <td>{{ $obj->activity }}</td>
                                                <td>
                                                    <a onclick="getActivityModal( {{$obj->id}} );"  data-toggle="modal" data-target=".bs-activity-modal"  class="btn btn-info btn-xs"><i class="fa fa-eye-slash"></i> View </a>
                                                    <a href="{{ route('activity.edit', $obj->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> Edit </a>
                                                    <form action="{{ route('activity.delete', $obj->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')                                                        
                                                        <button type="submit" class="btn btn-danger btn-xs" onclick="javascript: return confirm('confirm_alert')" ><i class="fa fa-trash-o"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        
                                        @empty
                                            <tr>
                                                <td colspan="6">There are no data found.</td>
                                            </tr>
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                                
                                {!! $activities->withQueryString()->links('pagination::bootstrap-5') !!}
                                
                            </div>
                        </div>
                    </div>
                    @endisset
                    
                    @isset($add)
                    <div class="tab-pane fade active show">

                        <div class="x_content small-form">
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""><span></span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @include('partials.error') 
                                </div>
                            </div>
                            
                            <form method="post" action="{{ route('activity.save') }}" accept-charset="UTF-8" id="form-add" enctype="multipart/form-data">
                             @csrf
                             
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id">Class <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="class_id" required="required" onchange="getClassBySection();">
                                        <option value="">--Select--</option> 
                                        @foreach($classes as $obj) 
                                            <option value="{{ $obj->id }} "> {{ $obj->name }} </option>
                                        @endforeach                                            
                                    </select>
                                    @error('class_id')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id">Section <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="section_id" required="required" onchange="getClassSectionByStudent();">
                                        <option value="">--Select--</option> 
                                    </select>
                                    @error('section_id')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id">Student <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="student_id" required="required" >
                                        <option value="">--Select--</option>
                                    </select>
                                    @error('student_id')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div> 
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activity_date">Date </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12 " name="activity_date" id="add_activity_date"  value="{{ old('activity_date') }}" placeholder="Date" type="text">
                                    @error('activity_date')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activity">Activity </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" name="activity" id="activity" placeholder="Activity">{{ old('activity') }}</textarea>
                                    @error('activity')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 offset-md-3">
                                    <a href="{{ route('activity.list') }}" class="btn btn-primary btn-sm">Cancel</a>
                                    <button id="submit" type="submit" class="btn btn-success btn-sm">Save</button>
                                </div>
                            </div>
                            
                            </form>
                        </div>
                    </div>
                     @endisset
                     
                    @isset($edit)
                    <div class="tab-pane fade active show" >

                        <div class="x_content small-form">
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""><span></span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @include('partials.error') 
                                </div>
                            </div>
                            
                            <form method="post" action="{{ route('activity.update') }}" accept-charset="UTF-8" id="form-edit" enctype="multipart/form-data">
                             @csrf 
                                
                            <input type="hidden" value="{{ $activity->id }}" name="id" />
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class_id">Class <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  class="form-control col-md-7 col-xs-12"  name="class_id"  id="class_id" required="required" onchange="getClassBySection();">
                                        <option value="">--Select--</option> 
                                        @foreach($classes as $obj) 
                                            <option value="{{ $obj->id }} " {{ $activity->class_id == $obj->id  ? 'selected' : '' }} > {{ $obj->name }} </option>
                                        @endforeach                                            
                                    </select>
                                    @error('class_id')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="section_id">Section <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  class="form-control col-md-7 col-xs-12"  name="section_id"  id="section_id" required="required" onchange="getClassSectionByStudent();">
                                        <option value="" >--Select--</option> 
                                        @foreach($sections as $obj) 
                                            <option value="{{ $obj->id }}" {{ $activity->section_id == $obj->id  ? 'selected' : '' }} > {{ $obj->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('section_id')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id">Student <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select  class="form-control col-md-7 col-xs-12"  name="student_id"  id="student_id" required="required" >
                                        <option value="">--Select--</option> 
                                        @foreach($students as $obj) 
                                            <option value="{{ $obj->id }}" {{ $activity->student_id == $obj->id  ? 'selected' : '' }} > {{ $obj->first_name .' '. $obj->middle_name .' '. $obj->last_name }} </option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div> 
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activity_date">Date </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12 " name="activity_date" id="edit_activity_date"  value="{{ date('d-m-Y', strtotime($activity->activity_date)) }}" placeholder="Date" type="text">
                                    @error('activity_date')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="activity">Activity </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" name="activity" id="activity" placeholder="Activity">{{ $activity->activity }}</textarea>
                                    @error('activity')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="status">Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:6px;">
                                     Active: 
                                    <input type="radio" class="flat" name="status" id="Active" value="1" @if($activity->status == 1) checked="checked" @endif /> 
                                     In Active: 
                                    <input type="radio" class="flat" name="status" id="InActive" value="0" @if($activity->status == 0) checked="checked" @endif />
                                </div>
                            </div>    

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 offset-md-3">
                                    <a href="{{ route('activity.list') }}" class="btn btn-primary btn-sm">Cancel</a>
                                    <button id="update" type="submit" class="btn btn-success btn-sm">Update</button>
                                </div>
                            </div>
                            
                            </form>
                        </div>
                    </div>
                    @endisset

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bs-activity-modal" id="fn-activity-data" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student Activity Detail</h5>
                <button type="button" class="fn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fn-activity-data">               
            </div>
            <div class="modal-footer">
                <button type="button" class="fn-close btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- datepicker  -->
<link rel="stylesheet" href="{{ asset('/assets/vendor/datepicker/datepicker.css') }}">
<script src="{{ asset('/assets/vendor/datepicker/datepicker.js') }}"></script>

<script type="text/javascript">
    
    $('#add_activity_date').datepicker({endDate: "today" });
    $('#edit_activity_date').datepicker({endDate: "today" });
    
    function getActivityModal(activity_id){
         
        $('.fn-activity-data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="/assets/images/loading.gif" /></p>');
        $.ajax({ 
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type   : "GET",
          url    : "/student/activity/view/"+activity_id,
          data   : {activity_id : activity_id},  
          success: function(response){                                                   
            if(response)
             {
                $('.fn-activity-data').html(response);
             }
          }
       });
    } 
    
</script>

<script type="text/javascript">
    
    function getClassBySection(){

        var class_id = $('#class_id').val();

        $.ajax({ 
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type   : "GET",
            url    : "/student/activity/class_by_section",
            data   : {class_id : class_id},  
            success: function(response){
                $('#section_id').html(response);
            }
       });
    }
    
    function getClassSectionByStudent(){
       
        var section_id = $('#section_id').val();

        $.ajax({ 
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type   : "GET",
            url    : "/student/activity/class_section_by_student",
            data   : {section_id : section_id},  
            success: function(response){
                $('#student_id').html(response);
            }
       });
    }
    
</script>

 <script type="text/javascript">   
    $().ready(function() {
//        $("#form-add").validate();     
//        $("#form-edit").validate();   
    });
</script>

@endsection
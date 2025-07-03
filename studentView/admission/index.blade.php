@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-gears "></i><small> Manage Online Admission</small></h3>
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
                    <form method="get" action="{{ route('admission.list') }}" accept-charset="UTF-8" class="form-horizontal">
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
                        <a href="{{ route('admission.list') }}"  class="nav-link <?php if(isset($list)){ echo 'active'; }?>" ><i class="fa fa-list "></i> List</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admission.add') }}" class="nav-link <?php if(isset($add)){ echo 'active'; }?>" ><i class="fa fa-plus "></i> Add</a>
                    </li> 
                    <?php if(isset($approve)){ ?>
                        <li class="nav-item">
                            <a class="nav-link active" ><i class="fa fa-edit "></i> Approve</a>
                        </li>
                    <?php } ?>
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
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Type</th>
                                            <th>Group</th>
                                            <th>Class</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse($admissions as $obj)
                                        
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>
                                                    @if($obj->photo)
                                                        <img src="{{ asset(config('constants.UPLOAD_PATH').'admission/'.$obj->photo) }}" width="50px" height="50px">
                                                    @else
                                                        <img src="{{ asset(config('constants.UPLOAD_PATH').'default-user.png') }}" width="50px" height="50px">
                                                    @endif
                                                </td>
                                                <td>{{ $obj->first_name .' '.$obj->middle_name . ' '. $obj->last_name }}</td>
                                                <td>{{ $obj->phone }}</td>
                                                <td>{{ $obj->type }}</td>
                                                <td>{{ $obj->group }}</td>
                                                <td>{{ $obj->class_name }}</td>
                                                <td> @if($obj->status == 1)
                                                        <a href="javascript:void(0);" class="btn btn-default btn-xs"> New </a>
                                                    @elseif($obj->status == 2)
                                                        <a href="javascript:void(0);" class="btn btn-info btn-xs">Waiting </a>
                                                    @elseif($obj->status == 3)
                                                        <a href="javascript:void(0);" class="btn btn-danger btn-xs">Declined </a> 
                                                    @elseif($obj->status == 4)
                                                        <a href="javascript:void(0);" class="btn btn-success btn-xs">Approved </a>  
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($obj->status == 1)
                                                        <a href="{{ route('admission.approve', $obj->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> Approve </a>
                                                        <a onclick="waiting_status( {{$obj->id}} )" onclick="javascript: return confirm('Confirm proceed');" class="btn btn-info btn-xs"><i class="fa fa-spinner"></i> Waiting </a>
                                                        <a onclick="decline_status( {{$obj->id}} )" onclick="javascript: return confirm(('Confirm proceed');" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Decline </a>
                                                    @elseif($obj->status == 2)
                                                        <a href="{{ route('admission.approve', $obj->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> Approve </a>
                                                        <a onclick="decline_status( {{$obj->id}} )" onclick="javascript: return confirm(('Confirm proceed');" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Decline </a>
                                                    @elseif($obj->status == 3)
                                                        <a href="{{ route('admission.approve', $obj->id) }}" onclick="javascript: return confirm('Confirm proceed');" class="btn btn-success btn-xs"><i class="fa fa-check-square-o"></i> Approve </a>
                                                    @endif
                                                    
                                                    <a onclick="get_admission_modal( {{$obj->id}} );"  data-toggle="modal" data-target=".bs-admission-modal"  class="btn btn-info btn-xs"><i class="fa fa-eye-slash"></i> View </a>
                                                    <form action="{{ route('admission.delete', $obj->id) }}" method="POST">
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
                                
                                {!! $admissions->withQueryString()->links('pagination::bootstrap-5') !!}
                                
                            </div>
                        </div>
                    </div>
                    @endisset
                    
                    @isset($add)
                    <div class="tab-pane fade active show">    
                        <div class="x_content big-form">
                            
                            <form method="post" action="{{ route('admission.save') }}" accept-charset="UTF-8" id="form-add" enctype="multipart/form-data">
                               @csrf
                            
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h6 class="column-title"><strong>Basic Information:</strong></h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="first_name">First Name <span class="required">*</span></label>
                                        <input class="form-control col-md-7 col-xs-12" name="first_name"   id="first_name" value="{{ old('first_name') }}" placeholder="First Name" required="name"  type="text" autocomplete="off">
                                        @error('first_name')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="middle_name">Middle Name </label>
                                        <input class="form-control col-md-7 col-xs-12" name="middle_name" id="middle_name" value="{{ old('middle_name') }}" placeholder="Middle Name" type="text" autocomplete="off">
                                        @error('middle_name')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="last_name">Last Name </label>
                                        <input class="form-control col-md-7 col-xs-12" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Last Name" type="text"  plete="off">
                                        @error('last_name')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="national_id">National Id</label>
                                        <input class="form-control col-md-7 col-xs-12" name="national_id" id="national_id" value="{{ old('national_id') }}" placeholder="National Id" type="number" autocomplete="off">
                                        @error('national_id')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="dob">Birth Date </label>
                                        <input class="form-control col-md-7 col-xs-12" name="dob" id="add_dob" value="{{ old('dob') }}" placeholder="Birth Date" type="text"  plete="off">
                                        @error('dob')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="gender">Gender </label>
                                        <select class="form-control col-md-7 col-xs-12 " name="gender" id="gender">
                                            @php $genders = get_genders(); @endphp
                                            <option value=""> --Select-- </option>
                                            @foreach($genders as $key => $value)
                                                <option value="{{ $key }}"> {{ $value }}</option>
                                            @endforeach                                             
                                        </select>
                                        @error('gender')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="blood_group">Blood Group </label>
                                        <select class="form-control col-md-7 col-xs-12 " name="blood_group" id="blood_group">
                                            @php $bloolds = get_blood_group(); @endphp
                                            <option value=""> --Select-- </option>
                                            @foreach($bloolds as $key => $value)
                                                <option value="{{ $key }}"> {{ $value }}</option>
                                            @endforeach                                            
                                        </select>
                                        @error('blood_group')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="religion">Religion</label>
                                        <input class="form-control col-md-7 col-xs-12" name="religion" id="religion" value="{{ old('religion') }}" placeholder="Religion" type="text" autocomplete="off">
                                        @error('religion')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>
                             
                            <div class="row">
                                
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="caste">Caste</label>
                                        <input class="form-control col-md-7 col-xs-12" name="caste" id="caste" value="{{ old('caste') }}" placeholder="Caste" type="text" autocomplete="off">
                                        @error('caste')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div> 
                               
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h6 class="column-title"><strong>Academic Information:</strong></h6>
                                </div>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="type_id">Student Type <span class="required">*</span></label>
                                        <select class="form-control col-md-7 col-xs-12 " name="type_id" id="type_id"  required="required">
                                            <option value="">--select--</option>
                                            @foreach($types as $obj)
                                                <option value="{{ $obj->id }}"> {{ $obj->type }}</option>
                                            @endforeach                                              
                                        </select>
                                        @error('type_id')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="class_id">Class <span class="required">*</span></label>
                                        <select class="form-control col-md-7 col-xs-12 " name="class_id" id="class_id"  required="required" onchange="getClassBySection();">
                                            <option value="">--select--</option>
                                            @foreach($classes as $obj)
                                                <option value="{{ $obj->id }}"> {{ $obj->name }}</option>
                                            @endforeach                                              
                                        </select>
                                        @error('class_id')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="group_id">Group <span class="required">*</span></label>
                                            <select class="form-control col-md-7 col-xs-12 " name="group_id" id="group_id"  required="required">
                                                <option value="">--select--</option>
                                                @foreach($groups as $obj)
                                                    <option value="{{ $obj->id }}"> {{ $obj->title }}</option>
                                                @endforeach                                              
                                            </select>
                                        @error('group_id')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="second_language">Second Language</label>
                                        <input class="form-control col-md-7 col-xs-12" name="second_language" id="second_language" value="{{ old('second_language') }}" placeholder="Second Language" type="text" autocomplete="off">
                                        @error('second_language')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h6 class="column-title"><strong>Father Information:</strong></h6>
                                </div>
                            </div>
                             
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="father_name">Father Name</label>
                                        <input class="form-control col-md-7 col-xs-12" name="father_name" id="father_name" value="{{ old('father_name') }}" placeholder="Father Name" type="text" autocomplete="off">
                                        @error('father_name')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="father_phone">Father Phone</label>
                                        <input class="form-control col-md-7 col-xs-12" name="father_phone" id="father_phone" value="{{ old('father_phone') }}" placeholder="Father Phone" type="number" autocomplete="off">
                                        @error('father_phone')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="father_education">Father Education</label>
                                        <input class="form-control col-md-7 col-xs-12" name="father_education" id="father_education" value="{{ old('father_education') }}" placeholder="Father Education" type="text" autocomplete="off">
                                        @error('father_education')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="father_profession">Father Profession</label>
                                        <input class="form-control col-md-7 col-xs-12" name="father_profession" id="father_profession" value="{{ old('father_profession') }}" placeholder="Father Profession" type="text" autocomplete="off">
                                        @error('father_profession')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>
                               
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h6 class="column-title"><strong>Mother Information:</strong></h6>
                                </div>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="mother_name">Mother Name</label>
                                        <input class="form-control col-md-7 col-xs-12" name="mother_name" id="mother_name" value="{{ old('mother_name') }}" placeholder="Mother Name" type="text" autocomplete="off">
                                        @error('mother_name')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="mother_phone">Mother Phone</label>
                                        <input class="form-control col-md-7 col-xs-12" name="mother_phone" id="mother_phone" value="{{ old('mother_phone') }}" placeholder="Mother Phone" type="number" autocomplete="off">
                                        @error('mother_phone')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="mother_education">Mother Education</label>
                                        <input class="form-control col-md-7 col-xs-12" name="mother_education" id="mother_education" value="{{ old('mother_education') }}" placeholder="Mother Education" type="text" autocomplete="off">
                                        @error('mother_education')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="mother_profession">Mother Profession</label>
                                        <input class="form-control col-md-7 col-xs-12" name="mother_profession" id="mother_profession" value="{{ old('mother_profession') }}" placeholder="Mother Profession" type="text" autocomplete="off">
                                        @error('mother_profession')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                               
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h6 class="column-title"><strong>Guardian  Information:</strong></h6>
                                </div>
                            </div> 
                               
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="is_guardian">Is Guardian <span class="required">*</span></label>
                                        <select  class="form-control col-md-7 col-xs-12" name="is_guardian" id="is_guardian" required="required" onchange="check_guardian_type(this.value);">
                                            <option value="">--Select--</option>
                                            <option value="father" @if('is_guardian' && 'is_guardian' == 'father') selected="selected" @endif>Father</option>
                                            <option value="mother" @if('is_guardian' && 'is_guardian' == 'mother') selected="selected" @endif>Mother</option>
                                            <option value="other" @if('is_guardian' && 'is_guardian' == 'other') selected="selected" @endif>Other</option>
                                            <option value="exist_guardian" @if('is_guardian' && 'is_guardian' == 'exist_guardian') selected="selected" @endif>Guardian Exist</option>
                                        </select>
                                        @error('is_guardian')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="fn_existing_guardian <?php if(isset($post['is_guardian']) && $post['is_guardian'] == 'exist_guardian'){'';}else{ echo 'display'; } ?>">
                                    <div class="col-md-3 col-sm-3 col-xs-12"> 
                                        <div class="item form-group">
                                            <label for="guardian_id">Guardian <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12" name="guardian_id" id="guardian_id" onchange="get_guardian_by_id(this.value);">
                                                <option value="">--Select--</option>
                                                @foreach($guardians as $obj)
                                                    <option value="{{ $obj->id }}" >{{ $obj->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('guardian_id')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>                                  
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="relation_with">Relation With Guardian </label>
                                        <input  class="form-control col-md-7 col-xs-12"  name="relation_with"  id="add_relation_with" value="{{ old('relation_with') }}" placeholder="Relation With Guardian" type="text">
                                        @error('relation_with')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div> 
                            </div>
                               
                            <div class="<?php echo (isset($post['is_guardian'])) && $post['is_guardian'] != 'exist_guardian' ? '' :'display'; ?> fn_except_exist"> 
                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_name">Guardian Name </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_name"  id="add_gud_name" value="{{ old('gud_name') }}" placeholder="Guardian Name" type="text">
                                            @error('gud_name')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_phone">Guardian Phone</label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_phone"  id="add_gud_phone" value="{{ old('gud_phone') }}" placeholder="Guardian Phone" minlength="6" maxlength="20" type="number">
                                            @error('gud_phone')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_email">Guardian Email </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_email"  id="add_gud_email" value="{{ old('gud_email') }}" placeholder="Guardian Email"  type="text">
                                            @error('gud_email')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_profession">Profession</label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_profession"  id="add_gud_profession" value="{{ old('gud_profession') }}" placeholder="Profession"  type="text">
                                            @error('gud_profession')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">   
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_religion">Religion </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_religion"  id="add_gud_religion" value="{{ old('gud_religion') }}" placeholder="Religion" type="text">
                                            @error('gud_religion')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_national_id">National ID</label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_national_id"  id="add_gud_national_id" value="{{ old('gud_national_id') }}" placeholder="National ID"  type="text">
                                            @error('gud_national_id')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_present_address">Present Address</label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_present_address"  id="add_gud_present_address" placeholder="Present Address">{{ old('gud_present_address') }}</textarea>
                                            @error('gud_present_address')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_permanent_address">Permanent Address</label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_permanent_address"  id="add_gud_permanent_address" placeholder="Permanent Address">{{ old('gud_permanent_address') }}</textarea>
                                            @error('gud_permanent_address')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="other_info">Other Info </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_other_info"  id="add_gud_other_info" placeholder="Other Info">{{ old('gud_other_info') }}</textarea>
                                            @error('other_info')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>                                        
                                </div>

                            </div>
                            <div class="row">                  
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h5  class="column-title">
                                        <strong>
                                        Address Information: 
                                        </strong>
                                        Same As Guarduan Address <input  class=""  name="same_as_guardian"  id="same_as_guardian" value="1"  type="checkbox" <?php echo isset($post['same_as_guardian']) ?  'checked="checked"' : ''; ?>>
                                    </h5>
                                </div>
                            </div>
                               
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="item form-group">
                                        <label for="present_address">Present Address </label>
                                        <textarea style="height: 60px" class="form-control col-md-7 col-xs-12" name="present_address" id="add_present_address" placeholder="Present Address">{{old('present_address')}}</textarea>
                                        @error('present_address')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="item permanent_address-group">
                                        <label for="permanent_address">Permanent Address </label>
                                        <textarea style="height: 60px" class="form-control col-md-7 col-xs-12" name="permanent_address" id="add_permanent_address" placeholder="Permanent Address">{{ old('permanent_address')}}</textarea>
                                        @error('permanent_address')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>
                               
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h6 class="column-title"><strong>Previous School:</strong></h6>
                            </div>
                        </div>
                               
                        <div class="row">
                                
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="previous_school">Previous School </label>
                                    <input class="form-control col-md-7 col-xs-12" name="previous_school" id="previous_school" value="{{ old('previous_school') }}" placeholder="Previous School" type="text" autocomplete="off">
                                    @error('previous_school')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="previous_class">Previous Class </label>
                                    <input class="form-control col-md-7 col-xs-12" name="previous_class" id="previous_class" value="{{ old('previous_class') }}" placeholder="Previous Class" type="text" autocomplete="off">
                                    @error('previous_class')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="transfer_certificate">Transfer Certificate </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> Upload 
                                            <input  class="form-control col-md-7 col-xs-12"  name="transfer_certificate"  id="transfer_certificate" type="file" >
                                        </div>
                                        @error('transfer_certificate')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                
                        </div>       
                        
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h6 class="column-title"><strong>Other Information:</strong></h6>
                            </div>
                        </div> 
                         
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="house_id">Student House <span class="required">*</span></label>
                                    <select class="form-control col-md-7 col-xs-12 " name="house_id" id="house_id"  required="required">
                                        <option value="">--select--</option>
                                        @foreach($houses as $obj)
                                            <option value="{{ $obj->id }}"> {{ $obj->name }}</option>
                                        @endforeach                                              
                                    </select>
                                    @error('house_id')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="health_condition">Health Condition </label>
                                    <input class="form-control col-md-7 col-xs-12" name="health_condition" id="health_condition" value="{{ old('health_condition') }}" placeholder="Health Condition" type="text" autocomplete="off">
                                    @error('health_condition')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="photo">Student Photo </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> Upload 
                                            <input  class="form-control col-md-7 col-xs-12"  name="photo"  id="photo" type="file" >
                                        </div>
                                        @error('photo')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                               
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 offset-md-3">
                                <a href="{{ route('admission.list') }}" class="btn btn-primary btn-sm">Cancel</a>
                                <button id="submit" type="submit" class="btn btn-success btn-sm">Save</button>
                            </div>
                        </div>
                     </form>
                    </div>

                    </div>
                    @endisset
                    
                    @isset($approve)
                    <div class="tab-pane fade active show">    
                        <div class="x_content big-form">
                            
                            <form method="post" action="{{ route('admission.update') }}" accept-charset="UTF-8" id="form-edit" enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" value="{{ $admission->id }}" name="id" />
                                <input type="hidden" value="{{ $admission->user_id }}" name="user_id" />
                                
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h6 class="column-title"><strong>Basic Information:</strong></h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="first_name">First Name <span class="required">*</span></label>
                                        <input class="form-control col-md-7 col-xs-12" name="first_name"   id="first_name" value="{{ $admission->first_name }}" placeholder="First Name" required="name"  type="text" autocomplete="off">
                                        @error('first_name')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="middle_name">Middle Name </label>
                                        <input class="form-control col-md-7 col-xs-12" name="middle_name" id="middle_name" value="{{ $admission->middle_name }}" placeholder="Middle Name" type="text" autocomplete="off">
                                        @error('middle_name')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="last_name">Last Name </label>
                                        <input class="form-control col-md-7 col-xs-12" name="last_name" id="last_name" value="{{ $admission->last_name }}" placeholder="Last Name" type="text"  plete="off">
                                        @error('last_name')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="admission_no">Admission No </label>
                                        <input class="form-control col-md-7 col-xs-12" name="admission_no" id="admission_no" value="{{ $admission->admission_no }}" placeholder="Admission No" type="text"  plete="off">
                                        @error('admission_no')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="admission_date">Admission Date <span class="required">*</span></label>
                                        <input class="form-control col-md-7 col-xs-12" name="admission_date"   id="edit_admission_date" value="{{ $admission->admission_date }}" placeholder="Admission Date" required="name"  type="text" autocomplete="off">
                                        @error('admission_date')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="dob">Birth Date </label>
                                        <input class="form-control col-md-7 col-xs-12" name="dob" id="edit_dob" value="{{ date('d-m-Y', strtotime($admission->dob)) }}" placeholder="Birth Date" type="text"  plete="off">
                                        @error('dob')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="gender">Gender </label>
                                        <select class="form-control col-md-7 col-xs-12 " name="gender" id="gender">
                                            @php $genders = get_genders(); @endphp
                                            <option value=""> --Select-- </option>
                                            @foreach($genders as $key => $value)
                                                <option value="{{ $key }}" @if($admission->gender == $key) selected ="selected" @endif > {{ $value }}</option>
                                            @endforeach                                             
                                        </select>
                                        @error('gender')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="blood_group">Blood Group </label>
                                        <select class="form-control col-md-7 col-xs-12 " name="blood_group" id="blood_group">
                                            @php $bloolds = get_blood_group(); @endphp
                                            <option value=""> --Select-- </option>
                                            @foreach($bloolds as $key => $value)
                                                <option value="{{ $key }}" @if($admission->blood_group == $key) selected ="selected" @endif > {{ $value }}</option>
                                            @endforeach                                            
                                        </select>
                                        @error('blood_group')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="religion">Religion</label>
                                        <input class="form-control col-md-7 col-xs-12" name="religion" id="religion" value="{{ $admission->religion }}" placeholder="Religion" type="text" autocomplete="off">
                                        @error('religion')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="caste">Caste</label>
                                        <input class="form-control col-md-7 col-xs-12" name="caste" id="caste" value="{{ $admission->caste }}" placeholder="Caste" type="text" autocomplete="off">
                                        @error('caste')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="national_id">National Id</label>
                                        <input class="form-control col-md-7 col-xs-12" name="national_id" id="national_id" value="{{ $admission->national_id }}" placeholder="National Id" type="number" autocomplete="off">
                                        @error('national_id')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>

                            </div> 

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h6 class="column-title"><strong>Academic Information:</strong></h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="username">Username <span class="required">*</span></label>
                                        <input class="form-control col-md-7 col-xs-12" name="username" id="add_username" value="" placeholder="User Name" required="required" type="text" autocomplete="off">
                                        @error('username')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="password">Password <span class="required">*</span></label>
                                        <input class="form-control col-md-7 col-xs-12" name="password" id="add_password" value="" placeholder="Password" required="required" type="text" autocomplete="off">
                                        @error('password')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="email">Email <span class="required">*</span></label>
                                        <input class="form-control col-md-7 col-xs-12" name="email" id="add_email" value="" placeholder="Email" required="required" type="text" autocomplete="off">
                                        @error('email')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="role_id">User Role <span class="required">*</span></label>
                                        <select class="form-control col-md-7 col-xs-12 " name="role_id" id="role_id" required="required">
                                            <option value=""> --Select-- </option>
                                            @foreach($roles as $obj)
                                                @if(!in_array($obj->id, array(config('constants.GUARDIAN'), config('constants.TEACHER'), config('constants.STUDENT'))))
                                                <option value="{{ $obj->id }}" @if($obj->id == $admission->role_id) selected="selected" @endif >{{ $obj->name }}</option>
                                                @endif
                                            @endforeach                                        
                                        </select>
                                        @error('role_id')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>

                            </div> 
                                
                            <div class="row">

                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="type_id">Student Type <span class="required">*</span></label>
                                        <select class="form-control col-md-7 col-xs-12 " name="type_id" id="type_id"  required="required">
                                            <option value="">--select--</option>
                                            @foreach($types as $obj)
                                                <option value="{{ $obj->id }}" @if($admission->type_id == $obj->id) selected ="selected" @endif > {{ $obj->type }}</option>
                                            @endforeach                                              
                                        </select>
                                        @error('type_id')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="class_id">Class <span class="required">*</span></label>
                                        <select class="form-control col-md-7 col-xs-12 " name="class_id" id="class_id"  required="required" onchange="getClassBySection();">
                                            <option value="">--select--</option>
                                            @foreach($classes as $obj)
                                                <option value="{{ $obj->id }}" @if($admission->class_id == $obj->id) selected ="selected" @endif > {{ $obj->name }}</option>
                                            @endforeach                                              
                                        </select>
                                        @error('class_id')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="section_id">Section <span class="required">*</span></label>
                                            <select class="form-control col-md-7 col-xs-12 " name="section_id" id="sectionid"  required="required">
                                                <option value="">--select--</option>
                                            </select>
                                        @error('section_id')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="group_id">Group <span class="required">*</span></label>
                                            <select class="form-control col-md-7 col-xs-12 " name="group_id" id="group_id"  required="required">
                                                <option value="">--select--</option>
                                                @foreach($groups as $obj)
                                                    <option value="{{ $obj->id }}" @if($admission->group_id == $obj->id) selected ="selected" @endif > {{ $obj->title }}</option>
                                                @endforeach                                              
                                            </select>
                                        @error('group_id')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="roll_no">Roll No <span class="required">*</span></label>
                                        <input class="form-control col-md-7 col-xs-12" name="roll_no" id="roll_no" value="{{ $admission->roll_no }}" required="required" placeholder="Roll No" type="number" autocomplete="off">
                                        @error('roll_no')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror                                      
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="registration_no">Registration No</label>
                                        <input class="form-control col-md-7 col-xs-12" name="registration_no" id="registration_no" value="{{ $admission->registration_no }}" placeholder="Registration No" type="number" autocomplete="off">
                                        <div class="help-block">
                                            @error('registration_no')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="discount_id">Discount <span class="required">*</span></label>
                                        <select class="form-control col-md-7 col-xs-12 " name="discount_id" id="discount_id"  required="required">
                                            <option value="">--select--</option>
                                            @foreach($discounts as $obj)
                                                <option value="{{ $obj->id }}" @if($admission->discount_id == $obj->id) selected ="selected" @endif> {{ $obj->title }}</option>
                                            @endforeach                                              
                                        </select>
                                        @error('discount_id')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="second_language">Second Language</label>
                                        <input class="form-control col-md-7 col-xs-12" name="second_language" id="second_language" value="{{ $admission->second_language }}" placeholder="Second Language" type="text" autocomplete="off">
                                        @error('second_language')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h6 class="column-title"><strong>Father Information:</strong></h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="father_name">Father Name</label>
                                        <input class="form-control col-md-7 col-xs-12" name="father_name" id="father_name" value="{{ $admission->father_name }}" placeholder="Father Name" type="text" autocomplete="off">
                                        @error('father_name')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="father_phone">Father Phone</label>
                                        <input class="form-control col-md-7 col-xs-12" name="father_phone" id="father_phone" value="{{ $admission->father_phone }}" placeholder="Father Phone" type="number" autocomplete="off">
                                        @error('father_phone')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="father_education">Father Education</label>
                                        <input class="form-control col-md-7 col-xs-12" name="father_education" id="father_education" value="{{ $admission->father_education }}" placeholder="Father Education" type="text" autocomplete="off">
                                        @error('father_education')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="father_profession">Father Profession</label>
                                        <input class="form-control col-md-7 col-xs-12" name="father_profession" id="father_profession" value="{{ $admission->father_profession }}" placeholder="Father Profession" type="text" autocomplete="off">
                                        @error('father_profession')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="father_photo">Father Photo</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> Upload 
                                                <input  class="form-control col-md-7 col-xs-12"  name="father_photo"  id="father_photo" type="file" >
                                            </div>
                                            @error('father_photo')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h6 class="column-title"><strong>Mother Information:</strong></h6>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="mother_name">Mother Name</label>
                                        <input class="form-control col-md-7 col-xs-12" name="mother_name" id="mother_name" value="{{ $admission->mother_name }}" placeholder="Mother Name" type="text" autocomplete="off">
                                        @error('mother_name')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="mother_phone">Mother Phone</label>
                                        <input class="form-control col-md-7 col-xs-12" name="mother_phone" id="mother_phone" value="{{ $admission->mother_phone }}" placeholder="Mother Phone" type="number" autocomplete="off">
                                        @error('mother_phone')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="mother_education">Mother Education</label>
                                        <input class="form-control col-md-7 col-xs-12" name="mother_education" id="mother_education" value="{{ $admission->mother_education }}" placeholder="Mother Education" type="text" autocomplete="off">
                                        @error('mother_education')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="mother_profession">Mother Profession</label>
                                        <input class="form-control col-md-7 col-xs-12" name="mother_profession" id="mother_profession" value="{{ $admission->mother_profession }}" placeholder="Mother Profession" type="text" autocomplete="off">
                                        @error('mother_profession')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <div class="item form-group">
                                        <label for="mother_photo">Mother Photo</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> Upload 
                                                <input  class="form-control col-md-7 col-xs-12"  name="mother_photo"  id="mother_photo" type="file" >
                                            </div>
                                            @error('mother_photo')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>   

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h6 class="column-title"><strong>Guardian  Information:</strong></h6>
                                </div>
                            </div> 

                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12"> 
                                        <div class="item form-group">
                                            <label for="guardian_id">Guardian <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12" name="guardian_id" id="guardian_id" required="required" onchange="get_guardian_by_id(this.value);">
                                                <option value="">--Select--</option>
                                                @foreach($guardians as $obj)
                                                    <option value="{{ $obj->id }}" >{{ $obj->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('guardian_id')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="relation_with">Relation With Guardian </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="relation_with"  id="add_relation_with" value="{{ $admission->relation_with }}" placeholder="Relation With Guardian" type="text">
                                            @error('relation_with')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_phone">Guardian Phone </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_phone"  id="add_gud_phone" value="{{ $admission->gud_phone }}" placeholder="Guardian Phone" minlength="6" maxlength="20" type="number">
                                            @error('gud_phone')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_email">Guardian Email </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_email"  id="add_gud_email" value="{{ $admission->gud_email }}" placeholder="Guardian Email"  type="text">
                                            @error('gud_email')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row"> 
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_profession">Profession</label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_profession"  id="add_gud_profession" value="{{ $admission->gud_profession }}" placeholder="Profession"  type="text">
                                            @error('gud_profession')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_religion">Religion </label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_religion"  id="add_gud_religion" value="{{ $admission->gud_religion }}" placeholder="Religion" type="text">
                                            @error('gud_religion')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_national_id">National ID</label>
                                            <input  class="form-control col-md-7 col-xs-12"  name="gud_national_id"  id="add_gud_national_id" value="{{ $admission->gud_national_id }}" placeholder="National ID"  type="text">
                                            @error('gud_national_id')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_present_address">Present Address</label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_present_address"  id="add_gud_present_address" placeholder="Present Address">{{ $admission->gud_present_address }}</textarea>
                                            @error('gud_present_address')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="gud_permanent_address">Permanent Address</label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_permanent_address"  id="add_gud_permanent_address" placeholder="Permanent Address">{{ $admission->gud_permanent_address }}</textarea>
                                            @error('gud_permanent_address')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item form-group">
                                            <label for="other_info">Other Info </label>
                                            <textarea  class="form-control col-md-7 col-xs-12 textarea-4column"  name="gud_other_info"  id="add_gud_other_info" placeholder="Other Info">{{ $admission->gud_other_info }}</textarea>
                                            @error('other_info')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>                                        
                                </div>

                            <div class="row">                  
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h5  class="column-title">
                                        <strong>
                                        Address Information: 
                                        </strong>
                                    </h5>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="item form-group">
                                        <label for="present_address">Present Address </label>
                                        <textarea style="height: 60px" class="form-control col-md-7 col-xs-12" name="present_address" id="present_address" placeholder="Present Address">{{ $admission->present_address }}</textarea>
                                        @error('present_address')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="item permanent_address-group">
                                        <label for="permanent_address">Permanent Address </label>
                                        <textarea style="height: 60px" class="form-control col-md-7 col-xs-12" name="permanent_address" id="permanent_address" placeholder="Permanent Address">{{ $admission->permanent_address }}</textarea>
                                        @error('permanent_address')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h6 class="column-title"><strong>Previous School:</strong></h6>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="previous_school">Previous School </label>
                                    <input class="form-control col-md-7 col-xs-12" name="previous_school" id="previous_school" value="{{ $admission->previous_school }}" placeholder="Previous School" type="text" autocomplete="off">
                                    @error('previous_school')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="previous_class">Previous Class </label>
                                    <input class="form-control col-md-7 col-xs-12" name="previous_class" id="previous_class" value="{{ $admission->previous_class }}" placeholder="Previous Class" type="text" autocomplete="off">
                                    @error('previous_class')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="transfer_certificate">Transfer Certificate </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> Upload 
                                            <input  class="form-control col-md-7 col-xs-12"  name="transfer_certificate"  id="transfer_certificate" type="file" >
                                        </div>
                                        @error('transfer_certificate')
                                            <div class="help-block error">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>       

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h6 class="column-title"><strong>Other Information:</strong></h6>
                            </div>
                        </div> 

                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="house_id">Student House <span class="required">*</span></label>
                                    <select class="form-control col-md-7 col-xs-12 " name="house_id" id="house_id"  required="required">
                                        <option value="">--select--</option>
                                        @foreach($houses as $obj)
                                            <option value="{{ $obj->id }}" @if($admission->house_id == $obj->id) selected ="selected" @endif> {{ $obj->name }}</option>
                                        @endforeach                                              
                                    </select>
                                    @error('house_id')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="health_condition">Health Condition </label>
                                    <input class="form-control col-md-7 col-xs-12" name="health_condition" id="health_condition" value="{{ $admission->health_condition }}" placeholder="Health Condition" type="text" autocomplete="off">
                                    @error('health_condition')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item form-group">
                                    <label for="photo">Student Photo</label>
                                    <div class="btn btn-default btn-file"><i class="fa fa-paperclip"></i> Upload
                                        <input class="form-control col-md-7 col-xs-12" name="photo" id="photo"  type="file">
                                        <input name="photo_prev" id="photo_prev" type="hidden" value="{{ $admission->photo }}">
                                    </div>
                                    @error('photo')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                    <div class="item form-group">
                                        @if($admission->photo)
                                            <img src="{{ asset(config('constants.UPLOAD_PATH').'admission/'.$admission->photo) }}" alt="" width="70" style="padding: 5px;" /><br /><br />
                                        @endif
                                   </div>
                                </div>
                            </div>
                        </div>

                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 offset-md-3">
                                <a href="{{ route('admission.list') }}" class="btn btn-primary btn-sm">Cancel</a>
                                <button id="submit" type="submit" class="btn btn-success btn-sm">Update</button>
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
<div class="modal fade bs-admission-modal" id="fn-admission-data" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Online Admission Detail</h5>
                <button type="button" class="fn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fn-admission-data">               
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
    
    $('#edit_admission_date').datepicker({endDate: "today"});
    $('#add_dob').datepicker({ startView: 2, endDate: "today" }); 
    $('#edit_dob').datepicker({ startView: 2, endDate: "today" }); 
    
    $().ready(function() {
        $("#form-add").validate();     
        $("#form-edit").validate();   
    });
    
</script>

<script type="text/javascript">
    
    function decline_status(decline_id){
     
       $.ajax({ 
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type   : "POST",
            url    : "/student/admission/decline_status",
            data   : {decline_id : decline_id},  
            success: function(data){
                location.reload();
            }
       });
    }
    
    function waiting_status(waiting_id){
     
       $.ajax({ 
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type   : "POST",
            url    : "/student/admission/waiting_status",
            data   : {waiting_id : waiting_id},  
            success: function(data){
                location.reload();
            }
       });
    }
    
</script>

<script type="text/javascript">
         
    function get_admission_modal(admission_id){
         
        $('.fn-admission-data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="/assets/images/loading.gif" /></p>');
        $.ajax({ 
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type   : "GET",
          url    : "/student/admission/view/"+admission_id,
          data   : {admission_id : admission_id},  
          success: function(response){                                                   
            if(response)
             {
                $('.fn-admission-data').html(response);
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
            url    : "/student/admission/class_by_section",
            data   : {class_id : class_id},  
            success: function(response){
                $('#sectionid').html(response);
            }
       });
    }

</script>

<script type="text/javascript">
    
        function get_student_by_class(url){          
            if(url){
                window.location.href = url; 
            }
        }
        
        function check_guardian_type(guardian_type){
           
            $('#add_relation_with').val('');  
            $('#add_gud_name').val('');  
            $('#add_gud_phone').val('');  
            $('#add_gud_present_address').val('');  
            $('#add_gud_permanent_address').val('');  
            $('#add_gud_religion').val(''); 
            $('#add_gud_profession').val(''); 
            $('#add_gud_national_id').val(''); 
            $('#add_gud_email').val(''); 
            $('#add_gud_username').val(''); 
            $('#add_gud_other_info').val(''); 
                    
           if(guardian_type == 'father'){
               
               $('#add_relation_with').val('Father'); 
               $('.fn_existing_guardian').hide();
               $('.fn_except_exist').show();
               $('#guardian_id').prop('required', false);               
               $('#add_gud_name').prop('required', true);               
               $('#add_gud_phone').prop('required', true);               
               //$('#add_gud_email').prop('required', true);               
               $('#add_gud_username').prop('required', true);               
               
               var f_name = $('#add_father_name').val();
               var f_phone = $('#add_father_phone').val(); 
               var f_education = $('#add_father_education').val(); 
               var f_profession = $('#add_father_profession').val(); 
               var f_designation = $('#add_father_designation').val(); 
               var f_present_address = $('#add_gud_present_address').val();
               var f_present_permanent_address = $('#add_gud_permanent_address').val();
               
               $('#add_present_address').val(f_present_address); 
               $('#add_permanent_address').val(f_present_permanent_address); 
               $('#add_gud_name').val(f_name);  
               $('#add_gud_phone').val(f_phone); 
               $('#add_gud_profession').val(f_profession); 
               
           }else if(guardian_type == 'mother'){
               
               $('#add_relation_with').val('Mother');   
               $('.fn_existing_guardian').hide();
               $('.fn_except_exist').show();
               $('#guardian_id').prop('required', false);
               $('#add_gud_name').prop('required', true);               
               $('#add_gud_phone').prop('required', true);               
               //$('#add_gud_email').prop('required', true); 
               $('#add_gud_username').prop('required', true); 
               
               var m_name = $('#add_mother_name').val();
               var m_phone = $('#add_mother_phone').val(); 
               var m_education = $('#add_mother_education').val(); 
               var m_profession = $('#add_mother_profession').val(); 
               var m_designation = $('#add_mother_designation').val(); 
               var f_present_address = $('#add_gud_present_address').val();
               var f_present_permanent_address = $('#add_gud_permanent_address').val();
               
               $('#add_present_address').val(f_present_address); 
               $('#add_permanent_address').val(f_present_permanent_address); 
               $('#add_gud_name').val(m_name);  
               $('#add_gud_phone').val(m_phone); 
               $('#add_gud_profession').val(m_profession); 
               
           }else if(guardian_type == 'other'){
               $('#add_relation_with').val('Other');    
               $('.fn_existing_guardian').hide();
               $('.fn_except_exist').show();
               $('#guardian_id').prop('required', false);
               $('#add_gud_name').prop('required', true);               
               $('#add_gud_phone').prop('required', true);               
               //$('#add_gud_email').prop('required', true); 
               $('#add_gud_username').prop('required', true);  
                              
           }else if(guardian_type == 'exist_guardian'){
               $('.fn_existing_guardian').show();
               $('.fn_except_exist').hide();
               $('#guardian_id').prop('required', true);   
               $('#add_gud_name').prop('required', false);               
               $('#add_gud_phone').prop('required', false);               
               $('#add_gud_email').prop('required', false); 
               
           }else{
                $('#add_relation_with').val('');   
                $('.fn_existing_guardian').hide();
                $('.fn_except_exist').show();
                $('#guardian_id').prop('required', false);
                $('#add_gud_name').prop('required', true);               
                $('#add_gud_phone').prop('required', true);               
                //$('#add_gud_email').prop('required', true); 
                $('#add_gud_username').prop('required', true); 
           }
        
        }
        
        function get_guardian_by_id(guardian_id){                       
            
            $.ajax({       
            type   : "POST",
            dataType: "json",
            url    : "/student/admission/get_guardian_by_id",
            data   : { guardian_id : guardian_id},               
            async  : true,
            success: function(response){ 
               if(response)
               {
                    $('#add_gud_name').val(response.name);  
                    $('#add_gud_phone').val(response.phone);  
                    $('#add_gud_present_address').val(response.present_address);  
                    $('#add_gud_permanent_address').val(response.permanent_address);  
                    $('#add_gud_religion').val(response.religion);  
                    $('#add_gud_profession').val(response.profession);  
                    $('#add_gud_national_id').val(response.national_id);  
                    $('#add_gud_email').val(response.email);  
                    $('#add_gud_other_info').val(response.other_info);  
               } else {
                    $('#add_relation_with').val('');  
                    $('#add_gud_name').val('');  
                    $('#add_gud_phone').val('');  
                    $('#add_gud_present_address').val('');  
                    $('#add_gud_permanent_address').val('');  
                    $('#add_gud_religion').val(''); 
                    $('#add_gud_profession').val(''); 
                    $('#add_gud_national_id').val(''); 
                    $('#add_gud_email').val(''); 
                    $('#add_gud_other_info').val(''); 
               }
            }
        });  
        
        }
        
    $('#same_as_guardian').on('click', function(){
        
        if($(this).is(":checked")) {
            var present =  $('#add_gud_present_address').val();  
            var permanent = $('#add_gud_permanent_address').val();  
            $('#add_present_address').val(present);  
            $('#add_permanent_address').val(permanent);  
        }else{
             $('#add_present_address').val('');  
             $('#add_permanent_address').val(''); 
        }
    });
        
      
</script>

@endsection

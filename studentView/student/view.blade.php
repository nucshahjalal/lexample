
<div class="" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered">
        <li class=""><a href="#tab_basic_info" class="active"  role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> Basic Information</a> </li>
        <li class=""><a href="#tab_guardian_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-paw"></i> Guardian Information</a> </li>
        <li class=""><a href="#tab_parent_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-male"></i> Parent Information</a> </li>
        <li  class=""><a href="#tab_attendance"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-check-circle-o"></i> Attendance</a> </li>                          
        <li  class=""><a href="#tab_mark"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-file-archive-o"></i> Exam Mark</a> </li>                          
        <li  class=""><a href="#tab_payment"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-dollar"></i> Payment </a> </li>                          
        <li  class=""><a href="#tab_activity"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-clipboard"></i> Activity </a> </li>                          
    </ul>
    <br/>

    <div class="tab-content">
        <div  class="tab-pane fade in active show" id="tab_basic_info" >  
            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <tbody>
                    <tr>
                        <th width="30%">First Name</th>
                        <td>{{ $student->first_name }}</td>
                        <th width="30%">Middle Name</th>
                        <td>{{ $student->middle_name }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Last Name</th>
                        <td>{{ $student->last_name }}</td>
                        <th width="30%">Admission No</th>
                        <td>{{ $student->admission_no }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Admission Date</th>
                        <td>{{ date('d-m-Y', strtotime($student->admission_date)) }}</td>
                        <th width="30%">Birth Date</th>
                        <td>{{ date('d-m-Y', strtotime($student->dob)) }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Gender </th>
                        <td>{{ ucfirst($student->gender) }}</td>
                        <th width="30%">Blood Group</th>
                        <td>{{ $student->blood_group }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Religion</th>
                        <td>{{ $student->religion }}</td>
                        <th width="30%">Caste</th>
                        <td>{{ $student->caste }}</td>
                    </tr>
                    <tr>
                        <th width="30%">National Id</th>
                        <td>{{ $student->type }}</td>
                        <th width="30%">Group </th>
                        <td>{{ $student->group }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Roll No</th>
                        <td>{{ $student->roll_no }}</td>
                        <th width="30%">Registration No</th>
                        <td>{{ $student->registration_no }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Discount </th>
                        <td>{{ $student->discount }}</td>
                        <th width="30%">Second Language</th>
                        <td>{{ $student->second_language }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Permanent Address</th>
                        <td>{{ $student->permanent_address }}</td>
                        <th width="30%">Previous School</th>
                       <td>{{ $student->previous_school }}</td>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <td>{{ $student->class_name }}</td>
                        <th>Section</th>
                        <td>{{ $student->section_name }}</td>
                    </tr>
                    <tr>
                       <th width="30%">Previous School</th>
                        <td>{{ $student->previous_school }}</td>
                        <th width="30%">Previous Class</th>
                        <td>{{ $student->previous_class }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Transfer Certificate</th>
                        <td>
                            @if($student->transfer_certificate)
                                <a href="{{ asset(config('constants.UPLOAD_PATH').'student/'.$student->transfer_certificate) }}" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-download"></i> Download</a> <br/>
                            @endif
                        </td>
                        <th>Health Condition</th>
                        <td>{{ $student->health_condition }}</td>
                    </tr>
                    <tr>
                        <th>Status Type</th>
                        <td>{{ ucfirst($student->status_type) }}</td>
                        <th>Status</th>
                        <td>{{ $student->status ? 'Active' : 'InActive' }}</td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td>{{ $student->age }}</td>
                    </tr>
                    <tr>
                        <th>Other Info</th>
                        <td>{{ $student->other_info }}</td>
                        <th>Photo</th>
                        <td>
                            @if($student->photo) 
                                <img src="{{ asset(config('constants.UPLOAD_PATH').'student/'.$student->photo) }}" width="50px" height="50px">
                            @else
                                <img src="{{ asset(config('constants.UPLOAD_PATH').'default-user.png') }}" width="50px" height="50px">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>                
        </div>
        <div  class="tab-pane fade in " id="tab_guardian_info" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th width="30%">Guardian</th>
                        <td>{{ $student->guardian  }}</td>
                        <th width="30%">Relation With Guardian</th>
                        <td>{{ $student->relation_with }}</td>
                    </tr>                                                
                     <tr>
                        <th width="30%">Is Guardian</th>
                        <td>{{ $student->guardian_is }}</td>
                    </tr>
                </tbody>
            </table>  
        </div>
        <div  class="tab-pane fade in " id="tab_parent_info" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th width="30%">Father Name</th>
                        <td>{{ $student->father_name }}</td>
                        <th width="30%">Father Phone</th>
                        <td>{{ $student->father_phone }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Father Education</th>
                        <td>{{ $student->father_education }}</td>
                        <th width="30%">Father Profession</th>
                        <td>{{ $student->father_profession }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Father Photo</th>
                        <td>
                            @if($student->father_photo) 
                                <img src="{{ asset(config('constants.UPLOAD_PATH').'student/'.$student->father_photo) }}" width="50px" height="50px">
                            @else
                                <img src="{{ asset(config('constants.UPLOAD_PATH').'default-user.png') }}" width="50px" height="50px">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">Mother Name</th>
                        <td>{{ $student->mother_name }}</td>
                        <th width="30%">Mother Phone</th>
                       <td>{{ $student->mother_phone }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Mother Education</th>
                        <td>{{ $student->mother_education }}</td>
                        <th width="30%">Mother Profession</th>
                       <td>{{ $student->mother_profession }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Mother Photo</th>
                        <td>
                            @if($student->mother_photo) 
                                <img src="{{ asset(config('constants.UPLOAD_PATH').'student/'.$student->mother_photo) }}" width="50px" height="50px">
                            @else
                                <img src="{{ asset(config('constants.UPLOAD_PATH').'default-user.png') }}" width="50px" height="50px">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>  
        </div>
        <div  class="tab-pane fade in " id="tab_attendance" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                       
                    </tr>
                </thead>
                <tbody>   
                      
                </tbody>
            </table>  
        </div>
        <div  class="tab-pane fade in " id="tab_mark" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                                                                 
                    </tr>
                    <tr>                           
                       
                    </tr>
                </thead>
                  
            </table>  
             
            <table class="table table-striped_ table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              

                     
            </table>
        </div>
        
        <div  class="tab-pane fade in " id="tab_activity" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>SL No</th>
                    <th>Student</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Date</th>
                    <th>Activity</th>
                </tr>
                </thead>
                 <tbody>   
                    @foreach($activity as $obj)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $obj->first_name . ' ' . $obj->middle_name .' ' . $obj->last_name }}</td>
                        <td>{{ $obj->class_name }}</td>
                        <td>{{ $obj->section_name }}</td>
                        <td>{{ date('M j,Y', strtotime($obj->activity_date)) }}</td>
                        <td>{{ $obj->activity }}</td>
                    </tr>
                    @endforeach
                </tbody>                    
            </table>  
        </div>  
        
    </div>
</div>

<style type="text/css">
    .table>thead>tr>th { padding: 2px 4px;}
    .table>tbody>tr>th { padding: 2px 4px;}    
    .table>tbody>tr>td { padding: 2px 4px;}    
</style>



<div class="" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered">
        <li class=""><a href="#tab_basic_info" class="active"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> Basic Information</a> </li>
        <li class=""><a href="#tab_guardian_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-paw"></i> Guardian Information</a> </li>
        <li class=""><a href="#tab_parent_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-male"></i> Parent Information</a> </li>
    </ul>
    <br/>

    <div class="tab-content">
        <div  class="tab-pane fade in active show" id="tab_basic_info" >               
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th width="30%">First Name</th>
                        <td>{{ $admission->first_name }}</td>
                        <th width="30%">Middle Name</th>
                        <td>{{ $admission->middle_name }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Last Name</th>
                        <td>{{ $admission->last_name }}</td>
                        <th width="30%">Birth Date</th>
                        <td>{{ date('d-m-Y', strtotime($admission->dob)) }}</td>
                        
                    </tr>
                    <tr>
                        <th width="30%">Gender </th>
                        <td>{{ ucfirst($admission->gender) }}</td>
                        <th width="30%">Blood Group</th>
                        <td>{{ $admission->blood_group }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Religion</th>
                        <td>{{ $admission->religion }}</td>
                        <th width="30%">Caste</th>
                        <td>{{ $admission->caste }}</td>
                    </tr>
                    <tr>
                        <th width="30%">National Id</th>
                        <td>{{ $admission->national_id }}</td>
                        <th width="30%">Group </th>
                        <td>{{ $admission->group }}</td>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <td>{{ $admission->class_name }}</td>
                        <th width="30%">Second Language</th>
                        <td>{{ $admission->second_language }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Permanent Address</th>
                        <td>{{ $admission->permanent_address }}</td>
                        <th width="30%">Previous School</th>
                       <td>{{ $admission->previous_school }}</td>
                    </tr>
                    <tr>
                       <th width="30%">Previous School</th>
                        <td>{{ $admission->previous_school }}</td>
                        <th width="30%">Previous Class</th>
                        <td>{{ $admission->previous_class }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Transfer Certificate</th>
                        <td>
                            @if($admission->transfer_certificate)
                                <a href="{{ asset(config('constants.UPLOAD_PATH').'admission/'.$admission->transfer_certificate) }}" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-download"></i> Download</a> <br/>
                            @endif
                        </td>
                        <th>Health Condition</th>
                        <td>{{ $admission->health_condition }}</td>
                    </tr>
                    <tr>
                        <th>Other Info</th>
                        <td>{{ $admission->other_info }}</td>
                        <th>Photo</th>
                        <td>
                            @if($admission->photo) 
                                <img src="{{ asset(config('constants.UPLOAD_PATH').'admission/'.$admission->photo) }}" width="50px" height="50px">
                            @else
                                <img src="{{ asset(config('constants.UPLOAD_PATH').'default-user.png') }}" width="50px" height="50px">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($admission->status == 1)
                            <a href="javascript:void(0);" class="btn btn-default btn-xs"> New </a>
                            @elseif($admission->status == 2)
                                <a href="javascript:void(0);" class="btn btn-info btn-xs">Waiting </a>
                            @elseif($admission->status == 3)
                                <a href="javascript:void(0);" class="btn btn-danger btn-xs">Declined </a> 
                            @elseif($admission->status == 4)
                                <a href="javascript:void(0);" class="btn btn-success btn-xs">Approved </a>  
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
                        <td>{{ $admission->guardian  }}</td>
                        <th width="30%">Relation With Guardian</th>
                        <td>{{ $admission->relation_with }}</td>
                    </tr>                                                
                     <tr>
                        <th width="30%">Is Guardian</th>
                        <td>{{ $admission->guardian_is }}</td>
                    </tr>
                    
                </tbody>
            </table>  
        </div>
        <div  class="tab-pane fade in " id="tab_parent_info" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th width="30%">Father Name</th>
                        <td>{{ $admission->father_name }}</td>
                        <th width="30%">Father Phone</th>
                        <td>{{ $admission->father_phone }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Father Education</th>
                        <td>{{ $admission->father_education }}</td>
                        <th width="30%">Father Profession</th>
                        <td>{{ $admission->father_profession }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Mother Name</th>
                        <td>{{ $admission->mother_name }}</td>
                        <th width="30%">Mother Phone</th>
                       <td>{{ $admission->mother_phone }}</td>
                    </tr>
                    <tr>
                        <th width="30%">Mother Education</th>
                        <td>{{ $admission->mother_education }}</td>
                        <th width="30%">Mother Profession</th>
                       <td>{{ $admission->mother_profession }}</td>
                    </tr>
                </tbody>
            </table>  
        </div>
        
        <div  class="tab-pane fade in " id="tab_activity" >
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              
                </thead>
                 <tbody>   
                    
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



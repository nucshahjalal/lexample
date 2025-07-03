@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-users"></i><small> Manage Bulk Student</small></h3>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>                    
                </ul>
                <div class="clearfix"></div>
            </div>
            
            <div class="x_content quick-link">
                @include('student.quick-link') 
            </div>
            <div class="x_content">
                <div class="" data-example-id="togglable-tabs">
                    
                    <ul  class="nav nav-tabs bordered">
                        <li  class="active"><a href="#tab_add_bulk_student"  role="tab"  data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square-o"></i> Add </a> </li>
                    </ul> 
                    <br/>
                    
                    <div class="tab-content">
                       
                        <div  class="tab-pane fade in active show" id="tab_add_bulk_student">
                            <div class="x_content big-form"> 
                            <form method="post" action="{{ route('bulk.save') }}" accept-charset="UTF-8" id="form-add" enctype="multipart/form-data">
                               @csrf
                              
                                <div class="row">                                      
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                             <label for="academic_year_id">Academic Year <span class="required">*</span></label>
                                             <select  class="form-control col-md-7 col-xs-12" name="academic_year_id" id="academic_year_id" required="required">
                                                <option value="">--Select--</option>
                                                @foreach($academic_years as $obj)
                                                    <option value="{{ $obj->id }}>" <?php echo isset($post['academic_year_id']) && $post['academic_year_id'] == $obj->id ?  'selected="selected"' : ''; ?>><?php echo $obj->session_year; if($obj->is_running){ echo '[Running Year ]'; } ?></option>
                                                @endforeach
                                            </select>
                                            @error('academic_year_id')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                             <label for="class_id">Class <span class="required">*</span></label>
                                             <select  class="form-control col-md-7 col-xs-12" name="class_id" id="class_id" required="required" onchange="getClassBySection(this.value);">
                                                <option value="">--Select--</option>
                                                @foreach($classes as $obj)
                                                    <option value="{{ $obj->id }}">{{ $obj->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                         </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                         <div class="item form-group">
                                            <label for="section_id">Section <span class="required">*</span></label>
                                            <select  class="form-control col-md-7 col-xs-12" name="section_id" id="sectionid" required="required">
                                                <option value="">--Select--</option>
                                            </select>
                                            @error('section_id')
                                                <div class="help-block error">{{ $message }}</div>                                        
                                            @enderror
                                         </div>
                                     </div> 
                                     <div class="col-md-2 col-sm-2 col-xs-12">
                                         <div class="item form-group">
                                             <label for="">&nbsp;</label>
                                            <a href=""  class="btn btn-success btn-md">Generate CSV</a>
                                         </div>
                                     </div> 
                                    <div class="col-md-2 col-sm-2 col-xs-12">
                                         <div class="item form-group">
                                             <label>CSV File&nbsp;</label>
                                            <div class="btn btn-default btn-file">
                                                <i class="fa fa-paperclip"></i> upload
                                                <input  class="form-control col-md-7 col-xs-12"  name="bulk_student"  id="bulk_student" type="file">
                                            </div>
                                         </div>
                                    </div>
                                </div>
                                                            
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a  href="" class="btn btn-primary">Cancel</a>
                                        <button id="send" type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="instructions"><strong>Instruction: </strong> 
                                        <ol>
                                            <li>Bulk Student Instruction-3</li>
                                            <li>Bulk Student Instruction-4 </li>
                                            <li>Gender: [ male, female ]</li>
                                            <li>Academic Group: [ science, arts, commerce ]</li>
                                            <li>Blood Group: [ a_positive, a_negative, b_positive, b_negative, o_positive, o_negative, ab_positive, ab_negative ]</li>
                                            <li>
                                                Bulk Student Instruction-7
                                                <a target="_blank" href="">Student Type</a>
                                            </li>
                                            <li>
                                                Bulk Student Instruction-8
                                                <a target="_blank" href="">Discount</a>
                                            </li>
                                            <li>Bulk Student Instruction-5</li>
                                            <li>Bulk Student Instruction-6</li>
                                        </ol>
                                    </div>
                                </div>
                                
                            </div>
                        </div>  
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    function getClassBySection(){

        var class_id = $('#class_id').val();

        $.ajax({ 
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type   : "GET",
            url    : "/student/manage-student/class_by_section",
            data   : {class_id : class_id},  
            success: function(response){
                $('#sectionid').html(response);
            }
       });
    }

</script>

<script type="text/javascript">   
    $().ready(function() {
//        $("#form-add").validate();     
    });
</script>

@endsection

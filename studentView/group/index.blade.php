@extends('layouts.default')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3 class="head-title"><i class="fa fa-bars "></i><small> Manage Student Group</small></h3>
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
                    <form method="get" action="{{ route('group.list') }}" accept-charset="UTF-8" class="form-horizontal">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="item form-group">                             
                                <input class="form-control col-md-7 col-xs-12 " name="filter" id="filter"  value="{{ @$filter }}" placeholder="Search Group..." type="text">
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
                        <a href="{{ route('group.list') }}"  class="nav-link <?php if(isset($list)){ echo 'active'; }?>" ><i class="fa fa-list "></i> List</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('group.add') }}" class="nav-link <?php if(isset($add)){ echo 'active'; }?>" ><i class="fa fa-plus "></i> Add</a>
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
                                            <th>Title</th>
                                            <th>Note</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse($groups as $obj)
                                        
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $obj->title }}</td>
                                                <td>{{ $obj->note }}</td>
                                                <td>{{ $obj->status ? 'Active' : 'InActive' }}</td>
                                                <td>
                                                    <a href="{{ route('group.edit', $obj->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> Edit </a>
                                                    <form action="{{ route('group.delete', $obj->id) }}" method="POST">
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
                                
                                {!! $groups->withQueryString()->links('pagination::bootstrap-5') !!}
                                
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
                            
                            <form method="post" action="{{ route('group.save') }}" accept-charset="UTF-8" id="form-add">
                               @csrf
                               
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12 " name="title" id="title"  value="{{ old('title') }}" placeholder="Title" required="required" type="text">
                                    @error('title')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note">Note</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" name="note" id="note" placeholder="Note">{{ old('note') }}</textarea>
                                    @error('note')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 offset-md-3">
                                    <a href="{{ route('group.list') }}" class="btn btn-primary btn-sm">Cancel</a>
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
                            
                            <form method="post" action="{{ route('group.update') }}" accept-charset="UTF-8" id="form-edit">
                                @csrf 
                                
                            <input type="hidden" value="{{ $group->id }}" name="id" />
                            
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="title" id="title"  value="{{ $group->title }}"  placeholder="Title" required="required" type="text">
                                    @error('title')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="note">Note</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" name="note" id="note" placeholder="Note">{{ $group->note }}</textarea>
                                    @error('note')
                                        <div class="help-block error">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                                
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="status">Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:6px;">
                                     Active: 
                                    <input type="radio" class="flat" name="status" id="Active" value="1" @if($group->status == 1) checked="checked" @endif /> 
                                     In Active: 
                                    <input type="radio" class="flat" name="status" id="InActive" value="0" @if($group->status == 0) checked="checked" @endif />
                                </div>
                            </div>    

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 offset-md-3">
                                    <a href="{{ route('group.list') }}" class="btn btn-primary btn-sm">Cancel</a>
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

<script type="text/javascript">   
    $().ready(function() {
//        $("#form-add").validate();     
//        $("#form-edit").validate();   
    });
</script>

@endsection

@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3 class="head-title"><i class="fa fa-bars "></i><small>Manage Enquiry</small></h3>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content quick-link">
                    @include('frontOffice.quick-link')
                </div>
                <div class="x_content">
                    <div class="row">
                        <form method="get" action="{{ route('enquiry') }}" accept-charset="UTF-8" class="form-horizontal">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="item form-group">
                                    <input class="form-control col-md-7 col-xs-12 " name="filter" id="filter" value="{{ @$filter }}" placeholder="Search Enquiry Info..." type="text">
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
                            <a href="{{ route('enquiry') }}" class="nav-link <?php if (isset($list)) { echo 'active'; } ?>"><i class="fa fa-list "></i> List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('enquiry.add') }}" class="nav-link <?php if (isset($add)) { echo 'active'; } ?>"><i class="fa fa-plus "></i> Add</a>
                        </li>
                        @isset($edit)
                            <li class="nav-item">
                                <a class="nav-link active"><i class="fa fa-edit "></i> Edit</a>
                            </li>
                        @endisset
                    </ul>
                    <div class="tab-content">
                        @isset($list)
                            <div class="tab-pane fade in active show">
                                <div class="x_content">
                                    <div class="card-box table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered table-hover" style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Sl#</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Date</th>
                                                    <th>Follow Up</th>
                                                    <th>Class</th>
                                                    <th>No Of Child</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($enquiries as $obj)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $obj->name }}</td>
                                                        <td>{{ $obj->phone }}</td>
                                                        <td>{{ $obj->email }}</td>
                                                        <td>{{ $obj->date }}</td>
                                                        <td>{{ $obj->follow_up_date }}</td>
                                                        <td>{{ $obj->class }}</td>
                                                        <td>{{ $obj->no_of_child }}</td>
                                                        <td>{{ $obj->status == 1 ? 'Active' : 'InActive' }}</td>
                                                        <td>
                                                            <a onclick="get_enquiry_modal( {{ $obj->id }} );" data-toggle="modal" data-target=".bs-enquiry-modal" class="btn btn-info btn-xs"><i class="fa fa-eye-slash"></i> View </a>
                                                            <a href="{{ route('enquiry.edit', $obj->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> Edit </a>
                                                            <form action="{{ route('enquiry.delete', $obj->id) }}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger btn-xs" onclick="javascript: return confirm('confirm_alert')"><i class="fa fa-trash-o"></i> Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="10">There are no data found.</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>

                                        {!! $enquiries->withQueryString()->links('pagination::bootstrap-5') !!}

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
                                    <form method="post" action="{{ route('enquiry.save') }}" accept-charset="UTF-8" id="form-add">
                                        @csrf
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="name" id="name" value="{{ old('name') }}" placeholder="Name" required="required" type="text">
                                                @error('name')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="phone" id="phone" value="{{ old('phone') }}" placeholder="Phone" required="required" type="text">
                                                @error('phone')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="email" id="email" value="{{ old('email') }}" placeholder="Email" type="text">
                                                @error('email')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control col-md-7 col-xs-12 " name="address" id="address" placeholder="Address" rows="4">{{ old('address') }}</textarea>
                                                @error('address')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control col-md-7 col-xs-12 " name="description" id="description" placeholder="Description" rows="4">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="date" id="date" value="{{ old('date') }}" placeholder="Date" required="required" type="date">
                                                @error('date')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="follow_up_date">Follow Up</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="follow_up_date" id="follow_up_date" value="{{ old('follow_up_date') }}" placeholder="Follow Up" type="date">
                                                @error('follow_up_date')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="source">Source<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="source" id="source" value="{{ old('source') }}" placeholder="Source" required="required" type="text">
                                                @error('source')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reference">reference</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="reference" id="reference" value="{{ old('reference') }}" placeholder="reference" type="text">
                                                @error('reference')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="assigned_to">Assigned To<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="assigned_to" id="assigned_to" value="{{ old('assigned_to') }}" placeholder="Assigned To" required="required" type="text">
                                                @error('assigned_to')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class">Class<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="class" id="class" value="{{ old('class') }}" placeholder="Class" required="required" type="number">
                                                @error('class')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_of_child">No Of Child<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="no_of_child" id="no_of_child" value="{{ old('no_of_child') }}" placeholder="No Of Child" required="required" type="number">
                                                @error('no_of_child')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 offset-md-3">
                                                <a href="{{ route('enquiry') }}" class="btn btn-primary btn-sm">Cancel</a>
                                                <button id="submit" type="submit" class="btn btn-success btn-sm">Save</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        @endisset
                        @isset($edit)
                            <div class="tab-pane fade active show">
                                <div class="x_content small-form">
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for=""><span></span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            @include('partials.error')
                                        </div>
                                    </div>

                                    <form method="post" action="{{ route('enquiry.update') }}" accept-charset="UTF-8" id="form-edit">
                                        @csrf
                                        <input type="hidden" value="{{ $enquiry->id }}" name="id" />
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="name" id="name" value="{{ $enquiry->name }}" placeholder="Name" required="required" type="text">
                                                @error('name')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="phone" id="phone" value="{{ $enquiry->phone }}" placeholder="Phone" required="required" type="text">
                                                @error('phone')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="email" id="email" value="{{ $enquiry->email }}" placeholder="Email" type="text">
                                                @error('email')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control col-md-7 col-xs-12 " name="address" id="address" placeholder="Address" rows="4">{{ $enquiry->address }}</textarea>
                                                @error('address')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control col-md-7 col-xs-12 " name="description" id="description" placeholder="Description" rows="4">{{ $enquiry->description }}</textarea>
                                                @error('description')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="date" id="date" value="{{ $enquiry->date }}" placeholder="Date" required="required" type="date">
                                                @error('date')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="follow_up_date">Follow Up</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="follow_up_date" id="follow_up_date" value="{{ $enquiry->follow_up_date }}" placeholder="Follow Up" type="date">
                                                @error('follow_up_date')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="source">Source<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="source" id="source" value="{{ $enquiry->source }}" placeholder="Source" required="required" type="text">
                                                @error('source')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reference">reference</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="reference" id="reference" value="{{ $enquiry->reference }}" placeholder="reference" type="text">
                                                @error('reference')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="assigned_to">Assigned To<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="assigned_to" id="assigned_to" value="{{ $enquiry->assigned_to }}" placeholder="Assigned To" required="required" type="text">
                                                @error('assigned_to')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class">Class<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="class" id="class" value="{{ $enquiry->class }}" placeholder="Class" required="required" type="number">
                                                @error('class')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_of_child">No Of Child<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="no_of_child" id="no_of_child" value="{{ $enquiry->no_of_child }}" placeholder="No Of Child" required="required" type="number">
                                                @error('no_of_child')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="status">Status</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:6px;">
                                                 Active:
                                                <input type="radio" class="status" name="status" id="Active" value="1" @if($enquiry->status == 1) checked="checked" @endif  />
                                                 In Active:
                                                <input type="radio" class="status" name="status" id="InActive" value="0" @if($enquiry->status == 0) checked="checked" @endif />
                                            </div>
                                            @error('status')
                                                <div class="help-block error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 offset-md-3">
                                                <a href="{{ route('enquiry') }}" class="btn btn-primary btn-sm">Cancel</a>
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
    <div class="modal fade bs-enquiry-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enquiry Detail</h5>
                    <button type="button" class="fn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fn-enquiry-data"></div>
                <div class="modal-footer">
                    <button type="button" class="fn-close btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function get_enquiry_modal(id) {
            $('.fn-enquiry-data').html(
                '<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="{{ url('/assets/images/loading.gif') }}" /></p>'
            );
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ url('/frontoffice/enquiry/view/') }}/" + id,

                success: function(response) {
                    if (response) {
                        $('.fn-enquiry-data').html(response);
                    }
                }
            });
        }
    </script>
@endsection

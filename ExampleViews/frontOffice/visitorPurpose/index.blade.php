@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3 class="head-title"><i class="fa fa-bars "></i><small>Manage Visitor Purposes</small></h3>
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
                        <form method="get" action="{{ route('purpose') }}" accept-charset="UTF-8" class="form-horizontal">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="item form-group">
                                    <input class="form-control col-md-7 col-xs-12 " name="filter" id="filter" value="{{ @$filter }}" placeholder="Search Visitor Purposes..." type="text">
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
                            <a href="{{ route('purpose') }}" class="nav-link <?php if (isset($list)) { echo 'active'; } ?>"><i class="fa fa-list "></i> List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purpose.add') }}" class="nav-link <?php if (isset($add)) { echo 'active'; } ?>"><i class="fa fa-plus "></i> Add</a>
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
                                                    <th>Purpose</th>
                                                    <th>Created</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @forelse($visitor_purposes as $obj)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $obj->purpose }}</td>
                                                        <td>{{ date('M d, Y', strtotime($obj->created_at))  }}</td>
                                                        <td>{{ $obj->status == 1 ? 'Active' : 'InActive' }}</td>
                                                        <td>
                                                            <a onclick="get_purpose_modal( {{ $obj->id }} );" data-toggle="modal" data-target=".bs-purpose-modal" class="btn btn-info btn-xs"><i class="fa fa-eye-slash"></i> View </a>
                                                            <a href="{{ route('purpose.edit', $obj->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> Edit </a>
                                                            <form action="{{ route('purpose.delete', $obj->id) }}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger btn-xs" onclick="javascript: return confirm('confirm_alert')"><i class="fa fa-trash-o"></i> Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <td colspan="5">There are no data found.</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>

                                        {!! $visitor_purposes->withQueryString()->links('pagination::bootstrap-5') !!}

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

                                    <form method="post" action="{{ route('purpose.save') }}" accept-charset="UTF-8" id="form-add">
                                        @csrf

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="purpose">Purpose <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="purpose" id="purpose" value="{{ old('purpose') }}" placeholder="Purpose" required="required" type="text">
                                                @error('purpose')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 offset-md-3">
                                                <a href="{{ route('purpose') }}" class="btn btn-primary btn-sm">Cancel</a>
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

                                    <form method="post" action="{{ route('purpose.update') }}" accept-charset="UTF-8" id="form-edit">
                                        @csrf
                                        <input type="hidden" value="{{ $visitor_purposes->id }}" name="id" />
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="purpose">Purpose <span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="purpose" id="purpose" value="{{ $visitor_purposes->purpose }}" placeholder="Purpose" required="required" type="text">
                                                @error('purpose')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="status">Status</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:6px;">
                                                 Active:
                                                <input type="radio" class="status" name="status" id="Active" value="1" @if($visitor_purposes->status == 1) checked="checked" @endif  />
                                                 In Active:
                                                <input type="radio" class="status" name="status" id="InActive" value="0" @if($visitor_purposes->status == 0) checked="checked" @endif />
                                            </div>
                                            @error('status')
                                                <div class="help-block error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 offset-md-3">
                                                <a href="{{ route('purpose') }}" class="btn btn-primary btn-sm">Cancel</a>
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
    <div class="modal fade bs-purpose-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Visitor Purpose Detail</h5>
                    <button type="button" class="fn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fn-purpose-data"></div>
                <div class="modal-footer">
                    <button type="button" class="fn-close btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function get_purpose_modal(id) {
            $('.fn-purpose-data').html(
                '<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="{{ url('/assets/images/loading.gif') }}" /></p>'
            );
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ url('/frontoffice/purpose/view/') }}/" + id,

                success: function(response) {
                    if (response) {
                        $('.fn-purpose-data').html(response);
                    }
                }
            });
        }
    </script>

    <script type="text/javascript">
        $().ready(function() {
            // $("#form-add").validate();
            // $("#form-edit").validate();
        });
    </script>

@endsection

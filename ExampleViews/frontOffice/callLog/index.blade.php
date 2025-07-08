@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3 class="head-title"><i class="fa fa-bars "></i><small>Manage Call Log</small></h3>
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
                        <form method="get" action="{{ route('call-log') }}" accept-charset="UTF-8" class="form-horizontal">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="item form-group">
                                    <input class="form-control col-md-7 col-xs-12 " name="filter" id="filter" value="{{ @$filter }}" placeholder="Search Call Log Info..." type="text">
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
                            <a href="{{ route('call-log') }}" class="nav-link <?php if (isset($list)) { echo 'active'; } ?>"><i class="fa fa-list "></i> List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('call-log.add') }}" class="nav-link <?php if (isset($add)) { echo 'active'; } ?>"><i class="fa fa-plus "></i> Add</a>
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
                                                    <th>Call Type</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Call Duration</th>
                                                    <th>Call Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($call_logs as $obj)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $obj->call_type }}</td>
                                                        <td>{{ $obj->name }}</td>
                                                        <td>{{ $obj->phone }}</td>
                                                        <td>{{ $obj->call_duration }}</td>
                                                        <td>{{ $obj->call_date }}</td>
                                                        <td>{{ $obj->status == 1 ? 'Active' : 'InActive' }}</td>
                                                        <td>
                                                            <a onclick="get_call_log_modal( {{ $obj->id }} );" data-toggle="modal" data-target=".bs-call-log-modal" class="btn btn-info btn-xs"><i class="fa fa-eye-slash"></i> View </a>
                                                            <a href="{{ route('call-log.edit', $obj->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> Edit </a>
                                                            <form action="{{ route('call-log.delete', $obj->id) }}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger btn-xs" onclick="javascript: return confirm('confirm_alert')"><i class="fa fa-trash-o"></i> Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8">There are no data found.</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>

                                        {!! $call_logs->withQueryString()->links('pagination::bootstrap-5') !!}

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
                                    <form method="post" action="{{ route('call-log.save') }}" accept-charset="UTF-8" id="form-add">
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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="call_duration">Call Duration<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="call_duration" id="call_duration" value="{{ old('call_duration') }}" placeholder="Call Duration" required="required" type="text">
                                                @error('call_duration')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="call_date">Call Date<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="call_date" id="call_date" value="{{ old('call_date') }}" placeholder="Call Date" required="required" type="date">
                                                @error('call_date')
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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="call_type">Call Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:6px;">
                                                Incoming:
                                                <input type="radio" class="call_type" name="call_type" id="Incoming" value="Incoming" @if( old('call_type') == 'Incoming'||old('call_type') == '') checked="checked" @endif  />
                                                Outgoing:
                                                <input type="radio" class="call_type" name="call_type" id="Outgoing" value="Outgoing" @if( old('call_type') == 'Outgoing') checked="checked" @endif />
                                            </div>
                                            @error('call_type')
                                                <div class="help-block error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note">Note</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control col-md-7 col-xs-12 " name="note" id="note" placeholder="Note" rows="4">{{ old('note') }}</textarea>
                                                @error('note')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 offset-md-3">
                                                <a href="{{ route('call-log') }}" class="btn btn-primary btn-sm">Cancel</a>
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

                                    <form method="post" action="{{ route('call-log.update') }}" accept-charset="UTF-8" id="form-edit">
                                        @csrf
                                        <input type="hidden" value="{{ $call_log->id }}" name="id" />
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="name" id="name" value="{{ $call_log->name }}" placeholder="Name" required="required" type="text">
                                                @error('name')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="phone" id="phone" value="{{ $call_log->phone }}" placeholder="Phone" required="required" type="text">
                                                @error('phone')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="call_duration">Call Duration<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="call_duration" id="call_duration" value="{{ $call_log->call_duration }}" placeholder="Call Duration" required="required" type="text">
                                                @error('call_duration')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="call_date">Call Date<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="call_date" id="call_date" value="{{ $call_log->call_date }}" placeholder="Call Date" required="required" type="date">
                                                @error('call_date')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="follow_up_date">Follow Up</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="follow_up_date" id="follow_up_date" value="{{ $call_log->follow_up_date }}" placeholder="Follow Up" type="date">
                                                @error('follow_up_date')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="call_type">Call Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:6px;">
                                                Incoming:
                                                <input type="radio" class="call_type" name="call_type" id="Incoming" value="Incoming" @if( $call_log->call_type == 'Incoming') checked="checked" @endif  />
                                                Outgoing:
                                                <input type="radio" class="call_type" name="call_type" id="Outgoing" value="Outgoing" @if( $call_log->call_type == 'Outgoing') checked="checked" @endif />
                                            </div>
                                            @error('call_type')
                                                <div class="help-block error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note">Note</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control col-md-7 col-xs-12 " name="note" id="note" placeholder="Note" rows="4">{{ $call_log->note }}</textarea>
                                                @error('note')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="status">Status</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:6px;">
                                                 Active:
                                                <input type="radio" class="status" name="status" id="Active" value="1" @if($call_log->status == 1) checked="checked" @endif  />
                                                 In Active:
                                                <input type="radio" class="status" name="status" id="InActive" value="0" @if($call_log->status == 0) checked="checked" @endif />
                                            </div>
                                            @error('status')
                                                <div class="help-block error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 offset-md-3">
                                                <a href="{{ route('call-log') }}" class="btn btn-primary btn-sm">Cancel</a>
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
    <div class="modal fade bs-call-log-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Call Log Detail</h5>
                    <button type="button" class="fn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fn-call-log-data"></div>
                <div class="modal-footer">
                    <button type="button" class="fn-close btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function get_call_log_modal(id) {
            $('.fn-call-log-data').html(
                '<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="{{ url('/assets/images/loading.gif') }}" /></p>'
            );
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ url('/frontoffice/call-log/view/') }}/" + id,

                success: function(response) {
                    if (response) {
                        $('.fn-call-log-data').html(response);
                    }
                }
            });
        }
    </script>
@endsection

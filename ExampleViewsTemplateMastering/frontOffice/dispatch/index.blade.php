@extends('layouts.default')
@section('content')
    <style>
        #attachment {
            opacity: unset;
            font-size: unset;
        }
        .disabled-link {
            color: #999;
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3 class="head-title"><i class="fa fa-bars "></i><small>Manage Postal Dispatch</small></h3>
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
                        <form method="get" action="{{ route('dispatch') }}" accept-charset="UTF-8" class="form-horizontal">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="item form-group">
                                    <input class="form-control col-md-7 col-xs-12 " name="filter" id="filter" value="{{ @$filter }}" placeholder="Search Dispatch Info..." type="text">
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
                            <a href="{{ route('dispatch') }}" class="nav-link <?php if (isset($list)) { echo 'active'; } ?>"><i class="fa fa-list "></i> List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dispatch.add') }}" class="nav-link <?php if (isset($add)) { echo 'active'; } ?>"><i class="fa fa-plus "></i> Add</a>
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
                                                    <th>To Title</th>
                                                    <th>Reference</th>
                                                    <th>From Title</th>
                                                    <th>Dispatch Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($dispatchs as $obj)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $obj->to_title }}</td>
                                                        <td>{{ $obj->reference }}</td>
                                                        <td>{{ $obj->from_title }}</td>
                                                        <td>{{ $obj->dispatch_date }}</td>
                                                        <td>{{ $obj->status == 1 ? 'Active' : 'InActive' }}</td>
                                                        <td>
                                                            <a href="{{ route('dispatch.edit', $obj->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o"></i> Edit </a>
                                                            <a onclick="get_dispatch_modal( {{ $obj->id }} );" data-toggle="modal" data-target=".bs-dispatch-modal" class="btn btn-dark btn-xs"><i class="fa fa-eye-slash"></i> View </a>
                                                            @if ($obj->attachment)
                                                                <a href="{{ route('dispatch.download', $obj->id) }}" class="btn btn-dark btn-xs"><i class="fa fa-download"></i> Download</a>
                                                            @else
                                                                <a href="#" class="btn btn-dark btn-xs disabled-link" disabled><i class="fa fa-download"></i> Download</a>
                                                            @endif
                                                            <form action="{{ route('dispatch.delete', $obj->id) }}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger btn-xs" onclick="javascript: return confirm('confirm_alert')"><i class="fa fa-trash-o"></i> Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7">There are no data found.</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>

                                        {!! $dispatchs->withQueryString()->links('pagination::bootstrap-5') !!}

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
                                    <form method="post" action="{{ route('dispatch.save') }}" accept-charset="UTF-8" id="form-add" enctype="multipart/form-data">
                                        @csrf
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="to_title">To Title<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="to_title" id="to_title" value="{{ old('to_title') }}" placeholder="To Title" required="required" type="text">
                                                @error('to_title')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reference">Reference</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="reference" id="reference" value="{{ old('reference') }}" placeholder="Reference" type="text">
                                                @error('reference')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="address" id="address" value="{{ old('address') }}" placeholder="Address" required="required" type="text">
                                                @error('address')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_title">From Title<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="from_title" id="from_title" value="{{ old('from_title') }}" placeholder="From Title" required="required" type="text">
                                                @error('from_title')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dispatch_date">Dispatch Date<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="dispatch_date" id="dispatch_date" value="{{ old('dispatch_date') }}" placeholder="Dispatch Date" type="date">
                                                @error('dispatch_date')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
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
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attachment">Attachment</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="col-md-7 col-xs-12" name="attachment" id="attachment" value="{{ old('attachment') }}" placeholder="Attachment" type="file">
                                                @error('attachment')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 offset-md-3">
                                                <a href="{{ route('dispatch') }}" class="btn btn-primary btn-sm">Cancel</a>
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

                                    <form method="post" action="{{ route('dispatch.update') }}" accept-charset="UTF-8" id="form-edit" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $dispatch->id }}" name="id" />

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="to_title">To Title<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="to_title" id="to_title" value="{{ $dispatch->to_title }}" placeholder="To Title" required="required" type="text">
                                                @error('to_title')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reference">Reference</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="reference" id="reference" value="{{ $dispatch->reference }}" placeholder="Reference" type="text">
                                                @error('reference')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="address" id="address" value="{{ $dispatch->address }}" placeholder="Address" required="required" type="text">
                                                @error('address')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="from_title">From Title<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="from_title" id="from_title" value="{{ $dispatch->from_title }}" placeholder="From Title" required="required" type="text">
                                                @error('from_title')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dispatch_date">Dispatch Date<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control col-md-7 col-xs-12 " name="dispatch_date" id="dispatch_date" value="{{ $dispatch->dispatch_date }}" placeholder="Dispatch Date" type="date">
                                                @error('dispatch_date')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="note">Note</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea class="form-control col-md-7 col-xs-12 " name="note" id="note" placeholder="Note" rows="4">{{ $dispatch->note }}</textarea>
                                                @error('note')
                                                    <div class="help-block error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attachment">Attachment</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                @php
                                                    $fileName = str_replace("/storage/FrontOffice/PostalDispatch/", "", $dispatch->attachment);
                                                    $pattern = '/^\d{4}_\d{2}_\d{2}_/';
                                                    $fileName = preg_replace($pattern, '', $fileName);
                                                @endphp
                                                <a href="{{ asset($dispatch->attachment) }}" target="_blank">{{$fileName}}</a>
                                                <br>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input class="col-md-7 col-xs-12" name="attachment" id="attachment" value="{{ $dispatch->attachment }}" placeholder="Attachment" type="file">
                                                    @error('attachment')
                                                        <div class="help-block error">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="status">Status</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:6px;">
                                                 Active:
                                                <input type="radio" class="status" name="status" id="Active" value="1" @if($dispatch->status == 1) checked="checked" @endif  />
                                                 In Active:
                                                <input type="radio" class="status" name="status" id="InActive" value="0" @if($dispatch->status == 0) checked="checked" @endif />
                                            </div>
                                            @error('status')
                                                <div class="help-block error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 offset-md-3">
                                                <a href="{{ route('dispatch') }}" class="btn btn-primary btn-sm">Cancel</a>
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
    <div class="modal fade bs-dispatch-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Postal Dispatch Detail</h5>
                    <button type="button" class="fn-close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fn-dispatch-data"></div>
                <div class="modal-footer">
                    <button type="button" class="fn-close btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function get_dispatch_modal(id) {
            $('.fn-dispatch-data').html(
                '<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="{{ url('/assets/images/loading.gif') }}" /></p>'
            );
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ url('/frontoffice/dispatch/view/') }}/" + id,

                success: function(response) {
                    if (response) {
                        $('.fn-dispatch-data').html(response);
                    }
                }
            });
        }
    </script>
@endsection

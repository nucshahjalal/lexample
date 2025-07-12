<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="30%">To Title</th>
            <td>{{ $dispatch->to_title }}</td>
        </tr>
        <tr>
            <th width="30%">Reference</th>
            <td>{{ $dispatch->reference }}</td>
        </tr>
        <tr>
            <th width="30%">Address</th>
            <td>{{ $dispatch->address }}</td>
        </tr>
        <tr>
            <th width="30%">From Title</th>
            <td>{{ $dispatch->from_title }}</td>
        </tr>
        <tr>
            <th width="30%">Dispatch Date</th>
            <td>{{ $dispatch->dispatch_date ? date('M d, Y', strtotime($dispatch->dispatch_date)) : null }}</td>
        </tr>
        <tr>
            <th width="30%">Note</th>
            <td>{{ $dispatch->note }}</td>
        </tr>
        <tr>
            <th width="30%">Attachment</th>
            <td><a href="{{ route('dispatch.download', $dispatch->id) }}" class="btn btn-dark btn-xs"><i class="fa fa-download"></i> Download</a></td>
        </tr>
        <tr>
            <th width="30%">Status</th>
            <td>{{ $dispatch->status ? 'Active' : 'InActive' }}</td>
        </tr>
    </tbody>
</table>

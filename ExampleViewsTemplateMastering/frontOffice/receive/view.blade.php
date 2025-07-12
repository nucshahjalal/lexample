<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="30%">To Title</th>
            <td>{{ $receive->to_title }}</td>
        </tr>
        <tr>
            <th width="30%">Reference</th>
            <td>{{ $receive->reference }}</td>
        </tr>
        <tr>
            <th width="30%">Address</th>
            <td>{{ $receive->address }}</td>
        </tr>
        <tr>
            <th width="30%">From Title</th>
            <td>{{ $receive->from_title }}</td>
        </tr>
        <tr>
            <th width="30%">receive Date</th>
            <td>{{ $receive->receive_date ? date('M d, Y', strtotime($receive->receive_date)) : null }}</td>
        </tr>
        <tr>
            <th width="30%">Note</th>
            <td>{{ $receive->note }}</td>
        </tr>
        <tr>
            <th width="30%">Attachment</th>
            <td><a href="{{ route('postal-receive.download', $receive->id) }}" class="btn btn-dark btn-xs"><i class="fa fa-download"></i> Download</a></td>
        </tr>
        <tr>
            <th width="30%">Status</th>
            <td>{{ $receive->status ? 'Active' : 'InActive' }}</td>
        </tr>
    </tbody>
</table>

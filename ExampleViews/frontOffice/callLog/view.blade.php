<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="30%">Call Type</th>
            <td>{{ $call_log->call_type }}</td>
        </tr>
        <tr>
            <th width="30%">Name</th>
            <td>{{ $call_log->name }}</td>
        </tr>
        <tr>
            <th width="30%">Phone</th>
            <td>{{ $call_log->phone }}</td>
        </tr>
        <tr>
            <th width="30%">Call Duration</th>
            <td>{{ $call_log->call_duration }}</td>
        </tr>
        <tr>
            <th width="30%">Call Date</th>
            <td>{{ $call_log->call_date }}</td>
        </tr>
        <tr>
            <th width="30%">Follow Up</th>
            <td>{{ $call_log->follow_up_date }}</td>
        </tr>
        <tr>
            <th width="30%">Note</th>
            <td>{{ $call_log->note }}</td>
        </tr>
        <tr>
            <th width="30%">Status</th>
            <td>{{ $call_log->status ? 'Active' : 'InActive' }}</td>
        </tr>
        <tr>
            <th width="30%">Created At</th>
            <td>{{ $call_log->created_at }}</td>
        </tr>
        <tr>
            <th width="30%">Updated At</th>
            <td>{{ $call_log->updated_at }}</td>
        </tr>
    </tbody>
</table>

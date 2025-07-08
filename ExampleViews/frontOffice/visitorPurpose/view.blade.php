<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="30%">Purpose</th>
            <td>{{ $visitor_purpose->purpose }}</td>
        </tr>        
        <tr>
            <th width="30%">Status</th>
            <td>{{ $visitor_purpose->status ? 'Active' : 'InActive' }}</td>
        </tr>
        <tr>
            <th width="30%">Created At</th>
            <td>{{ $visitor_purpose->created_at }}</td>
        </tr>
        <tr>
            <th width="30%">Updated At</th>
            <td>{{ $visitor_purpose->updated_at }}</td>
        </tr>
    </tbody>
</table>

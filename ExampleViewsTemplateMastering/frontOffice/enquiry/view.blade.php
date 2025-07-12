<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="30%">Call Type</th>
            <td>{{ $enquiry->call_type }}</td>
        </tr>
        <tr>
            <th width="30%">Name</th>
            <td>{{ $enquiry->name }}</td>
        </tr>
        <tr>
            <th width="30%">Phone</th>
            <td>{{ $enquiry->phone }}</td>
        </tr>
        <tr>
            <th width="30%">Email</th>
            <td>{{ $enquiry->email }}</td>
        </tr>
        <tr>
            <th width="30%">Address</th>
            <td>{{ $enquiry->address }}</td>
        </tr>
        <tr>
            <th width="30%">Description</th>
            <td>{{ $enquiry->description }}</td>
        </tr>
        <tr>
            <th width="30%">Date</th>
            <td>{{ $enquiry->date }}</td>
        </tr>
        <tr>
            <th width="30%">Follow UP</th>
            <td>{{ $enquiry->follow_up_date }}</td>
        </tr>
        <tr>
            <th width="30%">Source</th>
            <td>{{ $enquiry->source }}</td>
        </tr>
        <tr>
            <th width="30%">Reference</th>
            <td>{{ $enquiry->reference }}</td>
        </tr>
        <tr>
            <th width="30%">Assigned To</th>
            <td>{{ $enquiry->assigned_to }}</td>
        </tr>
        <tr>
            <th width="30%">Class</th>
            <td>{{ $enquiry->class }}</td>
        </tr>
        <tr>
            <th width="30%">No Of Child</th>
            <td>{{ $enquiry->no_of_child }}</td>
        </tr>
        <tr>
            <th width="30%">Status</th>
            <td>{{ $enquiry->status ? 'Active' : 'InActive' }}</td>
        </tr>
        <tr>
            <th width="30%">Created At</th>
            <td>{{ $enquiry->created_at }}</td>
        </tr>
        <tr>
            <th width="30%">Updated At</th>
            <td>{{ $enquiry->updated_at }}</td>
        </tr>
    </tbody>
</table>

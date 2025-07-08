<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="30%">Source</th>
            <td>{{ $enquiry_source->source }}</td>
        </tr>        
        <tr>
            <th width="30%">Note</th>
            <td>{{ $enquiry_source->note }}</td>
        </tr>
        <tr>
            <th width="30%">Status</th>
            <td>{{ $enquiry_source->status ? 'Active' : 'InActive' }}</td>
        </tr>
        <tr>
            <th width="30%">Created At</th>
            <td>{{ $enquiry_source->created_at }}</td>
        </tr>
        <tr>
            <th width="30%">Updated At</th>
            <td>{{ $enquiry_source->updated_at }}</td>
        </tr>
    </tbody>
</table>

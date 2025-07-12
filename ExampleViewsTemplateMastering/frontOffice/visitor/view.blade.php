<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="30%">Academic Year</th>
            <td>{{ $visitor->academic_year->session_year }}</td>
        </tr>
        <tr>
            <th width="30%">Role</th>
            <td>{{ $visitor->role->name }}</td>
        </tr>
        <tr>
            <th width="30%">User</th>
            <td>{{ $visitor->user->username }}</td>
        </tr>
        <tr>
            <th width="30%">Purpose</th>
            <td>{{ $visitor->purpose->purpose }}</td>
        </tr>
        <tr>
            <th width="30%">Name</th>
            <td>{{ $visitor->name }}</td>
        </tr>
        <tr>
            <th width="30%">Phone</th>
            <td>{{ $visitor->phone }}</td>
        </tr>
        <tr>
            <th width="30%">No Of People</th>
            <td>{{ $visitor->no_of_people }}</td>
        </tr>
        <tr>
            <th width="30%">Check In</th>
            <td>{{ $visitor->check_in }}</td>
        </tr>
        <tr>
            <th width="30%">Check Out</th>
            <td>{{ $visitor->check_out }}</td>
        </tr>
        <tr>
            <th width="30%">Note</th>
            <td>{{ $visitor->note }}</td>
        </tr>
        <tr>
            <th width="30%">Status</th>
            <td>{{ $visitor->status ? 'Active' : 'InActive' }}</td>
        </tr>
        <tr>
            <th width="30%">Created At</th>
            <td>{{ $visitor->created_at }}</td>
        </tr>
        <tr>
            <th width="30%">Updated At</th>
            <td>{{ $visitor->updated_at }}</td>
        </tr>
    </tbody>
</table>

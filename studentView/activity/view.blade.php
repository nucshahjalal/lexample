<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th width="30%"> Session Year</th>
            <td>{{ $activity->session_year }}</td>
        </tr>
        <tr>
            <th width="30%">Student</th>
            <td>{{ $activity->first_name . ' ' . $activity->middle_name .' ' . $activity->last_name}}</td>
        </tr>
        <tr>
            <th width="30%">Class</th>
            <td>{{ $activity->class_name }}</td>
        </tr>
        <tr>
            <th width="30%">Section</th>
            <td>{{ $activity->section_name }}</td>
        </tr>
        <tr>
            <th width="30%">Date</th>
            <td>{{ date('d-m-Y', strtotime($activity->activity_date)) }}</td>
        </tr>
        <tr>
            <th width="30%">Activity</th>
            <td>{{ $activity->activity }}</td>
        </tr>
        <tr>
            <th width="30%">Status</th>
            <td>{{ $activity->status ? 'Active' : 'InActive' }}</td>
        </tr>
    </tbody>
</table>
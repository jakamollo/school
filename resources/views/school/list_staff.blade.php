<table class="student_tbl">
    <th>List of Staff</th>
    <tr class="student_tbl_rw_menu">
        <td class="std_tbl_data">First Name</td>
        <td class="std_tbl_data">Last Name</td>
        <td class="std_tbl_data">Type</td>
        <td class="std_tbl_data">Age</td>
        <td class="std_tbl_data">Gender</td>
        <td class="std_tbl_data">Mgnt Level</td>
        <td class="std_tbl_data">Professional Qualifications</td>
    </tr>
    @if(isset($staff))
        @forelse($staff as $member)
            <tr class="student_tbl_rw_data hide_student {{ $member->type }} {{ $member->gender }}">
                <td class="std_tbl_data">{{ $member->first_name }}</td>
                <td class="std_tbl_data">{{ $member->last_name }}</td>
                <td class="std_tbl_data">{{ $member->type }}</td>
                <td class="std_tbl_data">{{ $member->age }}</td>
                <td class="std_tbl_data">{{ $member->gender }}</td>
                <td class="std_tbl_data">{{ $member->management_level }}</td>
                <td class="std_tbl_data">{{ $member->professional_qualifications }}</td>
            </tr>
        @empty
            <div class="alert-no-post">
                No staff found
            </div>
        @endforelse
    @else
        <div class="alert-no-post">
            No staff found
        </div>
    @endif
</table>
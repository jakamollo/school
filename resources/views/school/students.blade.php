<div class="std_data_filter">
    <select name="form_filter" id="form-filter">
        <option value="select">Select form</option>
        <option value="1">Form 1</option>
        <option value="2">Form 2</option>
        <option value="3">Form 3</option>
        <option value="4">Form 4</option>
    </select>
    <select name="combined_filter" id="combined-filter">
        <option value="select">Select option</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="first_name">First Name</option>
    </select>
</div>
<table class="student_tbl">
    <th>List of Students</th>
    <tr class="student_tbl_rw_menu">
        <td class="std_tbl_data">First Name</td>
        <td class="std_tbl_data">Last Name</td>
        <td class="std_tbl_data">Form</td>
        <td class="std_tbl_data">Age</td>
        <td class="std_tbl_data">Gender</td>
        <td class="std_tbl_data">Date of Admission</td>
    </tr>
    @if(isset($students))
        @forelse($students as $student)
    <tr class="student_tbl_rw_data hide_student {{ $student->form }} {{ $student->gender }}">
        <td class="std_tbl_data">{{ $student->first_name }}</td>
        <td class="std_tbl_data">{{ $student->last_name }}</td>
        <td class="std_tbl_data">{{ $student->form }}</td>
        <td class="std_tbl_data">{{ $student->age }}</td>
        <td class="std_tbl_data">{{ $student->gender }}</td>
        <td class="std_tbl_data">{{ $student->admission_date }}</td>
    </tr>
        @empty
            <div class="alert-no-post">
                No student found
            </div>
        @endforelse
        @else
        <div class="alert-no-post">
            No student found
        </div>
    @endif
</table>
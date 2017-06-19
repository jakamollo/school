<div class="nav-div">
    <ul class="nav-ul">
        <li class="home-menu"><a href="{{ action('HomeController@homepage') }}">Home</a></li>
        @if(isset(Auth::user()->school_id))
        <li class="classroom-menu"><a href="">Classroom</a></li>
        <li class="student-menu"><a href="">Students</a></li>
        <li class="staff-menu"><a href="">Staff</a></li>

        <li class="school-menu"><a href="{{ action('SchoolController@get_home', Auth::user()->school_id ) }}">School</a>
            <ul>
                <li><a href="">Notice Board</a></li>
            </ul>
        </li>

        <li class="dashboard-menu"><a href="{{ action('UserController@get_dashboard') }}">Dashboad</a></li>
        <li><a href="">Exam</a>
            <ul>
                <li><a href="">Exam Entry</a></li>
            </ul>
        </li>
        <li class="reports-menu"><a href="">Reports</a></li>
        @endif
        <div class="top_right_user_photo">
            <a href="{{ action('UserController@get_profile', ['id' => Auth::user()->id ]) }}">
                <img class="image-circle" src="@if(isset(Auth::user()->photo)){{Auth::user()->photo}} @else /images/man-face.jpg @endif"  height="35x" width="35px">
            </a>

        </div>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    </ul>

</div>
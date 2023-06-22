<!-- Sidebar-->
<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">Start Bootstrap</div>
    <div class="list-group list-group-flush">
        {{-- User / patient --}}
        {{-- @if ($user->role_id == 1) --}}
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Doctors</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Patients</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Appointment
                History</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Reports</a>
        {{-- @endif --}}
        {{-- @if ($user->role_id == 2) --}}
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Dashboard</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Patients</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Appointment
                History</a>
        {{-- @endif --}}
        {{-- @if ($user->role_id == 3) --}}
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Book Appointment</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Medical History</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Appointment
                History</a>
        {{-- @endif --}}
    </div>
</div>

<link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ public_path('css/dashboard.css') }}" rel="stylesheet">

<style>
    .patient-table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid black;
        margin-top: 20px;
    }

    .patient-header {
        border: 1px solid black;
        padding: 5px;
        color: #6c757d;
    }

    .patient-data {
        border: 1px solid black;
        padding: 5px;
    }

    .patient-image {
        padding-left: 60px;
        vertical-align: middle;
    }

    .patient-image img {
        max-width: 150px;
        max-height: 200px;
    }

    .patient-cell {
        border: 1px solid black;
        padding: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div style="margin-top: 20px; margin-bottom: 50px;">
    <div style="display: flex; flex-direction: row;">
        <div style="margin-top: 20px; margin-bottom: 0;">
            <table class="patient-table">
                <thead>
                    <tr>
                        <th colspan="4" style="text-align: center; font-size: 1.25rem; color: #6c757d;">Patient Info</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="7" class="patient-image">
                            <img src="{{ public_path($report->image) }}" alt="">
                        </td>
                        <th class="patient-header">Patient Name</th>
                        <td class="patient-data">{{ $report->user->name }}</td>
                    </tr>
                    <tr>
                        <th class="patient-header">Patient Mobile Number</th>
                        <td class="patient-data">{{ $report->contact_no }}</td>
                    </tr>
                    <tr>
                        <th class="patient-header">Patient Gender</th>
                        <td class="patient-data">{{ $report->gender }}</td>
                    </tr>
                    <tr>
                        <th class="patient-header">Patient Email</th>
                        <td class="patient-data">{{ $report->user->email }}</td>
                    </tr>
                    <tr>
                        <th class="patient-header">Patient Address</th>
                        <td class="patient-data">{{ $report->address }}</td>
                    </tr>
                    <tr>
                        <th class="patient-header">Patient Age</th>
                        <td class="patient-data">{{ $report->age }}</td>
                    </tr>
                    <tr>
                        <th class="patient-header">Patient Reg Date</th>
                        <td class="patient-data">{{ $report->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<table style="width: 100%; border-collapse: collapse; margin-top: 40px;">
    <thead>
        <tr>
            <th colspan="6" style="text-align: center; font-size: 1.25rem; color: #6c757d;">Medical History</th>
        </tr>
        <tr class="patient-header">
            <th>Blood Pressure</th>
            <th>Weight</th>
            <th>Blood Sugar</th>
            <th>Body Temperature</th>
            <th>Medical Prescription</th>
            <th>Visit Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($medicalHistory as $medical_history)
            <tr>
                <td class="patient-cell">{{ $medical_history->blood_pressure }}</td>
                <td class="patient-cell">{{ $medical_history->weight }}</td>
                <td class="patient-cell">{{ $medical_history->blood_sugar }}</td>
                <td class="patient-cell">{{ $medical_history->temperature }}</td>
                <td class="patient-cell">{{ $medical_history->treatment }}</td>
                <td class="patient-cell">{{ $medical_history->admission_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ public_path('css/dashboard.css') }}" rel="stylesheet">

<div style="margin-top: 20px; margin-bottom: 50px;">
    <div style="display: flex; flex-direction: row;">
        <div style="margin-top: 20px; margin-bottom: 0;">
            <table style="border-collapse: collapse; width: 100%;" border="1">
                <thead style="border: 1px solid black; padding:5px">
                    <tr >
                        <th colspan="4" style="text-align: center; font-size: 1.25rem; color: #6c757d;">Patient Info</th>
                    </tr>
                </thead>
                <tbody style="border: 1px solid black; padding:5px">
                    <tr >
                        <td rowspan="8" style="padding-left:60px;"> <img src="{{ public_path($report->image) }}" alt=""
                            style="width: 170px; height: 170px;" ></td>
                        <th style="border: 1px solid black; padding:5px; color: #6c757d;">Patient Name</th>
                        <td style="border: 1px solid black; padding:5px">{{ $report->user->name }}</td>
                    </tr>
                    <tr >
                        <th style="border: 1px solid black; padding:5px; color: #6c757d;">Patient Mobile Number</th>
                        <td style="border: 1px solid black; padding:5px">{{ $report->contact_no }}</td>
                    </tr>
                    <tr >
                        <th style="border: 1px solid black; padding:5px; color: #6c757d;">Patient Gender</th>
                        <td style="border: 1px solid black; padding:5px">{{ $report->gender }}</td>

                    </tr>
                    <tr >
                        <th style="border: 1px solid black; padding:5px; color: #6c757d;">Patient Email</th>
                        <td style="border: 1px solid black; padding:5px">{{ $report->user->email }}</td>
                    </tr>
                    <tr >
                        <th style="border: 1px solid black; padding:5px; color: #6c757d;">Patient Address</th>
                        <td style="border: 1px solid black; padding:5px">{{ $report->address }}</td>
                    </tr>
                    <tr >
                        <th style="border: 1px solid black; padding:5px; color: #6c757d;">Patient Age</th>
                        <td style="border: 1px solid black; padding:5px">{{ $report->age }}</td>
                    </tr>
                    <tr >
                        <th style="border: 1px solid black; padding:5px; color: #6c757d;">Patient Reg Date</th>
                        <td style="border: 1px solid black; padding:5px">{{ $report->created_at }}</td>
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
    </thead>
    <tbody>
        <tr style="border: 1px solid black; padding:5px; color: #6c757d;">
            <th style="border: 1px solid black; padding:5px">Blood Pressure</th>
            <th style="border: 1px solid black; padding:5px">Weight</th>
            <th style="border: 1px solid black; padding:5px">Blood Sugar</th>
            <th style="border: 1px solid black; padding:5px">Body Temperature</th>
            <th style="border: 1px solid black; padding:5px">Medical Prescription</th>
            <th style="border: 1px solid black; padding:5px">Visit Date</th>
        </tr>
        {{-- <th>{{ $report->email }}</td> --}}
        {{-- @php
        $medical_histories = App\Models\MedicalHistory::where('patient_id', $report->id)->where('doctor_id', Auth::user()->id )->get();
        @endphp --}}

        @foreach ($medicalHistory as $medical_history)
            <tr>
                <td style="border: 1px solid black; padding:5px">{{ $medical_history->blood_pressure }}</td>
                <td style="border: 1px solid black; padding:5px">{{ $medical_history->weight }}</td>
                <td style="border: 1px solid black; padding:5px">{{ $medical_history->blood_sugar }}</td>
                <td style="border: 1px solid black; padding:5px">{{ $medical_history->temperature }}</td>
                <td style="border: 1px solid black; padding:5px">{{ $medical_history->treatment }}</td>
                <td style="border: 1px solid black; padding:5px">{{ $medical_history->admission_date }}</td>
            </tr>
        @endforeach
    </tbody>

</table>

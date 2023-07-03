<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalHistory;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function getAppointments(){
        $appointments = Appointment::with('doctor', 'patient')->get();
            return view('appointment_history', compact('appointments'));
    }

    public function showReportForm(Request $request)
    {
        return view('reports-form');
    }

    public function getReports(Request $request)
    {
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        // Convert the date format to match Carbon's expected format

        $reports = Patient::whereBetween('created_at', [$fromDate, $toDate])->get();
        return view('reports', compact('reports'));
    }

    public function getSingleReport($patientId)
    {
        $report = Patient::findOrFail($patientId);
        $medicalHistory = MedicalHistory::where('patient_id',$patientId)->get();

        return view('single_report', compact('report','medicalHistory'));
    }

    public function downloadPDF($patientId)
    {
        // Fetch the data for the report
        $report = Patient::findOrFail($patientId);
        $medicalHistory = MedicalHistory::where('patient_id', $patientId)->get();
        $pdf = PDF::loadView('single_report_pdf', compact('report','medicalHistory'));
        // $pdf = PDF::loadView('admin.user');
        ob_clean();
        return $pdf->download('reports.pdf');
    }

}

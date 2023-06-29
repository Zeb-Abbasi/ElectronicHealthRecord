<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalHistory;
use App\Models\Patient;
use Illuminate\Http\Request;
use PDF;
use Dompdf\Options;

class DashboardController extends Controller
{
    public function index(){
        // if (checkGuard('admin') || checkGuard('doctor') || checkGuard('patient')) {
        //     return view('dashboard');
        // } else {
        //     return redirect('/');
        // }
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
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;

        $reports = Patient::whereBetween('created_at', [$fromDate, $toDate])->get();

        return view('reports', compact('reports'));
    }

    public function getSingleReport($patientId)
    {
        $report = Patient::findOrFail($patientId);
        $medicalHistory = MedicalHistory::where('patient_id',$patientId)->first();

        return view('single_report', compact('report','medicalHistory'));
    }

        // public function downloadPDF($patientId)
        // {
        //     $report = Patient::findOrFail($patientId);

        //     $options = new Options();
        //     $options->set('isHtml5ParserEnabled', true);
        //     // Add more custom options if needed

        //     $pdf = PDF::loadView('admin.pdf_report', compact('report'), [], $options);

        //     return $pdf->download('report.pdf');
        // }
}

<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalHistory;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Dompdf\Options;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Support\Facades\App;

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

        // public function downloadPDF($patientId)
        // {
        //     $report = Patient::findOrFail($patientId);

        //     $options = new Options();
        //     $options->set('isHtml5ParserEnabled', true);
        //     // Add more custom options if needed

        //     $pdf = PDF::loadView('admin.pdf_report', compact('report'), [], $options);

        //     return $pdf->download('report.pdf');
        // }

    //     public function downloadPDF($patientId)
    // {
    //     // Fetch the data for the report
    //     $report = Patient::findOrFail($patientId);
    //     $medicalHistory = MedicalHistory::where('patient_id', $patientId)->get();

    //     // Pass the data to the view
    //     $data = [
    //         'report' => $report,
    //         'medicalHistory' => $medicalHistory,
    //     ];

    //     // Render the view
    //     $pdfContent = view('single_report', $data)->render();

    //     // Instantiate Dompdf
    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml($pdfContent);

    //     // (Optional) Set paper size and orientation
    //     $dompdf->setPaper('A4', 'portrait');

    //     // Render the HTML as PDF
    //     $dompdf->render();

    //     // Generate PDF filename
    //     $filename = 'document.pdf';

    //     // Download the PDF file
    //     return $dompdf->stream($filename);
    // }

    public function downloadPDF($patientId)
    {
        // Fetch the data for the report
        $report = Patient::findOrFail($patientId);
        $medicalHistory = MedicalHistory::where('patient_id', $patientId)->get();

        // Pass the data to the view
        $data = [
            'report' => $report,
            'medicalHistory' => $medicalHistory,
        ];

        $pdf = App::make('dompdf.wrapper');
       $pdf->loadView('single_report',$data);
       return $pdf->download('report.pdf');
    }

}

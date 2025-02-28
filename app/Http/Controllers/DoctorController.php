<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return view('sections.doctors');
    }
    
}

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DoctorsController extends Controller
{
    public function receivedReports()
    {
        $doctorName = Auth::user()->name; // Assuming the doctor is logged in
        $directory = public_path('reports/' . $doctorName);

        // Get all files in the doctor's directory
        $files = [];
        if (file_exists($directory)) {
            $files = array_diff(scandir($directory), ['..', '.']);
        }

        return view('doctor.reports', compact('files'));
    }
}




 function showDoctorReports()
{
    // Fetch the doctor profile linked to the logged-in user
    $doctor = auth()->user()->doctors;

    // Check if a doctor profile exists
    if (!$doctor) {
        return redirect()->back()->with('error', 'No doctor profile found for the user.');
    }

    // Define the directory for reports (e.g., "storage/reports/DoctorName")
    $reportsDirectory = storage_path('app/public/reports/' . $doctor->name);

    // Check if the directory exists and get the file names
    $files = is_dir($reportsDirectory) ? array_diff(scandir($reportsDirectory), ['.', '..']) : [];

    // Pass the doctor name and files to the view
    return view('sections.doctors', [
        'files' => $files,         // List of files
        'doctorName' => $doctor->name, // Doctor's name
    ]);
}




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report; // Your Report model
 function showReports($doctor)
{
    // Simulate files associated with doctors
    $files = [
        'Dr. Khalid' => ['cali cabdi'], // Example file
        'Dr. Saed' => [],              // No files for Dr. Saed
    ];

    // Check if the doctor exists in the $files array
    if (!array_key_exists($doctor, $files)) {
        return abort(404, "Doctor not found");
    }

    // Get files for the requested doctor
    $doctorFiles = $files[$doctor];

    // Generate URLs for the files
    $fileUrls = array_map(function ($file) {
        return asset('storage/reports/' . $file);
    }, $doctorFiles);

    // Pass the doctor and file URLs to the view
    return view('doctors.reports', [
        'doctor' => $doctor,
        'fileUrls' => $fileUrls,
    ]);
}

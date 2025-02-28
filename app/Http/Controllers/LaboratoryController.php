<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index()
    {
        // Return the laboratory view
        return view('sections.laboratory');
    }
}





 function sendReport(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'doctor' => 'required|string',
        'file_name' => 'required|string',
    ]);

    // Retrieve the file name and doctor's name
    $fileName = $request->input('file_name');
    $doctor = $request->input('doctor');

    // Generate the file's URL or path (assuming files are stored in storage/app/public/reports/)
    $fileUrl = asset('storage/reports/' . $fileName);

    // You can log or send the file URL to the doctor section
    return response()->json([
        'message' => 'File sent successfully!',
        'doctor' => $doctor,
        'file_url' => $fileUrl,
 

 
    ]);
}




<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;

class FileController extends Controller
{
    // Handle file sending
    public function sendFile(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string',
            'doctor' => 'required|string',
        ]);

        // Store file data in session (to simulate without using a database)
        $fileData = [
            'doctor' => $request->doctor,
            'file_name' => $request->file_name,
        ];

        session()->push('files', $fileData); // Save the file data in the session

        return redirect()->route('doctors.showFiles')->with('success', 'File sent successfully!');
    }

    // Display files in the doctors' section
    public function showFiles()
    {
        $files = session('files', []); // Retrieve all files from the session
        return view('doctors', compact('files')); // Pass files to the doctors' view
    }
}

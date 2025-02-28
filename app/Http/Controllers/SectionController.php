<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class SectionController extends Controller
{
    public function doctors()
    {
        return view('sections.doctors');
    }

    public function laboratory()
    {
        return view('sections.laboratory');
    }

    public function employees()
    {
        return view('sections.employees');
    }

    public function xray()
    {
        return view('sections.xray');
    }

    public function patients()
    {
        return view('sections.patients');
    }

    public function reports()
    {
        return view('sections.reports');
    }

    public function pharmacy()
    {
        return view('sections.pharmacy');
    }
}

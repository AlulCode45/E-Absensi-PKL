<?php

namespace App\Http\Controllers;

use App\Models\AbsentsModel;
use App\Models\StudentsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AbsentController extends Controller
{
    function absent()
    {
        return view('absent');
    }
    function absentAction(Request $request)
    {
        $nisn = $request->nisn;
        $student = StudentsModel::where('nisn', $nisn)->first();

        if (!$student) {
            return back()->with('error', 'NISN not found');
        }

        $dataBefore = AbsentsModel::where('student_id', $student->id)
            ->whereDate('date', Carbon::now())
            ->first();

        if ($dataBefore) {
            return back()->with('error', 'You have been absent today');
        }

        $save = AbsentsModel::create([
            'student_id' => $student->id,
            'date' => Carbon::now(),
            'status' => 'Hadir',
        ]);

        if ($save) {
            return back()->with('success', 'Absent success');
        } else {
            return back()->with('error', 'Absent failed');
        }
    }
}
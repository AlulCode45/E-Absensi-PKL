<?php

namespace App\Http\Controllers;

use App\Models\AbsentsModel;
use App\Models\StudentsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function Dashboard()
    {
        $data = [
            'absentToday' => AbsentsModel::whereDate('date', Carbon::now())->count(),
            'absentTotal' => AbsentsModel::count(),
            'studentsAmount' => StudentsModel::count(),
            'absent' => AbsentsModel::with(['students', 'students.school', 'students.devision'])
                ->orderBy('date', 'desc')
                ->whereDate('date', Carbon::now())
                ->get()
        ];
        // dd($data['absent']->toArray());
        return view('dashboard.Dashboard', $data);
    }

    function ManageStudents()
    {
        $data = [
            'students' => StudentsModel::all()
        ];
        return view('dashboard.ManageStudents');
    }
}
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
            'students' => StudentsModel::with(['school', 'devision'])->get()
        ];
        return view('dashboard.students.ManageStudents', $data);
    }
    function editStudent(string $id)
    {
        $data = [
            'student' => StudentsModel::find($id)
        ];
        return view('dashboard.students.EditStudents', $data);
    }
    function viewStudent(string $id)
    {
        $data = [
            'student' => StudentsModel::find($id)
        ];
        return view('dashboard.students.viewStudent', $data);
    }
    function addStudent(Request $request)
    {
        $request->validate([
            'nama' => 'string|required',
            'nisn' => 'numeric|required|unique:students,nisn',
            'sekolah' => 'numeric|required',
            'devisi' => 'numeric|required'
        ]);

        $data = [
            'name' => $request->nama,
            'nisn' => $request->nisn,
            'school_id' => $request->sekolah,
            'devisi_id' => $request->devisi
        ];
        $save = StudentsModel::create($data);
        if ($save) {
            return back()->with('success', 'Sukses Tambah    Data!');
        } else {
            return back()->with('error', 'Gagal Tambah Data!');
        }
    }
    function updateStudent(int $id, Request $request)
    {
        $request->validate([
            'nama' => 'string|required',
            'nisn' => 'numeric|required|unique:students,nisn',
            'sekolah' => 'numeric|required',
            'devisi' => 'numeric|required'
        ]);

        $data = [
            'name' => $request->nama,
            'nisn' => $request->nisn,
            'school_id' => $request->sekolah,
            'devisi_id' => $request->devisi
        ];
        $save = StudentsModel::find($id)->update($data);
        if ($save) {
            return back()->with('success', 'Sukses Edit Data!');
        } else {
            return back()->with('error', 'Gagal Edit Data!');
        }
    }
    function deleteStudent($id)
    {
        $data = StudentsModel::find($id);
        if (!$data) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $data->delete();
        return back()->with('success', 'Sukses hapus Data!');
    }
}
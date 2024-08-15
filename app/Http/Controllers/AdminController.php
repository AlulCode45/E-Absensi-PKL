<?php

namespace App\Http\Controllers;

use App\Models\AbsentsModel;
use App\Models\DevisionModel;
use App\Models\SchoolsModel;
use App\Models\SettingsModel;
use App\Models\StudentsModel;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
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
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.numeric' => 'NISN harus berupa angka.',
            'nisn.unique' => 'NISN sudah terdaftar, silakan gunakan NISN yang lain.',
            'sekolah.required' => 'Sekolah wajib diisi.',
            'sekolah.numeric' => 'Sekolah harus berupa angka yang valid.',
            'devisi.required' => 'Devisi wajib diisi.',
            'devisi.numeric' => 'Devisi harus berupa angka yang valid.'
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
            'nisn' => "numeric|required|unique:students,nisn,$id",
            'sekolah' => 'numeric|required',
            'devisi' => 'numeric|required'
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.numeric' => 'NISN harus berupa angka.',
            'nisn.unique' => 'NISN sudah terdaftar, silakan gunakan NISN yang lain.',
            'sekolah.required' => 'Sekolah wajib diisi.',
            'sekolah.numeric' => 'Sekolah harus berupa angka yang valid.',
            'devisi.required' => 'Devisi wajib diisi.',
            'devisi.numeric' => 'Devisi harus berupa angka yang valid.'
        ]);


        $data = [
            'name' => $request->nama,
            'nisn' => $request->nisn,
            'school_id' => $request->sekolah,
            'devisi_id' => $request->devisi
        ];
        $save = StudentsModel::find($id)->update($data);
        if ($save) {
            return redirect()->to('/dashboard/kelola-siswa')->with('success', 'Sukses Edit Data!');
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

    //devision
    function ManageDivisions()
    {
        $data = [
            'divisions' => DevisionModel::all()
        ];
        return view('dashboard.devisions.ManageDevision', $data);
    }
    function addDivision(Request $request)
    {
        $request->validate([
            'name' => 'string|required|unique:devision,name'
        ], [
            'name.required' => 'Nama divisi wajib diisi.',
            'name.string' => 'Nama divisi harus berupa teks.',
            'name.unique' => 'Nama divisi sudah terdaftar, silakan gunakan nama yang lain.'
        ]);


        $data = [
            'name' => $request->name
        ];
        $save = DevisionModel::create($data);
        if ($save) {
            return back()->with('success', 'Sukses Tambah Data!');
        } else {
            return back()->with('error', 'Gagal Tambah Data!');
        }
    }
    function editDivision(string $id)
    {
        $data = [
            'division' => DevisionModel::find($id)
        ];
        return view('dashboard.devisions.EditDevision', $data);
    }
    function updateDivision(int $id, Request $request)
    {
        $request->validate([
            'name' => 'string|required|unique:devision,name'
        ], [
            'name.required' => 'Nama divisi wajib diisi.',
            'name.string' => 'Nama divisi harus berupa teks.',
            'name.unique' => 'Nama divisi sudah terdaftar, silakan gunakan nama yang lain.'
        ]);


        $data = [
            'name' => $request->name
        ];
        $save = DevisionModel::find($id)->update($data);
        if ($save) {
            return redirect()->to('/dashboard/kelola-devisi')->with('success', 'Sukses Edit Data!');
        } else {
            return back()->with('error', 'Gagal Edit Data!');
        }
    }
    function deleteDivision($id)
    {
        $data = DevisionModel::find($id);
        if (!$data) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        try {
            $data->delete();
            return back()->with('success', 'Sukses hapus Data!');
        } catch (QueryException $exception) {
            return back()->with('error', 'Gagal hapus data, mungkin data masih digunakan !');
        }
    }

    //school
    function ManageSchools()
    {
        $data = [
            'schools' => SchoolsModel::all()
        ];
        return view('dashboard.schools.ManageSchools', $data);
    }
    function addSchool(Request $request)
    {
        $request->validate([
            'name' => 'string|required|unique:schools,name',
            'regency' => 'string|required'
        ], [
            'name.required' => 'Nama sekolah wajib diisi.',
            'name.string' => 'Nama sekolah harus berupa teks.',
            'name.unique' => 'Nama sekolah sudah terdaftar, silakan gunakan nama yang lain.',
            'regency.required' => 'Kabupaten/Kota wajib diisi.',
            'regency.string' => 'Kabupaten/Kota harus berupa teks.'
        ]);


        $data = [
            'name' => $request->name,
            'regency' => $request->regency
        ];
        $save = SchoolsModel::create($data);
        if ($save) {
            return back()->with('success', 'Sukses Tambah Data!');
        } else {
            return back()->with('error', 'Gagal Tambah Data!');
        }
    }
    function editSchool(string $id)
    {
        $data = [
            'school' => SchoolsModel::find($id)
        ];
        return view('dashboard.schools.EditSchools', $data);
    }
    function updateSchool(int $id, Request $request)
    {
        $request->validate([
            'name' => 'string|required|unique:schools,name',
            'regency' => 'string|required'
        ], [
            'name.required' => 'Nama sekolah wajib diisi.',
            'name.string' => 'Nama sekolah harus berupa teks.',
            'name.unique' => 'Nama sekolah sudah terdaftar, silakan gunakan nama yang lain.',
            'regency.required' => 'Kabupaten/Kota wajib diisi.',
            'regency.string' => 'Kabupaten/Kota harus berupa teks.'
        ]);


        $data = [
            'name' => $request->name,
            'regency' => $request->regency
        ];
        $save = SchoolsModel::find($id)->update($data);
        if ($save) {
            return redirect()->to('/dashboard/kelola-sekolah')->with('success', 'Sukses Edit Data!');
        } else {
            return back()->with('error', 'Gagal Edit Data!');
        }
    }
    function deleteSchool($id)
    {
        $data = SchoolsModel::find($id);
        if (!$data) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $data->delete();
        return back()->with('success', 'Sukses hapus Data!');
    }

    //absent
    function ManageAbsents()
    {
        $data = [
            'absents' => AbsentsModel::with(['students', 'students.school', 'students.devision'])
                ->orderBy('date', 'desc')
                ->get()
        ];
        return view('dashboard.absents.ManageAbsent', $data);
    }
    function deleteAbsent($id)
    {
        $data = AbsentsModel::find($id);
        if (!$data) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $data->delete();
        return back()->with('success', 'Sukses hapus Data!');
    }
    function settings()
    {
        $data = [
            'waktu_berangkat' => SettingsModel::where('name', 'waktu_berangkat')->first(),
            'waktu_pulang' => SettingsModel::where('name', 'waktu_pulang')->first(),
        ];
        return view('dashboard.SettingsPage', $data);
    }
    function updateSettings(Request $request)
    {
        $request->validate([
            'waktu_berangkat' => 'required',
            'waktu_pulang' => 'required'
        ], [
            'waktu_berangkat.required' => 'Waktu berangkat wajib diisi.',
            'waktu_pulang.required' => 'Waktu pulang wajib diisi.'
        ]);

        $data = [
            ['name' => 'waktu_berangkat', 'value' => $request->waktu_berangkat],
            ['name' => 'waktu_pulang', 'value' => $request->waktu_pulang]
        ];
        foreach ($data as $item) {
            SettingsModel::where('name', $item['name'])->update(['value' => $item['value']]);
        }
        return back()->with('success', 'Sukses update data!');
    }
}
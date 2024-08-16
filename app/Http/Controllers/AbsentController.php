<?php

namespace App\Http\Controllers;

use App\Models\AbsentsModel;
use App\Models\SettingsModel;
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
            return back()->with('error', 'NISN tidak ditemukan');
        }

        // Ambil data absensi terakhir untuk siswa ini
        $lastAbsent = AbsentsModel::where('student_id', $student->id)
            ->whereDate('date', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastAbsent && $lastAbsent->status == 'Alpa') {
            return back()->with('error', 'Anda sudah absen alpa hari ini.');
        }

        $time = Carbon::now()->format('H:i:s');
        $waktuMasuk = SettingsModel::where('name', 'waktu_berangkat')->first();
        $waktuPulang = SettingsModel::where('name', 'waktu_pulang')->first();
        $waktuMasukCarbon = Carbon::createFromFormat('H:i:s', $waktuMasuk->value);
        $batasTerlambat = $waktuMasukCarbon->copy()->addMinutes(30);

        // Jika sudah absen berangkat, cek untuk absen pulang
        if ($lastAbsent) {
            if ($lastAbsent->status == 'Pulang') {
                return back()->with('error', 'Anda sudah melakukan absen pulang hari ini.');
            }

            if ($time < $waktuPulang->value) {
                return back()->with('error', 'Belum waktunya pulang.');
            }

            $status = 'Pulang';

            $save = AbsentsModel::create([
                'student_id' => $student->id,
                'date' => Carbon::now(),
                'status' => $status,
            ]);

            if ($save) {
                return back()->with('success', 'Absen pulang berhasil.');
            } else {
                return back()->with('error', 'Absen pulang gagal.');
            }
        }

        // Logika untuk absen berangkat
        if ($time > $waktuPulang->value) {
            return back()->with('error', 'Anda tidak bisa absen masuk setelah waktu pulang.');
        } elseif ($time > $batasTerlambat->format('H:i:s')) {
            $status = 'Alpa';
        } elseif ($time > $waktuMasuk->value) {
            $status = 'Terlambat';
        } else {
            $status = 'Hadir';
        }

        $save = AbsentsModel::create([
            'student_id' => $student->id,
            'date' => Carbon::now(),
            'status' => $status,
        ]);

        if ($status == 'Alpa') {
            return back()->with('error', 'Anda terlambat absen masuk.');
        } elseif ($save) {
            return back()->with('success', 'Absen masuk berhasil.');
        } else {
            return back()->with('error', 'Absen masuk gagal.');
        }
    }


}
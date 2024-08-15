@extends('template.main')
@section('title', 'Dashboard')

@section('external-css')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-3 mt-8 sm:grid-cols-4">
        <div class="flex items-center bg-white border rounded-sm shadow">
            <div class="p-4 bg-green-400 h-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg></div>
            <div class="px-2 text-gray-700">
                <h3 class="text-sm tracking-wider">Total Siswa</h3>
                <p class="text-3xl">{{ $studentsAmount }}</p>
            </div>
        </div>
        <div class="flex items-center bg-white border rounded-sm shadow">
            <div class="p-4 bg-blue-400 h-full">
                <svg fill="#000000" class="w-12 h-12" viewBox="0 0 24 24" id="check-double" data-name="Flat Line"
                    xmlns="http://www.w3.org/2000/svg" class="icon flat-line">
                    <line id="primary" x1="13.22" y1="16.5" x2="21" y2="7.5"
                        style="fill: none; stroke: rgb(255,255,255); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                    </line>
                    <polyline id="primary-2" data-name="primary" points="3 11.88 7 16.5 14.78 7.5"
                        style="fill: none; stroke: rgb(255,255,255); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                    </polyline>
                </svg>
            </div>
            <div class="px-2 text-gray-700">
                <h3 class="text-sm tracking-wider mt-2">Siswa Absen <span class="text-red-400">*Today</span></h3>
                <p class="text-3xl">{{ $absentToday }}</p>
            </div>
        </div>
        <div class="flex items-center bg-white border rounded-sm shadow">
            <div class="p-4 bg-indigo-400 h-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                    </path>
                </svg></div>
            <div class="px-2 text-gray-700">
                <h3 class="text-sm tracking-wider">Total Absen</h3>
                <p class="text-3xl">{{ $absentTotal }}</p>
            </div>
        </div>
        <div class="flex items-center bg-white border rounded-sm shadow">
            <div class="p-4 bg-red-400 h-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4">
                    </path>
                </svg></div>
            <div class="px-2 text-gray-700">
                <h3 class="text-sm tracking-wider">Siswa Alfa</h3>
                <p class="text-3xl">{{ $studentsAmount - $absentTotal }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white shadow rounded-md mt-4 p-3 overflow-auto">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Asal Sekolah</th>
                    <th>Devisi</th>
                    <th>Waktu Absen</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absent as $d)
                    <tr>
                        <td>{{ $d->students->name }}</td>
                        <td>{{ $d->students->nisn }}</td>
                        <td>{{ $d->students->school ? $d->students->school->name : 'N/A' }}</td>
                        <td>{{ $d->students->devision ? $d->students->devision->name : 'N/A' }}</td>
                        <td>{{ $d->date }}</td>
                        <td>
                            @if ($d->status == 'Hadir' || $d->status == 'Pulang')
                                <div class="bg-green-400/40 text-green-600 p-2 rounded-full text-xs text-center">
                                    {{ $d->status }}
                                </div>
                            @else
                                <div class="bg-red-400/40 text-red-600 p-2 rounded-full text-xs text-center">
                                    {{ $d->status }}</div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Asal Sekolah</th>
                    <th>Devisi</th>
                    <th>Waktu Absen</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

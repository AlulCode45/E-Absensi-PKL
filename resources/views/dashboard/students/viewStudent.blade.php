@extends('template.main')
@section('title', 'Lihat Siswa')
@section('page-title', 'Lihat Siswa')

@section('content')
    <div class="bg-white shadow rounded-md mt-4 p-3 overflow-auto">
        <form action="{{ route('update-student', $student->id) }}" method="post">
            @csrf
            <div class="flex gap-2 my-2">
                <div class="form-group w-full">
                    <label for="" class="block text-sm mb-2">Nama Siswa</label>
                    <input type="text" name="nama"
                        class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm " placeholder="Nama Siswa"
                        value="{{ $student->name }}" readonly disabled>
                </div>
                <div class="form-group w-full">
                    <label for="" class="block text-sm mb-2">NISN</label>
                    <input type="number" name="nisn"
                        class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm " placeholder="NISN"
                        value="{{ $student->nisn }}" readonly disabled>
                </div>
            </div>
            <div class="flex gap-2 my-2 mb-6">
                <div class="form-group w-full">
                    <label for="" class="block text-sm mb-2">Asal Sekolah</label>
                    <select name="sekolah"
                        class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm bg-gray-100"readonly
                        disabled>
                        <option value="">Pilih Sekolah</option>
                        @foreach (\App\Models\SchoolsModel::all() as $school)
                            <option value="{{ $school->id }}" {{ $school->id == $student->school_id ? 'selected' : '' }}>
                                {{ $school->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group w-full">
                    <label for="" class="block text-sm mb-2">Devisi</label>
                    <select name="devisi"
                        class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm bg-gray-100"readonly
                        disabled>
                        <option value="">Pilih Devisi</option>
                        @foreach (\App\Models\DevisionModel::all() as $devisi)
                            <option value="{{ $devisi->id }}" {{ $devisi->id == $student->devisi_id ? 'selected' : '' }}>
                                {{ $devisi->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-end mb-2">
                <a href="/dashboard/kelola-siswa/edit/{{ $student->id }}"
                    class="bg-blue-400 px-4 py-2 text-white font-semibold text-decoration-none">Edit Data</a>
            </div>
        </form>
    </div>
@endsection

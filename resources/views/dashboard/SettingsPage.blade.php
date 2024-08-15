@extends('template.main')
@section('title', 'Edit Siswa')
@section('page-title', 'Edit Siswa')

@section('content')
    <div class="bg-white shadow rounded-md mt-4 p-3 overflow-auto">
        <form action="{{ route('updateSettings') }}" method="post">
            @csrf
            <div class="flex gap-2 my-2">
                <div class="form-group w-full">
                    <label for="" class="block text-sm mb-2">Waktu Masuk</label>
                    <input type="text" name="waktu_berangkat"
                        class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm " placeholder="Nama Sekolah"
                        value="{{ $waktu_berangkat['value'] }}">
                </div>
                <div class="form-group w-full">
                    <label for="" class="block text-sm mb-2">Waktu Pulang</label>
                    <input type="text" name="waktu_pulang"
                        class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm " placeholder="Kabupaten"
                        value="{{ $waktu_pulang['value'] }}">
                </div>
            </div>
            <button class="bg-blue-400 px-4 py-2 mt-2 text-white font-semibold">Simpan</button>
        </form>
    </div>
@endsection

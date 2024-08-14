@extends('template.main')
@section('title', 'Edit Siswa')
@section('page-title', 'Edit Siswa')

@section('content')
    <div class="bg-white shadow rounded-md mt-4 p-3 overflow-auto">
        <form action="{{ route('update-school', $school->id) }}" method="post">
            @csrf
            <div class="flex gap-2 my-2">
                <div class="form-group w-full">
                    <label for="" class="block text-sm mb-2">Nama Sekolah</label>
                    <input type="text" name="name"
                        class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm " placeholder="Nama Sekolah"
                        value="{{ $school->name }}">
                </div>
                <div class="form-group w-full">
                    <label for="" class="block text-sm mb-2">Kabupaten</label>
                    <input type="text" name="regency"
                        class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm " placeholder="Kabupaten"
                        value="{{ $school->regency }}">
                </div>
            </div>
            <button class="bg-blue-400 px-4 py-2 mt-2 text-white font-semibold">Simpan</button>
        </form>
    </div>
@endsection

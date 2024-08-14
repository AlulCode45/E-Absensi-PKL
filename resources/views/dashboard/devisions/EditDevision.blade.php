@extends('template.main')
@section('title', 'Edit Division')
@section('page-title', 'Edit Division')

@section('content')
    <div class="bg-white shadow rounded-md mt-4 p-3 overflow-auto">
        <form action="{{ route('update-division', $division->id) }}" method="post">
            @csrf
            <div class="form-group  ">
                <label for="" class="block text-sm mb-2">Nama Division</label>
                <input type="text" name="name" class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm "
                    placeholder="Nama Division" value="{{ $division->name }}">
            </div>
            <button class="bg-blue-400 px-4 py-2 mt-2 text-white font-semibold">Simpan</button>
        </form>
    </div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="grid place-content-center h-screen">
        <div class="relative">
            <form action="/register" method="post">
                @csrf
                <div class="bg-white shadow-xl p-7 py-14 w-96 rounded-md">
                    <h1 class="text-4xl font-bold text-center mb-1">E - Absensi</h1>
                    <p class="text-center mb-7">Aplikasi absensi siswa magang HUMMATECH</p>
                    @include('template.message')

                    <div class="form-group my-2">
                        <label for="" class="block">Nama</label>
                        <input type="text"
                            class="p-2 border mt-2 w-full focus:outline focus:outline-blue-700 rounded-sm"
                            placeholder="Nama" name="name">
                    </div>
                    <div class="form-group">
                        <label for="" class="block">NISN</label>
                        <input type="number"
                            class="p-2 border mt-2 w-full focus:outline focus:outline-blue-700 rounded-sm"
                            placeholder="NISN" name="nisn">
                    </div>
                    <div class="form-group w-full">
                        <label for="" class="block text-sm mb-2">Asal Sekolah</label>
                        <select name="school"
                            class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm ">
                            <option value="">Pilih Sekolah</option>
                            @foreach (\App\Models\SchoolsModel::all() as $school)
                                <option value="{{ $school->id }}">
                                    {{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group w-full">
                        <label for="" class="block text-sm mb-2">Devisi</label>
                        <select name="devisi"
                            class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm ">
                            <option value="">Pilih Devisi</option>
                            @foreach (\App\Models\DevisionModel::all() as $devisi)
                                <option value="{{ $devisi->id }}">
                                    {{ $devisi->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="bg-blue-500 p-3 w-full font-bold text-white mt-3" type="submit">Masuk</button>
                </div>
            </form>
            <div class="absolute top-0 -right-[270px]">
                <img src="https://pkl.hummatech.com/assetsLogin/cartoon.png" alt="">
            </div>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="grid place-content-center h-screen">
        <div class="relative">
            <form action="/login" method="post">
                @csrf
                <div class="bg-white shadow-xl p-7 py-14 w-96 rounded-md">
                    <h1 class="text-4xl font-bold text-center mb-1">E - Absensi</h1>
                    <p class="text-center mb-7">Aplikasi absensi siswa magang HUMMATECH</p>

                    @include('template.message')
                    <di`` class="form-group my-2">
                        <label for="" class="block">Email</label>
                        <input type="text"
                            class="p-2 border mt-2 w-full focus:outline focus:outline-blue-700 rounded-sm"
                            placeholder="Email" name="email">
                        </di>
                        <div class="form-group my-2">
                            <label for="" class="block">Password</label>
                            <input type="password"
                                class="p-2 border mt-2 w-full focus:outline focus:outline-blue-700 rounded-sm"
                                placeholder="Password" name="password">
                        </div>
                        <p class="text-gray-500 my-3 ">Tidak memiliki akun? <a href=""
                                class="text-blue-500">Daftar</a>
                        </p>
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

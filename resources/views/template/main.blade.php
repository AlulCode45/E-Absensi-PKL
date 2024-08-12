<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100">
    <div class="flex">
        <aside class="w-3/12 bg-white h-screen rounded-tr-xl rounded-br-xl">
            <div class="logo p-7">
                <h1 class="text-blue-600 font-semibold text-xl">E - Absensi</h1>
            </div>
            <div id="main-menu">
                <div class="menu-item w-full flex flex-col px-4">
                    <div
                        class="flex gap-5 items-center p-3 hover:scale-105 transition-all duration-150 hover:bg-blue-700/20 hover:font-semibold">
                        <i class="fa fa-dashboard text-gray-500"></i> Dashboard
                    </div>
                    <div
                        class="flex gap-5 items-center p-3 hover:scale-105 transition-all duration-150 hover:bg-blue-700/20 hover:font-semibold ">
                        <i class="fa fa-user text-gray-500"></i> Kelola Siswa
                    </div>
                    <div
                        class="flex gap-5 items-center p-3 hover:scale-105 transition-all duration-150 hover:bg-blue-700/20 hover:font-semibold ">
                        <i class="fa fa-hashtag text-gray-500"></i> Kelola Devision
                    </div>
                    <div
                        class="flex gap-5 items-center p-3 hover:scale-105 transition-all duration-150 hover:bg-blue-700/20 hover:font-semibold ">
                        <i class="fa fa-building text-gray-500"></i> Kelola Sekolah
                    </div>
                    <div
                        class="flex gap-5 items-center p-3 hover:scale-105 transition-all duration-150 hover:bg-blue-700/20 hover:font-semibold ">
                        <i class="fa fa-check text-gray-500"></i> Kelola Absensi
                    </div>
                </div>
            </div>
        </aside>
        <main class="w-9/12 p-7">
            <nav class="w-full flex justify-between items-center gap-3">
                <h2 class="font-bold text-xl">Dashboard</h2>
                <div class="flex gap-3 items-center">
                    <span>John Doe</span>
                    <div class="rounded-full w-10 h-10">
                        <img src="https://ui-avatars.com/api/?name=John+Doe" alt="profile"
                            class="rounded-full w-10 h-10">
                    </div>
                </div>
            </nav>
        </main>
    </div>
    <footer>

    </footer>
</body>

</html>

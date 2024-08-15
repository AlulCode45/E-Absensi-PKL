<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - E Jurnal Magang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite('resources/css/app.css')
    @yield('external-css')
</head>

<body class="bg-gray-100">
    <div class="flex">
        <aside class="w-3/12 bg-white h-screen rounded-tr-xl rounded-br-xl">
            <div class="logo p-7">
                <h1 class="text-blue-600 font-semibold text-xl">E - Absensi</h1>
            </div>
            <div id="main-menu">
                <div class="menu-item w-full flex flex-col px-4">
                    <a href="/dashboard"
                        class="flex gap-3 items-center p-3 hover:scale-105 transition-all duration-150 hover:bg-blue-700/20 hover:font-semibold text-decoration-none text-black">
                        <i class="fa fa-dashboard text-gray-500"></i> Dashboard
                    </a>
                    <a href="/dashboard/kelola-siswa"
                        class="flex gap-3 items-center p-3 hover:scale-105 transition-all duration-150 hover:bg-blue-700/20 hover:font-semibold text-decoration-none text-black">
                        <i class="fa fa-user text-gray-500"></i> Kelola Siswa
                    </a>
                    <a href="/dashboard/kelola-devisi"
                        class="flex gap-3 items-center p-3 hover:scale-105 transition-all duration-150 hover:bg-blue-700/20 hover:font-semibold text-decoration-none text-black">
                        <i class="fa fa-hashtag text-gray-500"></i> Kelola Devision
                    </a>
                    <a href="/dashboard/kelola-sekolah"
                        class="flex gap-3 items-center p-3 hover:scale-105 transition-all duration-150 hover:bg-blue-700/20 hover:font-semibold text-decoration-none text-black">
                        <i class="fa fa-building text-gray-500"></i> Kelola Sekolah
                    </a>
                    <a href="/dashboard/kelola-absensi"
                        class="flex gap-3 items-center p-3 hover:scale-105 transition-all duration-150 hover:bg-blue-700/20 hover:font-semibold text-decoration-none text-black">
                        <i class="fa fa-check text-gray-500"></i> Kelola Absensi
                    </a>
                    <a href="/dashboard/settings"
                        class="flex gap-3 items-center p-3 hover:scale-105 transition-all duration-150 hover:bg-blue-700/20 hover:font-semibold text-decoration-none text-black">
                        <i class="fa fa-clock text-gray-500"></i> Pengaturan Waktu
                    </a>
                </div>
            </div>
        </aside>
        <main class="w-9/12 p-7 h-screen overflow-y-auto">
            <nav class="w-full flex justify-between items-center gap-3">
                <h2 class="font-bold text-xl">@yield('page-title', 'Dashboard')</h2>
                <div class="flex gap-3 items-center relative">
                    <span>{{ auth()->user()->name }}</span>
                    <div class="rounded-full w-10 h-10" id="profile-image">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="profile"
                            class="rounded-full w-10 h-10">
                    </div>
                    <div class="absolute scale-0 transition-all duration-150 -bottom-[5.9rem] z-20 right-0 w-44">
                        <div class="bg-white p-3 shadow flex flex-col gap-2">
                            {{-- <a class="text-decoration-none text-black" href="">Profile</a> --}}
                            <a class="text-decoration-none text-black" href="/auth/logout"
                                onclick="confirmLogout(event, this.href)">Logout</a>
                        </div>
                    </div>
                </div>
            </nav>
            @include('template.message')
            @yield('content')
        </main>
    </div>
    <footer>

    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();

            //when click profile image, and then show the dropdown menu
            $('#profile-image').click(function() {
                $('.absolute').toggleClass('scale-100');
            });
        });

        function confirmDelete(event, url) {
            event.preventDefault(); // Mencegah default action dari link
            const confirmed = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (confirmed) {
                window.location.href = url; // Redirect ke URL penghapusan jika dikonfirmasi
            }
        }

        function confirmLogout(event, url) {
            event.preventDefault(); // Mencegah default action dari link
            const confirmed = confirm("Apakah Anda yakin ingin keluar?");
            if (confirmed) {
                window.location.href = url; // Redirect ke URL penghapusan jika dikonfirmasi
            }
        }
    </script>
</body>

</html>

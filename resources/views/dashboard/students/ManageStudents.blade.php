@extends('template.main')
@section('title', 'Kelola Siswa')

@section('external-css')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="bg-white shadow rounded-md mt-4 p-3 overflow-auto">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl">Kelola Siswa</h2>
            <button class="bg-blue-400 px-4 py-2 text-white font-semibold" onclick="showModal()">Tambah Siswa</button>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Asal Sekolah</th>
                    <th>Devisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $d)
                    <tr>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->nisn }}</td>
                        <td>{{ $d->school ? $d->school->name : 'N/A' }}</td>
                        <td>{{ $d->devision ? $d->devision->name : 'N/A' }}</td>
                        <td class="flex gap-2">
                            <a href="/dashboard/kelola-siswa/edit/{{ $d->id }}"
                                class="bg-warning p-2 text-white px-3 text-decoration-none">Edit</a>
                            <a href="/dashboard/kelola-siswa/delete/{{ $d->id }}"
                                class="bg-red-400 p-2 text-white px-3 text-decoration-none"
                                onclick="confirmDelete(event, this.href)">Hapus</a>
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
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="overlay fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300" id="modal-overlay">
    </div>

    <div class="modal-container fixed z-50 w-screen h-screen top-0 left-0 flex items-center justify-center hidden"
        id="modal-container">
        <div
            class="modal-content bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg overflow-y-auto translate-y-[-100%] opacity-0 transition-all duration-500 ease-out">
            <!-- Add modal content here -->
            <div class="py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Tambah Siswa</p>
                    <i class="fa fa-times text-xl cursor-pointer" onclick="hideModal()"></i>
                </div>

                <form action="{{ route('add-student') }}" method="post">
                    @csrf
                    <div class="flex gap-2 my-2">
                        <div class="form-group w-full">
                            <label for="" class="block text-sm mb-2">Nama Siswa</label>
                            <input type="text" name="nama"
                                class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm"
                                placeholder="Nama Siswa">
                        </div>
                        <div class="form-group w-full">
                            <label for="" class="block text-sm mb-2">NISN</label>
                            <input type="number" name="nisn"
                                class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm"
                                placeholder="NISN">
                        </div>
                    </div>
                    <div class="flex gap-2 my-2">
                        <div class="form-group w-full">
                            <label for="" class="block text-sm mb-2">Asal Sekolah</label>
                            <select name="sekolah"
                                class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm">
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
                                class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm">
                                <option value="">Pilih Devisi</option>
                                @foreach (\App\Models\DevisionModel::all() as $devisi)
                                    <option value="{{ $devisi->id }}">
                                        {{ $devisi->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="bg-blue-400 px-4 py-2 mt-2 text-white font-semibold">Simpan</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        function showModal() {
            const overlay = document.getElementById('modal-overlay');
            overlay.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                overlay.classList.add('opacity-100');
            }, 10); // Sedikit delay untuk memastikan animasi berjalan

            // Setelah overlay ditampilkan, munculkan modal dengan efek slide dan fade-in
            const modalContainer = document.getElementById('modal-container');
            const modalContent = document.querySelector('.modal-content');
            modalContainer.classList.remove('hidden');

            setTimeout(() => {
                modalContent.classList.remove('translate-y-[-100%]', 'opacity-0');
                modalContent.classList.add('translate-y-0', 'opacity-100');
            }, 300); // Delay untuk menunggu overlay selesai ditampilkan
        }

        function hideModal() {
            // Sembunyikan modal dengan animasi slide dan fade-out
            const modalContent = document.querySelector('.modal-content');
            modalContent.classList.add('translate-y-[-100%]', 'opacity-0');
            modalContent.classList.remove('translate-y-0', 'opacity-100');

            // Setelah modal disembunyikan, sembunyikan overlay dengan fade-out
            setTimeout(() => {
                const overlay = document.getElementById('modal-overlay');
                const modalContainer = document.getElementById('modal-container');
                overlay.classList.add('opacity-0');
                overlay.classList.remove('opacity-100');

                setTimeout(() => {
                    overlay.classList.add('hidden');
                    modalContainer.classList.add('hidden');
                }, 300); // Waktu delay disamakan dengan durasi transition
            }, 500); // Waktu delay disamakan dengan durasi transition modal
        }
    </script>
@endsection

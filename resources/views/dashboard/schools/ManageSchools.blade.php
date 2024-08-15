@extends('template.main')
@section('title', 'Kelola Sekolah')

@section('external-css')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="bg-white shadow rounded-md mt-4 p-3 overflow-auto">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl">Kelola Sekolah</h2>
            <button class="bg-blue-400 px-4 py-2 text-white font-semibold" onclick="showModal()">Tambah Sekolah</button>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kabupaten</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schools as $d)
                    <tr>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->regency }}</td>
                        <td class="flex gap-2">
                            <a href="/dashboard/kelola-sekolah/edit/{{ $d->id }}"
                                class="bg-warning p-2 text-white px-3 text-decoration-none">Edit</a>
                            <a href="/dashboard/kelola-sekolah/delete/{{ $d->id }}"
                                class="bg-red-400 p-2 text-white px-3 text-decoration-none"
                                onclick="confirmDelete(event, this.href)">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Nama</th>
                    <th>Kabupaten</th>
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
                    <div class="flex justify-between w-full items-center">
                        <p class="text-2xl font-bold">Tambah Sekolah</p>
                        <i class="fa fa-times text-xl cursor-pointer" onclick="hideModal()"></i>
                    </div>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                            height="18" viewBox="0 0 18 18">
                            <path d="M1.39 1.393l15.318 15.314m-15.318 0L16.706 1.393" />
                        </svg>
                    </div>
                </div>

                <form action="{{ route('add-school') }}" method="post">
                    @csrf
                    <div class="flex gap-2 my-2">
                        <div class="form-group w-full">
                            <label for="" class="block text-sm mb-2">Nama Sekolah</label>
                            <input type="text" name="name"
                                class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm"
                                placeholder="Nama Sekolah">
                        </div>
                        <div class="form-group w-full">
                            <label for="" class="block text-sm mb-2">Kabupaten</label>
                            <input type="text" name="regency"
                                class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm"
                                placeholder="Kabupaten">
                        </div>
                    </div>
                    <button class="bg-blue-400 px-4 py-2 mt-2 text-white font-semibold">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showModal() {
            // Tampilkan overlay dengan efek fade-in
            const overlay = document.getElementById('modal-overlay');
            overlay.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                overlay.classList.add('opacity-100');
            }, 10);

            // Tampilkan modal dengan slide dan fade-in
            const modalContainer = document.getElementById('modal-container');
            const modalContent = document.querySelector('.modal-content');
            modalContainer.classList.remove('hidden');

            setTimeout(() => {
                modalContent.classList.remove('translate-y-[-100%]', 'opacity-0');
                modalContent.classList.add('translate-y-0', 'opacity-100');
            }, 300); // Menunggu overlay selesai muncul
        }

        function hideModal() {
            // Sembunyikan modal dengan slide dan fade-out
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
                }, 300);
            }, 500); // Waktu delay untuk menyembunyikan modal
        }
    </script>
@endsection

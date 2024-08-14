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
                            <a href="/dashboard/kelola-siswa/{{ $d->id }}"
                                class="bg-blue-400 p-2 text-white px-3 text-decoration-none">Lihat</a>
                            <a href="/dashboard/kelola-siswa/edit/{{ $d->id }}"
                                class="bg-warning p-2 text-white px-3 text-decoration-none">Edit</a>
                            <a href="/dashboard/kelola-siswa/delete/{{ $d->id }}"
                                class="bg-red-400 p-2 text-white px-3 text-decoration-none">Hapus</a>
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

    <div
        class="z-50 bg-black/40 w-screen h-screen absolute top-0 left-0 -translate-y-[100%] transition-all duration-500 place-content-center">
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <!-- Add modal content here -->
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <div class="flex justify-between w-full items-center">
                        <p class="text-2xl font-bold">Tambah Siswa</p>
                        <i class="fa fa-times text-xl" onclick="hideModal()"></i>
                    </div>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                            height="18" viewBox="0 0 18 18">
                            <path d="M1.39 1.393l15.318 15.314m-15.318 0L16.706 1.393" />
                        </svg>
                    </div>
                </div>

                <form action="{{ route('add-student') }}" method="post">
                    @csrf
                    <div class="flex gap-2 my-2">
                        <div class="form-group w-full">
                            <label for="" class="block text-sm mb-2">Nama Siswa</label>
                            <input type="text" name="nama"
                                class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm "
                                placeholder="Nama Siswa">
                        </div>
                        <div class="form-group w-full">
                            <label for="" class="block text-sm mb-2">NISN</label>
                            <input type="number" name="nisn"
                                class="p-2 border w-full focus:outline focus:outline-blue-400 rounded-sm "
                                placeholder="NISN">
                        </div>
                    </div>
                    <div class="flex gap-2 my-2">
                        <div class="form-group w-full">
                            <label for="" class="block text-sm mb-2">Asal Sekolah</label>
                            <select name="sekolah"
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
                    </div>
                    <button class="bg-blue-400 px-4 py-2 mt-2 text-white font-semibold">Simpan</button>
                </form>

                {{-- <div class="mt-4 flex justify-end">
                    <button class="modal-close px-4 bg-gray-100 p-2 rounded-lg text-black hover:bg-gray-200">Cancel</button>
                    <button class="px-4 bg-blue-500 p-2 ml-3 rounded-lg text-white hover:bg-purple-400">Save</button>
                </div> --}}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function showModal() {
            document.querySelector('.z-50').classList.remove('-translate-y-[100%]');
            document.querySelector('.z-50').classList.add('translate-y-0');

            // document.querySelector('.z-50').classList.remove('hidden');
            // document.querySelector('.z-50').classList.add('grid');
            // document.querySelector('.z-50').classList.add('transition-all');
            // document.querySelector('.z-50').classList.add('duration-150');
        }

        function hideModal() {
            document.querySelector('.z-50').classList.add('-translate-y-[100%]');
            document.querySelector('.z-50').classList.remove('translate-y-0');

            // document.querySelector('.z-50').classList.add('hidden');
            // document.querySelector('.z-50').classList.remove('grid');
            // document.querySelector('.z-50').classList.remove('transition-all');
            // document.querySelector('.z-50').classList.remove('duration-150');
        }
    </script>
@endsection

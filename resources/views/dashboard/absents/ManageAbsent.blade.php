@extends('template.main')
@section('title', 'Kelola Absen')

@section('external-css')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <div class="bg-white shadow rounded-md mt-4 p-3 overflow-auto">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl">Kelola Absen</h2>
        </div>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Asal Sekolah</th>
                    <th>Devisi</th>
                    <th>Waktu Absen</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absents as $d)
                    <tr>
                        <td>{{ $d->students->name }}</td>
                        <td>{{ $d->students->nisn }}</td>
                        <td>{{ $d->students->school ? $d->students->school->name : 'N/A' }}</td>
                        <td>{{ $d->students->devision ? $d->students->devision->name : 'N/A' }}</td>
                        <td>{{ $d->date }}</td>
                        <td>
                            @if ($d->status == 'Hadir' || $d->status == 'Pulang')
                                <div class="bg-green-400/40 text-green-600 p-2 rounded-full text-xs text-center">
                                    {{ $d->status }}
                                </div>
                            @else
                                <div class="bg-red-400/40 text-red-600 p-2 rounded-full text-xs text-center">
                                    {{ $d->status }}</div>
                            @endif
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
                    <th>Waktu Absen</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
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

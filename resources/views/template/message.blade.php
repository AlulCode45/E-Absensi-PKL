@if (session('error'))
    <div class="bg-red-500 text-white p-2 rounded-sm text-center">
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div class="bg-green-500 bg-opacity-70 text-white p-2 rounded-sm text-center">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-500 text-white p-2 rounded-sm text-center my-2">
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div class="bg-green-500 bg-opacity-70 text-white p-2 rounded-sm text-center my-2">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="bg-red-500 text-white p-2 rounded-sm text-center my-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

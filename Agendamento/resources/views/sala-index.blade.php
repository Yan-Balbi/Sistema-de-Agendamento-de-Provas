@include('header')

<h2>Lista de Salas</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<ul>
    @foreach ($salas as $sala)
        <li>{{ $sala->nome }}</li>
    @endforeach
</ul>

@include('footer')

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centros Cívicos</title>
    <!-- Incluir los archivos CSS y JS de forma tradicional -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <header>
        <a href="/">Inicio</a>
        <a href="/centros/anadir">Crear centro</a>
    </header>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <main class="container">
        @foreach($centros as $centro)
            <div class="card">
                <img src="{{ asset('storage/img/' . $centro->foto) }}" alt="Foto del centro">
                <div class="card-body">
                    <h2>{{ $centro->nombre }}</h2>
                    <p><strong>Dirección:</strong> {{ $centro->direccion }}</p>
                    <p><strong>Teléfono:</strong> {{ $centro->telefono }}</p>
                    <p><strong>Horario:</strong> {{ $centro->horario }}</p>
                    <div class="button-group">
                        <a href="{{ route('centros.edit', $centro->id) }}" class="button edit-btn">Editar centro</a>
                        <form action="{{ route('centros.destroy', $centro->id) }}" method="POST" style="display:inline;"
                            onsubmit="return confirmarEliminacion()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button delete-btn">Eliminar centro</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
</body>
<script>
    function confirmarEliminacion() {
        return confirm('¿Estás seguro de que quieres eliminar este centro? Esta acción no se puede deshacer.');
    }
</script>


</html>
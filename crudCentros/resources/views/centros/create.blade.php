<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Centro</title>
    <link rel="stylesheet" href="{{ asset('css/editar.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        .suggestions {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            background-color: white;
            position: absolute;
            z-index: 100;
            width: 100%;
            display: none;
        }
        .suggestion-item {
            padding: 8px;
            cursor: pointer;
        }
        .suggestion-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('centros.index') }}">Volver a la lista de centros</a>
    </header>

    <main class="container">
        <h1>Añadir Centro</h1>

        <form action="{{ route('centros.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre del Centro</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" required autocomplete="off">
                <div id="suggestions" class="suggestions"></div>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
            </div>
            <div class="form-group">
                <label for="horario">Horario</label>
                <input type="text" id="horario" name="horario" value="{{ old('horario') }}" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto del Centro</label>
                <input type="file" id="foto" name="foto" accept="image/*">
            </div>
            <button type="submit" class="button add-btn">Añadir Centro</button>
        </form>
    </main>

    <script>
        let debounceTimer;
        document.getElementById('direccion').addEventListener('input', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => obtenerSugerencias(this.value), 300);
        });

        async function obtenerSugerencias(direccion) {
            const suggestions = document.getElementById('suggestions');
            if (!direccion.trim()) {
                suggestions.innerHTML = '';
                suggestions.style.display = 'none';
                return;
            }

            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(direccion)}&addressdetails=1&limit=5&countrycodes=ES&accept-language=es`;
            try {
                const response = await fetch(url);
                const data = await response.json();
                suggestions.innerHTML = '';
                
                if (!data.length) {
                    suggestions.style.display = 'none';
                    return;
                }

                suggestions.style.display = 'block';
                data.forEach(item => {
                    const suggestionItem = document.createElement('div');
                    suggestionItem.classList.add('suggestion-item');
                    suggestionItem.textContent = item.display_name;
                    suggestionItem.onclick = () => {
                        document.getElementById('direccion').value = item.display_name;
                        suggestions.innerHTML = '';
                        suggestions.style.display = 'none';
                    };
                    suggestions.appendChild(suggestionItem);
                });
            } catch (error) {
                console.error('Error al obtener sugerencias:', error);
            }
        }

        document.addEventListener('click', function (e) {
            const suggestions = document.getElementById('suggestions');
            if (!document.getElementById('direccion').contains(e.target) && !suggestions.contains(e.target)) {
                suggestions.style.display = 'none';
            }
        });
    </script>
</body>
</html>

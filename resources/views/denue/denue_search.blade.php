<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar en DENUE</title>
    <!-- Incluir Bootstrap desde CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Formulario de búsqueda -->
        <h1 class="text-center">Buscar en DENUE</h1>
        <p>datos necesario a configurar en archivo .env</p>
        <p>DENUE_API_TOKEN=8a70e3c8-d06a-eac7-f046-cc5ec0d017d9</p>
        <form action="{{ route('denue.search') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre del establecimiento:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="cveEnt">Clave de entidad: del 01 - 31</label>
                <input type="text" class="form-control" id="cveEnt" name="cveEnt" required>
            </div>
            <div class="form-group">
                <label for="posIni">Posición inicial: <small>imagina una lista</small></label>
                <input type="number" class="form-control" id="posIni" name="posIni" required>
            </div>
            <div class="form-group">
                <label for="posFin">Posición final: <small>donde termina la lista</small></label>
                <input type="number" class="form-control" id="posFin" name="posFin" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
    <div class="container mt-5">
        <!-- Resultados de la búsqueda -->
        <h1 class="text-center">Resultados de la búsqueda en DENUE</h1>
        @if (isset($data['error']) && $data['error'])
            <div class="alert alert-danger" role="alert">
                Error: {{ $data['message'] }}
            </div>
        @else
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>CLEE</th>
                        <th>Nombre</th>
                        <th>Razón Social</th>
                        <th>Clase de Actividad</th>
                        <th>Estrato</th>
                        <th>Tipo de Vialidad</th>
                        <th>Calle</th>
                        <th>Colonia</th>
                        <th>Código Postal</th>
                        <th>Ubicación</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>Sitio Web</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item['CLEE'] }}</td>
                        <td>{{ $item['Nombre'] }}</td>
                        <td>{{ $item['Razon_social'] }}</td>
                        <td>{{ $item['Clase_actividad'] }}</td>
                        <td>{{ $item['Estrato'] }}</td>
                        <td>{{ $item['Tipo_vialidad'] }}</td>
                        <td>{{ $item['Calle'] }}</td>
                        <td>{{ $item['Colonia'] }}</td>
                        <td>{{ $item['CP'] }}</td>
                        <td>{{ $item['Ubicacion'] }}</td>
                        <td>{{ $item['Telefono'] }}</td>
                        <td>{{ $item['Correo_e'] }}</td>
                        <td>{{ $item['Sitio_internet'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</body>
</html>

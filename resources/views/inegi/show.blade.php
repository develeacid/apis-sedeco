<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de INEGI</title>
    <!-- Incluir Bootstrap desde CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Información de INEGI</h1>
        <p>datos necesario a configurar en archivo .env</p>
        <small>composer require guzzlehttp/guzzle</small>
        <p>INEGI_API_BASE_URL=https://www.inegi.org.mx/app/api/indicadores/desarrolladores/jsonxml/INDICATOR</p>
        <p>INEGI_API_TOKEN=8a70e3c8-d06a-eac7-f046-cc5ec0d017d9</p>
        <small>el api token lo generan en la pagina deL INEGI</small>
        <small>pueden probar con la siguiente url: http://127.0.0.1:8000/inegi/1002000058,1002000061,1002000004,1002000007,1002000064,1002000067,1002000070,1002000073,1002000076,1002000079,5000000002</small>
        @if (isset($data['error']) && $data['error'])
            <div class="alert alert-danger" role="alert">
                Error: {{ $data['message'] }}
            </div>
        @else
            @foreach ($data['Series'] as $series)
                <h2>Indicador: {{ $series['INDICADOR'] }}</h2>
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Período de Tiempo</th>
                            <th>Valor</th>
                            <th>Estado</th>
                            <th>Cobertura Geográfica</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($series['OBSERVATIONS'] as $observation)
                            <tr>
                                <td>{{ $observation['TIME_PERIOD'] }}</td>
                                <td>{{ $observation['OBS_VALUE'] }}</td>
                                <td>{{ $observation['OBS_STATUS'] }}</td>
                                <td>{{ $observation['COBER_GEO'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        @endif
    </div>
    <!-- Widget de Ciclos económicos -->
    <div class="container mt-5">
        <iframe id='IframeCicloseconomicos' src='https://www.inegi.org.mx/widgets/cicloseconomicos/index.html ' frameborder=0 width='100%' height='618px' ></iframe>
    </div>
    <!-- Widget Generales -->
    <div class="container mt-5">
        <h2>widgets</h2>
        <div class="row">
            <div class="col-4">
                <h3>Tendencias Economicas</h3>
                <iframe scrolling="no" frameborder="0" src="https://www.inegi.org.mx/widgets/tendencias/default.html" height="390" width="310"></iframe>
            </div>
            <div class="col-4">
                <h3>Índice de precios</h3>
                <iframe id='ifrmINP' src='https://www.inegi.org.mx/widgets/inp/indicedeprecios.html' frameborder=0 width='230' height='370' ></iframe>
            </div>
            <div class="col-4">
                <h3>Censo de Poblacion</h3>
                <iframe id='frmCPV' src='https://www.inegi.org.mx/widgets/cpv/2020/poblacion.html' frameborder='0' scrolling='no' width='240' height='350' ></iframe>
            </div>
        </div>
    </div>
    <div class="container"></div>
    <div class="container mt-5"></div>
    <!-- Carrusel -->
    <style>
        .carousel-item {
            text-align: center;
        }
        .carousel-caption {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            width: 45%; /* Se ajusta el ancho de cada tarjeta */
            margin: auto;
            display: inline-block; /* Se agrega para permitir que las tarjetas se muestren una al lado de la otra */
        }
    </style>
    <div class="container mt-5">
        <h1 class="text-center">Información de INEGI</h1>
        @if (isset($data['error']) && $data['error'])
            <div class="alert alert-danger" role="alert">
                Error: {{ $data['message'] }}
            </div>
        @else
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($data['Series'] as $key => $series)
                        @if ($key % 2 == 0) <!-- Abre un nuevo elemento del carrusel cada dos tarjetas -->
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <div class="card-deck"> <!-- Contenedor para las dos tarjetas -->
                        @endif
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Indicador: {{ $series['INDICADOR'] }}</h5>
                                            <table class="table table-striped">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Año</th>
                                                        <th>Valor</th>
                                                        <th>Estado</th>
                                                        <th>Area Geográfica</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($series['OBSERVATIONS'] as $observation)
                                                        <tr>
                                                            <td>{{ $observation['TIME_PERIOD'] }}</td>
                                                            <td>{{ round($observation['OBS_VALUE'], 2) }}</td>
                                                            <td>{{ $observation['OBS_STATUS'] }}</td>
                                                            <td>{{ $observation['COBER_GEO'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                        @if ($key % 2 != 0 || $loop->last) <!-- Cierra el elemento del carrusel cada dos tarjetas o en la última iteración -->
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        @endif
    </div>
    <!-- Incluir JavaScript de Bootstrap desde CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

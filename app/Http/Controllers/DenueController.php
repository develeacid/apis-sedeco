<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\DenueService;

class DenueController extends Controller
{
    protected $denueService;
    protected $inegiApiToken;

    public function __construct(DenueService $denueService)
    {
        $this->denueService = $denueService;
        $this->inegiApiToken = env('INEGI_API_TOKEN');
    }

    // Método para mostrar la página de inicio
    public function index()
    {
        return view('denue_search'); // Puedes cambiar 'welcome' por el nombre de tu vista de inicio
    }

    // Método para procesar la búsqueda
    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'cveEnt' => 'required',
            'posIni' => 'required|numeric',
            'posFin' => 'required|numeric',
        ]);

        $nombre = $validatedData['nombre'];
        $cveEnt = $validatedData['cveEnt'];
        $posIni = $validatedData['posIni'];
        $posFin = $validatedData['posFin'];

        $data = $this->denueService->search($nombre, $cveEnt, $posIni, $posFin);

        return view('denue.denue_search', ['data' => $data]);
    }
}
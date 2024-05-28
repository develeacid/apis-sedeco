<?php

namespace App\Http\Controllers;

use App\Services\InegiService;

use Illuminate\Http\Request;

class InegiController extends Controller
{
    protected $inegiService;

    public function __construct(InegiService $inegiService)
    {
        $this->inegiService = $inegiService;
    }

    public function show($idIndicador)
    {
        $data = $this->inegiService->getIndicator($idIndicador);
        return view('inegi.show', compact('data'));
    }
}

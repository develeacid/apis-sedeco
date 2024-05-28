<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class InegiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://www.inegi.org.mx/app/api/indicadores/desarrolladores/jsonxml/',
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function getIndicator($idIndicador, $idioma = 'es', $areaGeografica = '00', $recientes = 'true', $fuenteDatos = 'BISE', $version = '2.0', $type = 'json')
    {
        try {
            $url = sprintf('INDICATOR/%s/%s/%s/%s/%s/%s/%s?type=%s',
                $idIndicador, $idioma, $areaGeografica, $recientes, $fuenteDatos, $version, env('INEGI_API_TOKEN'), $type
            );

            $response = $this->client->request('GET', $url);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            // Manejo de errores
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}

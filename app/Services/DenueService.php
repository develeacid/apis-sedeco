<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class DenueService
{
    protected $client;
    protected $inegiApiToken;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://www.inegi.org.mx/app/api/denue/v1/consulta/',
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $this->inegiApiToken = env('INEGI_API_TOKEN');
    }

    public function search($nombre, $cveEnt, $posIni, $posFin)
    {
        try {
            $url = sprintf('nombre/%s/%s/%s/%s/%s', $nombre, $cveEnt, $posIni, $posFin, $this->inegiApiToken);

            $response = $this->client->request('GET', $url);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}

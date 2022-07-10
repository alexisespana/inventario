<?php

namespace App\Traits\Productos;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use function GuzzleHttp\Promise\exception_for;

trait ListarProductosTraits
{
    public function comunicServiceTraits($method, $url, $Params = [], $headers = [])
    {
        $client = new Client([
            'base_url' => $this->baseUrl,
        ]);
        try {
            $response = $client->request(
                $method,
                $this->baseUrl . $url,
                [
                    'json' => $Params

                ]
            );

            //   dd($response->getBody()->getContents());

            return $response->getBody()->getContents();
        } catch (RequestException $e) {


            $e->getResponse();
            dd('AHI UN ERROR', $e->getMessage());
        }
    }
}

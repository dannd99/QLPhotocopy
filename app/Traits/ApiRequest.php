<?php

namespace App\Traits;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

trait ApiRequest
{

    public function client()
    {
        return new Client([
            'headers' => [
                'Authorization' => 'Bearer ',
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    public function get($url)
    {
        try {
            $request = $this->client()->request('GET', $url);
            return $request->getBody()->getContents();
        } catch (GuzzleException $e) {
            return [
                'status' => false,
                'data' => [],
                'message' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }

    public function getWithData($url, $data)
    {
        try {
            $request = $this->client()->request('GET', $url, ['form_params' => $data]);
            return $request->getBody()->getContents();
        } catch (GuzzleException $e) {
            return [
                'status' => false,
                'data' => [],
                'message' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }

    public function post($url, $data)
    {
        try {
            $resquest = $this->client()->request('POST', $url, ['form_params' => $data]);
            return $resquest->getBody()->getContents();
        } catch (GuzzleException $e) {
            return [
                'status' => false,
                'data' => [],
                'message' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }

    public function put($url, $data)
    {
        try {
            $resquest = $this->client()->request('PUT', $url, ['form_params' => $data]);
            return $resquest->getBody()->getContents();
        } catch (GuzzleException $e) {
            return [
                'status' => false,
                'data' => [],
                'message' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }

    public function delete($url)
    {
        try {
            $resquest = $this->client()->request('DELETE', $url);
            return $resquest->getBody()->getContents();
        } catch (GuzzleException $e) {
            return [
                'status' => false,
                'data' => [],
                'message' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }

}

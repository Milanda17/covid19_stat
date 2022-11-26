<?php

function guzzleRequest($endpoint,$request_type='get',$params=[]): array
{
    try {
        $client = new \GuzzleHttp\Client();
        $response = $client->{$request_type}($endpoint, $params);
        $resp = json_decode($response->getBody()->getContents(), true);
        return ['success' => true, 'data' => $resp];
    } catch (Exception $exception) {
        return ['success' => false, 'errors' => $exception->getMessage()];
    }
}





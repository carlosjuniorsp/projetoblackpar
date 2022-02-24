<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\ClientException;

class HistoryController extends Controller
{
    /**
     * History a user search
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        try {
            $base_url = env('APP_URL');
            $client = new \GuzzleHttp\Client();
            $validationToken = session()->get('token');
            $response = $client->get(
                $base_url . '/history/' . $id,
                [
                    'headers'  => [
                        'Authorization' => 'Bearer ' . $validationToken
                    ]
                ]
            );

            if ($response->getBody()) {
                $data = json_decode($response->getBody()->getContents(), true);
                return view('history', ['data' => $data['result']]);
            }
        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);
            dd($error);
            return view('history', ['error' => $error]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class SearchController extends Controller
{
    /**
     * search the videos from youtube api
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $idUser = session()->get('id');
        try {
            $base_url = env('APP_URL');
            $client = new \GuzzleHttp\Client();
            $response = $client->get($base_url . '/search/userId/' . $idUser . '/' . $request->input('title') . '/' . $request->input('maxResults'));

            if ($response->getBody()) {
                $data = json_decode($response->getBody()->getContents(), true);
                return view('/search', ['data' => $data['data']]);
            }
        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);
            return view('/search', ['msg' => $error['error']['message']]);
        }
    }
}

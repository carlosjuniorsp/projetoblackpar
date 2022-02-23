<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class UserController extends Controller
{
    /**
     * login a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $base_url = env('APP_URL');
            $client = new \GuzzleHttp\Client();
            $response = $client->post(
                $base_url.'/login',
                array(
                    'form_params' => array(
                        'email' => $request->input('email'),
                        'password' => $request->input('password')
                    )
                )
            );

            if ($response->getBody()) {
                return redirect('/dasboard');
            }
        } catch (ClientException $e) {
            echo Psr7\Message::toString($e->getResponse());
        }
    }

    /**
     * create a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $base_url = env('APP_URL');
            $client = new \GuzzleHttp\Client();
            $response = $client->post(
                $base_url.'/user/register/',
                array(
                    'form_params' => array(
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'password' => $request->input('password'),
                        'phone' => $request->input('phone'),
                        'last_name' => $request->input('last_name'),
                        'type' => $request->input('type')
                    )
                )
            );

            if ($response->getBody()) {
                echo $response->getBody()->getContents();
            }
        } catch (ClientException $e) {
            echo Psr7\Message::toString($e->getResponse());
        }
    }
}

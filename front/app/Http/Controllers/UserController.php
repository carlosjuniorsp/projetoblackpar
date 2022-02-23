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
                $base_url . '/login',
                array(
                    'form_params' => array(
                        'email' => $request->input('email'),
                        'password' => $request->input('password')
                    )
                )
            );

            if ($response->getBody()) {
                $data = json_decode($response->getBody()->getContents(), true);
                return view('/index', ['user' => $data['user'], 'token' => $data['token'], 'type' => $data['type']]);
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
                $base_url . '/user/register/',
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
                $msg = json_decode($response->getBody()->getContents(), true);
                return view('/register', ['msg' => $msg['msg']]);
            }
        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);
            return view('/register', ['msg' => $error['error']]);
        }
    }
}

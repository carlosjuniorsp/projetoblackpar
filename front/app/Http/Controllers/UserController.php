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
                session(
                    [
                        'token' => $data['token'],
                        'user' => $data['user'],
                        'type' => $data['type']
                    ]
                );
                return redirect('/list-user');
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
                return redirect('/list-user');
            }
        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);
            return view('/register', ['msg' => $error['error']]);
        }
    }

    /**
     * show a newly showd resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try {
            $base_url = env('APP_URL');
            $client = new \GuzzleHttp\Client();
            $response = $client->get($base_url . '/user/list');


            if ($response->getBody()) {
                $msg = json_decode($response->getBody()->getContents(), true);
                return view('/listUser', ['msg' => $msg['result']]);
            }
        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);
            return view('/register', ['msg' => $error['error']]);
        }
    }

    /**
     * show a newly showd resource in storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function list(int $id)
    {
        try {
            $base_url = env('APP_URL');
            $client = new \GuzzleHttp\Client();
            $response = $client->get(
                $base_url . '/user/list/' . $id
            );
            if ($response->getBody()) {
                $users = json_decode($response->getBody()->getContents(), true);
                return view('/edit', ['users' => $users['result'][0]]);
            }
        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);
            return view('/edit', ['msg' => $error['error']]);
        }
    }

    /**
     * show a newly showd resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $base_url = env('APP_URL');
            $client = new \GuzzleHttp\Client();
            $response = $client->put(
                $base_url . '/user/update/' . $id,
                array(
                    'form_params' => array(
                        'name' => $request->input('name'),
                        'phone' => $request->input('phone'),
                        'last_name' => $request->input('last_name'),
                        'type' => $request->input('type')
                    )
                )
            );

            if ($response->getBody()) {
                $msg = json_decode($response->getBody()->getContents(), true);
                return redirect('/list-user');
            }
        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);
            return redirect('/list-user');
        }
    }

    public function delete($id)
    {
        try {
            $base_url = env('APP_URL');
            $client = new \GuzzleHttp\Client();
            $response = $client->delete($base_url . '/user/delete/' . $id);
            if ($response->getBody()) {
                $msg = json_decode($response->getBody()->getContents(), true);
                return redirect('/list-user');
            }
        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);
            return redirect('/list-user');
        }
    }
}

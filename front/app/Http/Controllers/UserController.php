<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyLogin')->except(['login']);
    }
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
                        'name' => $data['name'],
                        'type' => $data['type'],
                        'id' => $data['id'],
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
            $validationToken = session()->get('token');
            $client = new \GuzzleHttp\Client();
            $response = $client->post(
                $base_url . '/user/register/',
                [
                    'form_params' => [
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'password' => $request->input('password'),
                        'phone' => $request->input('phone'),
                        'last_name' => $request->input('last_name'),
                        'type' => $request->input('type'),
                    ],
                    'headers'  => [
                        'Authorization' => 'Bearer ' . $validationToken
                    ]
                ],
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
     * show all users
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
     * list a user
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
     * updated a user
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
            $validationToken = session()->get('token');
            $response = $client->put(
                $base_url . '/user/update/' . $id,
                [
                    'form_params' => [
                        'name' => $request->input('name'),
                        'phone' => $request->input('phone'),
                        'last_name' => $request->input('last_name'),
                        'type' => $request->input('type')
                    ],
                    'headers'  => [
                        'Authorization' => 'Bearer ' . $validationToken
                    ]
                ]
            );

            if ($response->getBody()) {
                return redirect('/list-user');
            }
        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);
            return redirect('/list-user', ['error' => $error]);
        }
    }

    /**
     * delete a user
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $base_url = env('APP_URL');
            $client = new \GuzzleHttp\Client();
            $validationToken = session()->get('token');
            $response = $client->delete(
                $base_url . '/user/delete/' . $id,
                [
                    'headers'  => ['Authorization' => 'Bearer ' . $validationToken]
                ]
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
    /**
     * Logout user
     */
    public function logout()
    {
        session()->forget(['token', 'id']);
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function callApi(Request $request)
    {
        //dd($request->all());
       $apiUserName = $request->apiUserName; 
       $apiPassword = $request->apiPassword;
       $apiMethod = $request->apiMethod;
       $apiUrl = $request->apiUrl;


       $data = Http::post('http://restapi.client.local/api/login', [
            'email' => $apiUserName,
            'password' => $apiPassword
        ]);
        $response = json_decode($data->getBody()->getContents());
        $token = $response->success->token;

        switch ($apiMethod) {
            case "GET":
              
                $data = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token
                ])->get($apiUrl);
                $posts = json_decode($data->getBody()->getContents());
                dd($posts);
              break;
            case "POST":
                $data = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token
                ])->post($apiUrl);
                $posts = json_decode($data->getBody()->getContents());
                dd($posts);
              break;
            case "DEL":
              echo "Your favorite color is green!";
              break;
            case "PUT":
              echo "Your favorite color is green!";
              break;
            default:
              echo "Your favorite color is neither red, blue, nor green!";
          }
        

        //dd($posts);

        return $response;

    }
}

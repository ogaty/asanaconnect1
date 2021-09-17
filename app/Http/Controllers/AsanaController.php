<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AsanaController extends Controller
{
    public function index() {
        // https://app.asana.com/-/oauth_authorize?response_type=code&client_id=1201003869298765&redirect_uri=https%3A%2F%2Fasanaconnect1.ogatism.com%2Fasana%2Fcallback&state=<STATE_PARAM>
        $params = [
            'response_type' => 'code',
            'client_id' => env('ASANA_CLIENT_ID'),
            'redirect_uri' => env('ASANA_CALLBACK_URL'),
            ];
            
        $query = http_build_query($params);
        
        return view('/asana/login', ['url' => env('ASANA_LOGIN_ENDPOINT_URL') . '?' . $query]);
    }
    
    public function callback(Request $request) {
        $data = [
            'grant_type' => 'authorization_code',
            'client_id' => env('ASANA_CLIENT_ID'),
            'client_secret' => env('ASANA_CLIENT_SECRET'),
            'code' => $request->input('code'),
            'redirect_uri' => 'https://asanaconnect1.ogatism.com/asana/callback',
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => env('ASANA_TOKEN_ENDPOINT_URL'),
          CURLOPT_SSL_VERIFYPEER => true,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => $data
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        Session::put('asana_token', $response);
        return redirect(route('asana.main'));
    }
    
    public function main() {
        $oauth = Session::get('asana_token');
        $result = json_decode($oauth, true);
        
        $headers = [
            'Accept: application/json',
            'Authorization: Bearer ' . $result['access_token'],
        ];
        // me
        /*
        $meUrl = env('ASANA_API_ENDPOINT_URL') . '/users/me';
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $meUrl,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
        ]);
        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);
        
        $gid = $result['data']['gid'];
        */

        // workspace一覧
        $workspaceUrl = env('ASANA_API_ENDPOINT_URL') . '/workspaces';
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $workspaceUrl,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
        ]);
        $response = curl_exec($curl);
        $workspaces = json_decode($response, true);
        curl_close($curl);
        return view('/asana/workspaces', ['workspaces' => $workspaces['data']]);
    }
    
    public function projects($id) {
        $oauth = Session::get('asana_token');
        $result = json_decode($oauth, true);

        $headers = [
            'Accept: application/json',
            'Authorization: Bearer ' . $result['access_token'],
        ];

        // projects一覧
        $projectsUrl = env('ASANA_API_ENDPOINT_URL') . '/projects?workspace=' . $id;
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $projectsUrl,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
        ]);
        $response = curl_exec($curl);
        $projects = json_decode($response, true);
        curl_close($curl);
        
        return view('/asana/projects', ['projects' => $projects['data']]);

    }
}

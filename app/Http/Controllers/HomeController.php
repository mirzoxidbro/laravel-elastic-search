<?php

namespace App\Http\Controllers;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function index()
    {
        $client = ClientBuilder::create()->build();
        // $params = [
        //     'index' => 'sample_index',
        //     'id' => 'sampleId',
        //     'body' => [
        //         'price' => '3400',
        //         'name' => 'sample product',
        //         'description' => 'my description'
        //     ]
        // ];

        $params = [
            'index' => 'favourite_candy',
            'id' => '1'
        ];

        $response = $client->get($params);
        return $response;
    }
}

// systemctl restart elasticsearch
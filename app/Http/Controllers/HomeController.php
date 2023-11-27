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
            'index' => 'user_search_analysis',
            'body'  => [
                "size" => 10,
                "from" => 20,
                "query"=> [
                    "multi_match" => [
                      "query" =>    "sotuvchi",
                      "fields" => [ "vacancies", "model_type"],
                    //   "fuzziness" => 2
                    ]
            ]
            ]
        ];
        $response = $client->search($params);

        $data['total_docs'] = $response['hits']['total']['value'];
        $data['max_score']  = $response['hits']['max_score'];
        $data['took']       = $response['took'];
        $data['hits']       = $response['hits']['hits'];
 
        return response()->json($data);
        

    }
}

// systemctl restart elasticsearch
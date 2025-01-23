<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tests extends AdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $arr15 = [];
        // $arr = array_merge($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10, $arr11, $arr12, $arr13, $arr14, $arr15);
        $arr = array_unique($arr15);
        // remove items containes taffarel.dev
        $arr = array_filter($arr, function ($item) {
            return strpos($item, 'taffarel.dev') === false && strpos($item, 'taffarel.local.dev') === false;
        });
        $urls = array_values($arr);
        // create request to 5 secounds
        $client = new \GuzzleHttp\Client();
        foreach ($urls as $url) {
            $response = $client->request('POST', $url, ['timeout' => 60]);
            // get data body from response
            echo $response->getBody(). '<br/>';
        }
    }
}

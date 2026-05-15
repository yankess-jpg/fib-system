<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'FBI System - Strona Główna',
        ];

        return view('public/home', $data);
    }

    public function recruitment()
    {
        $data = [
            'title' => 'Rekrutacja do FBI',
        ];

        return view('public/recruitment', $data);
    }

    public function informant()
    {
        $data = [
            'title' => 'Zostań Informatorem',
        ];

        return view('public/informant', $data);
    }
}
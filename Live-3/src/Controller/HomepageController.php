<?php

namespace App\Controller;

class HomepageController
{
    public function index(): array
    {
        return [
            'page' => 'index', // elle est obligatoire
            'title' => 'HomepageController',
            'user' => []
        ];
    }
}
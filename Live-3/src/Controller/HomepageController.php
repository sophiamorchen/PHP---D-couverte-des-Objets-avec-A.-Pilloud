<?php

namespace App\Controller;

class HomepageController extends AbstractController
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
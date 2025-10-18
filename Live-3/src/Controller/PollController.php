<?php

namespace App\Controller;

use App\Repository\PollRepository;

class PollController
{
    public function list()
    {

        $pollRepository = new PollRepository();

        return [
            'page' => 'polls/list',
            'polls' => $pollRepository->findAll(),

            ];
    }

    public function show(int $id)
    {
        $pollRepository = new PollRepository();

        return [
            'page' => 'polls/show',
            'poll' => $pollRepository->find($id),
        ];
    }
}
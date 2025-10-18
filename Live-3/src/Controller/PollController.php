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
    public function create(?array $postedData = null)
    {

        if($postedData){
            // from POST method
            $pollRepository = new PollRepository();
          if ($pollRepository->create($postedData['title'], $postedData['description'])) {
              // message de succès
          } else {
              // message d'erreur
          }
            header('location:/poll/list');
        }
        return [
            'page' => 'polls/create',

        ];
    }
}

              

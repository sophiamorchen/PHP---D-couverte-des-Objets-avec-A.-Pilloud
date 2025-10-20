<?php

namespace App\Controller;

use App\Repository\PollRepository;

class PollController extends AbstractController
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
              $this->addFlash('success_message', 'Sondage crée');
          } else {
              // message d'erreur
              $this->addFlash('error_message', 'Une erreur est survenue');
          }
          return $this->redirectToUri('/poll/list');
        }
        return [
            'page' => 'polls/create',


            ];

    }

}



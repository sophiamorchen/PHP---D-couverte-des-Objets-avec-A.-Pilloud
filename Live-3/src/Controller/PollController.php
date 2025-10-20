<?php

namespace App\Controller;

// On importe la classe PollRepository, qui permet d’interagir avec la base de données
use App\Repository\PollRepository;

/**
 * Contrôleur des sondages (polls)
 * Gère les pages : liste, création, affichage et modification d’un sondage.
 */
class PollController extends AbstractController
{
    /**
     * Page : Liste de tous les sondages
     */
    public function list()
    {
        // On crée une instance du repository pour accéder aux sondages en base
        $pollRepository = new PollRepository();

        // On renvoie un tableau de données à la vue (souvent traité dans un "render")
        // - 'page' indique le template à afficher
        // - 'polls' contient la liste de tous les sondages trouvés
        return [
            'page' => 'polls/list',
            'polls' => $pollRepository->findAll(),
        ];
    }

    /**
     * Page : Affichage d’un sondage unique (par son ID)
     */
    public function show(int $id)
    {
        // On instancie le repository
        $pollRepository = new PollRepository();

        // On retourne les infos du sondage demandé
        return [
            'page' => 'polls/show',      // la page à afficher
            'poll' => $pollRepository->find($id),  // le sondage trouvé par son ID
        ];
    }

    /**
     * Page : Création d’un nouveau sondage
     * - Si $postedData est fourni (POST), on tente de créer un sondage
     * - Sinon, on affiche juste la page de création
     */
    public function create(?array $postedData = null)
    {
        // Si des données ont été envoyées via un formulaire (méthode POST)
        if ($postedData) {
            // On crée une instance du repository pour insérer un nouveau sondage
            $pollRepository = new PollRepository();

            // On appelle la méthode create du repository en lui passant les champs du formulaire
            if ($pollRepository->create($postedData['title'], $postedData['description'])) {
                // Si la création réussit → on stocke un message flash de succès
                $this->addFlash('success_message', 'Sondage créé');
            } else {
                // Sinon → on stocke un message flash d’erreur
                $this->addFlash('error_message', 'Une erreur est survenue');
            }

            // Après traitement, on redirige l’utilisateur vers la page de liste des sondages
            return $this->redirectToUri('/poll/list');
        }

        // Si aucune donnée n’a été postée, on affiche simplement le formulaire de création
        return [
            'page' => 'polls/create',
        ];
    }

    /**
     * Page : Édition (modification) d’un sondage existant
     * - $id : identifiant du sondage à modifier
     * - $postedData : données POST envoyées par le formulaire (ou null si on vient d’arriver sur la page)
     */
    public function edit(int $id, ?array $postedData = null)
    {
        // On instancie le repository pour récupérer le sondage à modifier
        $pollRepository = new PollRepository();
        $poll = $pollRepository->find($id); // Récupération du sondage existant

        // Si le formulaire a été soumis
        if ($postedData) {
            // On met à jour les propriétés de l’objet sondage
            // ⚠ Comme on utilise FETCH_OBJ dans le repository, on modifie directement les propriétés de l’objet
            $poll->title = $postedData['title'];
            $poll->description = $postedData['description'];

            // On enregistre les modifications dans la base via la méthode update()
            if ($pollRepository->update($poll)) {
                // Message flash de succès
                $this->addFlash('success_message', 'Sondage mis à jour');
            } else {
                // Message flash d’erreur
                $this->addFlash('error_message', 'Une erreur est survenue');
            }

            // Après mise à jour, on redirige vers la liste des sondages
            return $this->redirectToUri('/poll/show/'.$id);
        }

        // Si on arrive sur la page sans POST, on affiche le formulaire pré-rempli avec le sondage existant
        return [
            'page' => 'polls/edit',
            'poll' => $pollRepository->find($id), // On repasse le sondage à la vue
        ];
    }
}

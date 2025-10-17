<?php
// On commence une boucle foreach en PHP.
// Elle parcourt le tableau $data['polls'] s’il existe.
// Si $data['polls'] n’existe pas ou vaut null, alors on utilise un tableau vide [] grâce à l’opérateur "?? []".
// Cela évite une erreur de type "Invalid argument supplied for foreach()".
// À chaque tour de boucle, la variable $poll contient un objet ou un tableau représentant un sondage (poll).
foreach($data['polls'] ?? [] as $poll):
    ?>
    <div>
        <!-- On crée un lien <a> cliquable pour chaque sondage -->
        <!-- href="/articles/show/< echo $poll->id ?>" :
             Cette partie génère une URL de type /articles/show/1 ou /articles/show/2 selon l'ID du sondage.
             /articles → c’est la “section” ou le “contrôleur” (ArticlesController)
             show → c’est l’action ou la méthode à exécuter (ex: function show($id))
             < echo $poll->id ?> → affiche dynamiquement l’identifiant unique du sondage dans l’URL.
             Ce lien pointera donc vers la page de détail de chaque sondage. -->
        <a href="/poll/show/<?php echo $poll->id ?>">
            <!-- À l’intérieur du lien, on affiche le titre du sondage -->
            <?php echo $poll->title ?>
        </a>
    </div>
<?php
// Fin de la boucle foreach : on a donc généré un <div> + un lien pour chaque sondage trouvé.
endforeach;
?>



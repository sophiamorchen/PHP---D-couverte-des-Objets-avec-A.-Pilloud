<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ma page</title>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/poll/list">Liste des sondages</a></li>
                </ul>
            </nav>
        </header>

        <?php if ($data['success_message']) { ?>
            <div style="background-color: darkgreen"><?php echo $data['success_message'] ?></div>
        <?php } ?>

        <?php if($data['error_message']) { ?>

            <div style="background-color: darkred"><?php echo $data['error_message'] ?></div>
        <?php } ?>


        <main>
           <?php require_once 'pages/'.$page.'.php'; ?>
        </main>
    <footer>

    </footer>
    </body>
</html>
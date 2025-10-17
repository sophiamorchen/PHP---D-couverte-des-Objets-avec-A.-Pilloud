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
                    <li><a href="">Ma page</a></li>
                </ul>
            </nav>
        </header>
        <main>
           <?php require_once 'pages/'.$page.'.php'; ?>
        </main>
    <footer>

    </footer>
    </body>
</html>
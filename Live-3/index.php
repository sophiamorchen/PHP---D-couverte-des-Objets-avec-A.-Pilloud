

<?php

use App\Repository\PollRepository;

require_once 'vendor/autoload.php';


$PollManager = new PollRepository();

foreach ($PollManager->findAll() as $poll) {
    echo '- ' .  $poll->description . '<br>';
}




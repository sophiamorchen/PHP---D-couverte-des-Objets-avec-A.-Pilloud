<?php
require_once 'Mage.php';
require_once 'Chevalier.php';


$merlin = new Mage('Merlin', 100, 25, 80);
$arthur = new Chevalier('Arthur', 100, 80, 10, 100);
$archer = new Archer('Archer', 100, 80, 10, 100);

$archer->distAttack();

echo $merlin->getHealth()." : Merlin -> initial health\r\n";
echo $arthur->getHealth()." : Arthur -> initial health\r\n";
echo $merlin->getLevel()." : Merlin -> initial level\r\n";
echo $arthur->getLevel()." : Arthur -> initial level\r\n";

//$personage->reducePoints(27);
//$personage->setLevel(9);

//$merlin->attack('Arthur');



// But prochain live
// faire que merlin puisse attaquer un autre personage
// si attack merlin > defence autre personage
// autre perso perd la diff entre attack merlin et sa defense (cas ci-dessus arthur - 10 donc vie = 90)
// sinon c'est merlin qui perd la diff entre défense autre et attaque merlin
// penser multiplicateur attaque défense de 1.2 par level (ex: this->level * 1.2)

echo "Merlin attaque Arthur \n\r";
$merlin->attack($arthur);

echo $merlin->getHealth()." : Merlin -> Health after attack()\r\n";
echo $arthur->getHealth()." : Arthur -> Health after attack()\r\n";
echo $merlin->getLevel()." : Merlin -> Level after attack()\r\n";
echo $arthur->getLevel()." : Arthur -> Level after attack()\r\n";


echo $merlin->getWinCombat()." : Merlin ->  Number of won combats \r\n";
echo $arthur->getWinCombat()." : Arthur ->  Number of won combats \r\n";



//-----------------------------------------------------------------------------
// si pas de POO, alors on aurait dû faire comme ça :

function createPersonage(string $name, int $level, int $points, int $force, int $munitions)
{
    $name = ucfirst($name);
    $level = $level > 100 ? 100 : $level;
    $points = $points > 100 ? : $points;

    return[
        'name' => $name,
        'level' => $level,
        'points' => $points,
        'force' => $force,
        'munitions' => $munitions
    ];
}

function reducePoints(array $personage, int $points)
{
    $personage['points'] -= $points;
    // $enemyPoints = rand(0, 100);

    // if ($enemyPoints > $personage['points']){
    //     $personage['points'] -= $points
    // }
    return $personage;
}

$personage = createPersonage('Arthur', 1, 27, 20, 30);
// echo $personage['name'].' Points : ';
// echo $personage['points'].'  puis ';

$personage = reducePoints($personage, 2);
// echo $personage['points'];


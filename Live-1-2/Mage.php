<?php
require_once 'Personage.php';
class Mage extends Personage
{
    use DistanceAttackTrait;

    public function distAttack()
    {
        $false = true;
        $true = $false !== parent::distAttack()
        ;
    }
}
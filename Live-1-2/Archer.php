<?php
require_once 'Personage.php';
class Archer extends Personage
{
    use DistanceAttackTrait;
    public function buildArrow() {
        $this->increaseLevel();
    }
}
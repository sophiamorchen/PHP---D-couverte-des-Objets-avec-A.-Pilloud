<?php
class Personage
{
    private ?int $winCombat = 0;
    private const MIN_HEALTH = 10;
    private const MIN_LEVEL = 1;
    private const MAX_LEVEL = 100;
    public const ATTACK_ACTION_KEY = 'attack';
    private const DEFENSE_ACTION_KEY = 'defense';

    public function __construct(
        private string $name,
        private int $health,
        private int $attack,
        private int $defense,
        private int $level = self::MIN_LEVEL,
        ) {

    }

    public function attack(Personage $enemy): void
    {
        // $this win combat
        if ($this->attack > $enemy->getDefense()) {
            // 100 - (20 - 10)
            $enemy->setHealth($enemy->getHealth() - ($this->attack - $enemy->getDefense()));
            $this->increaseLevel(self::ATTACK_ACTION_KEY);
            $enemy->decreaseLevel();
            // on ne met pas this->level -- ou ++ car on toucherait à la propriété directe du personage, sans passer
            // par le setter ou le getter, on ne passerait pas par nos vérifications (ex: > 100 ou < 0)
            $this->increaseWinCombat();
            $enemy->decreaseWinCombat();
        } else {
            $this->setHealth($this->getHealth() -  ($enemy->getDefense() - $this->attack));
            $this->decreaseLevel();
            $enemy->increaseLevel(self::DEFENSE_ACTION_KEY);
            $enemy->increaseWinCombat();
            $this->decreaseWinCombat();


        }
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setHealth(int $health): self
    {
        // ici, si le personnage a sa Health en dessous de 10 (qui est la valeur minimale)
        // alors il a 0, et donc il a perdu. Cela nous permet de ne pas laisser "traîner" des personages incapables
        // de jouer, dans le jeu.
       $this->health = $health < self::MIN_HEALTH ? 0 : $health;
       return $this;
        // autre façon :  $this->health = max($health, 0);
    }

    public function getAttack(): int
    {
        return $this->attack;
    }

    public function setAttack(int $attack): self
    {
        $this->attack = $attack;
        return $this;
    }

    public function getDefense(): int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;
        return $this;
    }
    public function getWinCombat(): int
    {
        return $this->winCombat;
    }
    public function increaseWinCombat(): self
    {
        $this->winCombat++;
        return $this;
    }
    public function decreaseWinCombat(): self
    {
        $this->winCombat--;
        if($this->winCombat <= 0) {
            $this->winCombat = 0;
        }
        return $this;
    }

    protected function increaseLevel(?string $type = null): void
        // Le ? permet d’accepter explicitement null.
        //Le = null permet de ne pas obliger l’appelant à passer un argument.
    {
        if(self::ATTACK_ACTION_KEY === $type){
            $this->level +=2;
        } elseif(self::DEFENSE_ACTION_KEY === $type){
           $this->level += 3;
        }else {
            $this->level++;
    }
        if($this->level > self::MAX_LEVEL){
            $this->level = self::MAX_LEVEL;
        }
    }
    private function decreaseLevel() :void
    {
        $this->level--;

        if($this->level < self::MIN_LEVEL){
            $this->level = self::MIN_LEVEL;
        }
    }


}
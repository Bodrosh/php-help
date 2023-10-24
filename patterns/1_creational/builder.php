<?php
class Burger {
    private bool $peperoni = false;
    private bool $tomato = false;
    public function __construct(BurgerBuilder $builder)
    {
        $this->peperoni = $builder->peperoni;
        $this->tomato = $builder->tomato;
    }
}

class BurgerBuilder {
    public bool $peperoni = false;
    public bool $tomato = false;
    public function addPepperoni(): self
    {
        $this->peperoni = true;
        return $this;
    }
    public function addTomato(): self
    {
        $this->tomato = true;
        return $this;
    }
    public function build()
    {
        return new Burger($this);
    }
}

$builder = new BurgerBuilder();
$burger = $builder->addPepperoni()->build();

var_dump($burger);
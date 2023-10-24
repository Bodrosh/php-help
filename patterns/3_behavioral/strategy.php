<?php
// В зависимости от условия запускаются разные стратегии
interface Definer
{
    public function define(string $str): string;

}
class BoolDefiner implements Definer
{
    public function define(string $arg): string
    {
        return $arg . ' from bool strategy';
    }
}
class IntDefiner implements Definer
{
    public function define(string $arg): string
    {
        return $arg . ' from int strategy';
    }
}
class Data
{
    private Definer $definer;
    private string $arg;

    public function __construct(Definer $definer)
    {
        $this->definer = $definer;
    }
    public function setArg(string $arg)
    {
        $this->arg = $arg;
    }

    public function executeStrategy()
    {
        return $this->definer->define($this->arg);
    }
}

$data = new Data(new BoolDefiner());
$data = new Data(new IntDefiner());
$data->setArg('some arg');
var_dump($data->executeStrategy());
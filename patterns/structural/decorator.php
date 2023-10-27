<?php
// Класс является точкой, откуда будут запускаться методы другого класса
interface Worker
{
    public function countSalary();
}

class Developer implements Worker
{
    public function countSalary()
    {
        return 3000 * 20;
    }
}
abstract class WorkerDecorator implements Worker
{
    protected Worker $worker;
    public function __construct(Worker $worker)
    {
        $this->worker = $worker;
    }
}
class DeveloperOverTime extends WorkerDecorator
{
    public function countSalary()
    {
        $salary = $this->worker->countSalary();
        return $salary + $salary * 0.2;
    }
}

$developer = new Developer();
$developerOverTime = new DeveloperOverTime($developer);

var_dump($developer->countSalary());
var_dump($developerOverTime->countSalary());

<?php
// Чтобы не вызывать методы самого объекта напрямую
interface Worker
{
    public function closedHours(int $hours): void;
    public function countSalary(): int;
}

class WorkerOutsource implements Worker
{
    private array $hours = [];
    public function closedHours(int $hours): void
    {
        $this->hours[] = $hours;
    }
    public function countSalary(): int
    {
        return array_sum($this->hours) * 500;
    }
}
class WorkerProxy extends WorkerOutsource implements Worker
{
    private int $salary = 0;
    public function countSalary(): int
    {
        if ($this->salary === 0)
            $this->salary = parent::countSalary();
        return $this->salary;
    }
}

$workerProxy = new WorkerProxy();
$workerProxy->closedHours(10);
$workerProxy->closedHours(10);
$salary = $workerProxy->countSalary(); // Посчитает только здесь, дальше будет всегда возвращать
$workerProxy->closedHours(10);
$workerProxy->closedHours(10);
$workerProxy->closedHours(10);
$salary = $workerProxy->countSalary();

var_dump($salary);
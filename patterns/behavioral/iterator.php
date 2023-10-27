<?php
// Какой-то список, обращаться к нему, получать следующий элемент.

class WorkerList
{
    private array $workers = [];
    private int $index = 0;
    public function setWorkers(Worker ...$workers): void
    {
        $this->workers = $workers;
    }

    public function getItem(): ?Worker
    {
        return $this->workers[$this->index] ?? null;
    }

    public function next()
    {
        if (isset($this->workers[$this->index + 1])) {
            $this->index++;
        }
    }

    public function prev()
    {
        if ($this->index === 0) return;
        $this->index--;
    }

    // можно добавить методы getById, refresh и т.д.
}

class Worker
{
    public string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

$worker1 = new Worker('Ivan');
$worker2 = new Worker('Masha');
$worker3 = new Worker('Stepan');

$workerList = new WorkerList();
$workerList->setWorkers($worker1, $worker2, $worker3);
$workerList->next();
$workerList->next();
var_dump($workerList->getItem()->name);
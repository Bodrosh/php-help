<?php
// Через класс фасад дергаются методы других классов
interface Worker
{
    public function startWork(): void;
    public function stopWork(): void;
}

class Developer implements Worker
{
    public function startWork(): void
    {
        printf('Developer start' . PHP_EOL);
    }

    public function stopWork(): void
    {
        printf('Developer stop' . PHP_EOL);
    }
}

class Designer implements Worker
{
    public function startWork(): void
    {
        printf('Designer start' . PHP_EOL);
    }

    public function stopWork(): void
    {
        printf('Designer stop' . PHP_EOL);
    }
}

class WorkerFacade implements Worker
{
    /**
     * @var Worker[]
     */
    private array $workers;
    public function __construct(...$workers)
    {
        $this->workers = $workers;
    }

    public function startWork(): void
    {
        foreach ($this->workers as $worker) {
            $worker->startWork();
        }
    }
    public function stopWork(): void
    {
        foreach ($this->workers as $worker) {
            $worker->stopWork();
        }
    }
}

$developer = new Developer();
$designer = new Designer();

$workerFacade = new WorkerFacade($developer, $designer);

$workerFacade->startWork();
$workerFacade->stopWork();
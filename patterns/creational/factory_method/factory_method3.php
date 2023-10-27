<?php
interface Worker
{
    public function work(): void;
}

class Developer implements Worker
{
    public function work(): void
    {
        printf('I am developer.' . PHP_EOL);
    }
}

class Designer implements Worker
{
    public function work(): void
    {
        printf('I am designer.' . PHP_EOL);
    }
}

class WorkerFactory
{
    public function makeDeveloper(): Developer
    {
        return new Developer();
    }

    public function makeDesigner(): Designer
    {
        return new Designer();
    }
}

$workerFactory = new WorkerFactory();
$designer = $workerFactory->makeDesigner();
$developer = $workerFactory->makeDeveloper();

$designer->work();
$developer->work();
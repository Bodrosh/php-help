<?php
// Классы связаны, если один не в состоянии выполнить, делегирует другому.
// Jun не в состоянии выполнить, задача передается Middle, Senior

abstract class Developer
{
    private ?Developer $levelUpDeveloper;

    public function __construct(?Developer $levelUpDeveloper)
    {
        $this->levelUpDeveloper = $levelUpDeveloper;
    }

    abstract public function canSolveTask(TaskInterface $task): bool;

    final public function solveTask(TaskInterface $task)
    {
        if (!$this->canSolveTask($task) && $this->levelUpDeveloper) {
            $this->levelUpDeveloper->solveTask($task);
            return;
        }
        $task->getResult($this);
    }
}

class Senior extends Developer
{
    public function canSolveTask(TaskInterface $task): bool
    {
        return true;
    }
}

class Middle extends Developer
{
    public function canSolveTask(TaskInterface $task): bool
    {
        return true;
    }
}

class Junior extends Developer
{
    public function canSolveTask(TaskInterface $task): bool
    {
        return false;
    }
}

interface TaskInterface
{
    public function getResult(Developer $developer): void;
}

class DevTask implements TaskInterface
{
    public function getResult(Developer $developer): void
    {
        printf($developer::class . ', status: Good calc' . PHP_EOL);
    }
}

$tack = new DevTask();

$senior = new Senior(null);
$middle = new Middle($senior);
$junior = new Junior($middle);

$junior->solveTask($tack);
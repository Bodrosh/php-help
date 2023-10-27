<?php
// Управление состоянием
class Task
{
    public State $state;
    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public static function make()
    {
        return new self(new Created());
    }

    public function processedToNext()
    {
        $this->state = $this->state->nextState();
    }

    public function getState(): State
    {
        return $this->state;
    }

}

interface State
{
    public function getStatus(): string;
    public function nextState(): State;
}

class Created implements State
{
    public function getStatus(): string
    {
        return 'created';
    }

    public function nextState(): State
    {
        return new Process();
    }
}

class Process implements State
{
    public function getStatus(): string
    {
        return 'process';
    }

    public function nextState(): State
    {
        return new Done();
    }
}

class Done implements State
{
    public function getStatus(): string
    {
        return 'done';
    }

    public function nextState(): State
    {
        return $this;
    }
}

$task = Task::make();
$task->processedToNext();
$task->processedToNext();
$task->processedToNext();
$task->processedToNext();
var_dump($task->getState()->getStatus());
<?php
class Memento
{
 private State $state;
    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function getState(): State
    {
        return $this->state;
    }
}

class State
{
    public const CREATED = 'created';
    public const PROCESS = 'process';
    public const DONE = 'done';
    private string $state;
    public function __construct(string $state)
    {
        $this->state = $state;
    }
}

class Task
{
    private State $state;

    public function create(): void
    {
        $this->state = new State(State::CREATED);
    }

    public function process(): void
    {
        $this->state = new State(State::PROCESS);
    }

    public function done(): void
    {
        $this->state = new State(State::DONE);
    }

    public function saveToMemento(): Memento
    {
        return new Memento($this->state);
    }

    public function restoreFromMemento(Memento $memento)
    {
        $this->state = $memento->getState();
    }

    public function getState(): State
    {
        return $this->state;
    }
}

$task = new Task();
$task->create();
$memento = $task->saveToMemento();
$task->done();
$task->restoreFromMemento($memento);

var_dump($memento->getState() === $task->getState());
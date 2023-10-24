<?php
interface Command
{
    public function execute();
}
interface Undoable extends Command
{
    public function undo();
}

class Output
{
    private bool $isWriteable = false;
    private string $body = '';

    public function enable()
    {
        $this->isWriteable = true;
    }

    public function disable()
    {
        $this->isWriteable = false;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function write(string $body)
    {
        if ($this->isWriteable) {
            $this->body = $body;
        }
    }
}

class Invoker
{
    private Command $command;

    public function run()
    {
        $this->command->execute();
    }

    public function setCommand(Command $command): void
    {
        $this->command = $command;
    }
}

class Message implements Command
{
    private Output $output;
    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function execute()
    {
        $this->output->write('some string');
    }
}

class ChangerStatus implements Undoable
{
    private Output $output;
    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function execute()
    {
        $this->output->enable();
    }

    public function undo()
    {
        $this->output->disable();
    }
}

$output = new Output();

//$invoker = new Invoker();
$message = new Message($output);
$changerStatus = new ChangerStatus($output);
$changerStatus->execute();
$message->execute();

var_dump($output->getBody());
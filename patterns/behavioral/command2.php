<?php
// Когда нужно отделить вызывателя (invoker) и получателя (receiver)
class Lamp
{
    public function turnOn(): void
    {
        printf('Lamp turn on');
    }

    public function turnOff(): void
    {
        printf('Lamp turn off');
    }
}

interface Command
{
    public function execute(): void;
}

abstract class CommonCommand implements Command
{
    protected Lamp $lamp;
    public function __construct(Lamp $lamp)
    {
        $this->lamp = $lamp;
    }
}

class TurnOnCommand extends CommonCommand
{
    public function execute(): void
    {
        $this->lamp->turnOn();
    }
}

class TurnOffCommand extends CommonCommand
{
    public function execute(): void
    {
        $this->lamp->turnOff();
    }
}

class LampCommandFactory
{
    public static function make(Lamp $lamp, $command): CommonCommand
    {
        return match ($command) {
            'ON' => new TurnOnCommand($lamp),
            default => new TurnOffCommand($lamp),
        };
    }
}

$lamp = new Lamp();
$lampCommandFactory = LampCommandFactory::make($lamp, 'ON');
$lampCommandFactory->execute();



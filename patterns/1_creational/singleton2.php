<?php

final class Connection {
    private static ?self $instance = null;
    private string $name = '';
    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function __clone(): void
    {
        // TODO: Implement __clone() method.
    }

    public function __wakeup(): void
    {
        // TODO: Implement __wakeup() method.
    }
}

$connection = Connection::getInstance();
$connection->setName('Иван');

$connection2 = Connection::getInstance();
var_dump($connection2->getName());
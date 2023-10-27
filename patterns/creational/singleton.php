<?php
class Connection {
    public static ?self $instance = null; // типа self, если есть
    public string $name;

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

$connection = Connection::getInstance();
$connection->name = 'Laravel';
var_dump($connection);

$connection2 = Connection::getInstance();
var_dump($connection2);
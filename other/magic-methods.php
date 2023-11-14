<?php
class Worker
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
        var_dump('__construct', $this);
    }

    public function __destruct()
    {
        var_dump('__destruct', $this);
    }
    public function __get(string $property)
    {
        var_dump('__get', $property, $this);
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __toString(): string
    {
        return json_encode($this);
    }

    public function __invoke()
    {
        var_dump('__invoke');
    }
}

$worker = new Worker('Vasya');

echo $worker();

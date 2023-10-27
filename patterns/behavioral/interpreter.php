<?php
// Есть несколько вариантов интерпретации выражения
abstract class Expression // Работать с выражениями
{
    abstract public function interpret(Context $context): bool;
}

class Context // В рамках чего все будет работать
{
    private array $workers = [];

    public function setWorker(string $worker): void
    {
        $this->workers[] = $worker;
    }

    public function find($key): bool|string
    {
        return $this->workers[$key] ?? false;
    }
}

class VariableExp extends Expression
{
    private int $key;

    public function __construct(int $key)
    {
        $this->key = $key;
    }

    public function interpret(Context $context): bool
    {
        return $context->find($this->key);
    }
}

class AndExp extends Expression
{
    private int $keyOne;
    private int $keyTwo;
    public function __construct(int $keyOne, int $keyTwo)
    {
        $this->keyOne = $keyOne;
        $this->keyTwo = $keyTwo;
    }

    public function interpret(Context $context): bool
    {
        return $context->find($this->keyOne) && $context->find($this->keyTwo);
    }
}

class OrExp extends Expression
{
    private int $keyOne;
    private int $keyTwo;
    public function __construct(int $keyOne, int $keyTwo)
    {
        $this->keyOne = $keyOne;
        $this->keyTwo = $keyTwo;
    }

    public function interpret(Context $context): bool
    {
        return $context->find($this->keyOne) || $context->find($this->keyTwo);
    }
}

$context = new Context();
$context->setWorker('Ivan');
$context->setWorker('Kate');
$context->setWorker('Mary');

$varExp = new VariableExp(1);
$andExp = new AndExp(1, 3);
$orExp = new OrExp(10, 5);

var_dump($varExp->interpret($context));
var_dump($andExp->interpret($context));
var_dump($orExp->interpret($context));
<?php
interface Worker {
    public function work(): string;
}

class Developer implements Worker {
    public function work(): string
    {
        return  'My job is develop';
    }
}

class Designer implements Worker {
    public function work(): string
    {
        return  'My job is design';
    }
}

class WorkerFactory {
    public static function make(string $type): Worker
    {
        $className = strtoupper($type);
        if (class_exists($className)) {
            return new $className();
        }
        throw new \Exception('Class not found!');
    }
}

$worker = WorkerFactory::make('designer');
var_dump($worker->work());
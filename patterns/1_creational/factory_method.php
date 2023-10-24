<?php
interface Worker2 {
    public function work(): string;
}

class Developer2 implements Worker2 {

    public function work(): string {
       return 'Developer, Разрабатываю ПО';
    }
}
class Tester2 implements Worker2 {
    public function work(): string {
        return 'Tester, Тестирую ПО';
    }
}

class Worker2Factory {
    public static function make(string $type) {
        return match ($type) {
            'developer' => new Developer2(),
            default => new Tester2(),
        };
    }
}

$employees[] = Worker2Factory::make('developer');
$employees[] = Worker2Factory::make('tester');

foreach ($employees as $employee) {
    var_dump($employee->work());
}
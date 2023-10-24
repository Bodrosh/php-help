<?php
interface Worker {
    public function work(): string;
}

class Developer implements Worker {
    public function work(): string
    {
        return 'My job is develop';
    }
}

class Designer implements Worker {
    public function work(): string
    {
        return 'My job is design';
    }
}

interface Factory {
    public static function make();
}
class DeveloperFactory implements Factory {
    public static function make(): Developer
    {
        return new Developer();
    }
}

class DesignerFactory implements Factory {
    public static function make(): Designer
    {
        return new Designer();
    }
}

$developer = DeveloperFactory::make();
$designer = DesignerFactory::make();

var_dump($developer->work());
var_dump($designer->work());
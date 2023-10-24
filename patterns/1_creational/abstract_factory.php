<?php
interface Worker3 {
    public function work(): string;
}
abstract class WorkerAbstract {
    public string $workPlace;
    public function __construct($workPlace) {
        $this->workPlace = $workPlace;
    }
}
class DeveloperWorker3 extends WorkerAbstract implements Worker3 {
    public function work(): string {
       return 'Я Разработчик, место работы: ' . $this->workPlace;
    }
}

class TesterWorker3 extends WorkerAbstract implements Worker3 {
    public function work(): string {
        return 'Я Тестер, место работы: ' . $this->workPlace;
    }
}

interface AbstractFactory {
    public static function makeTesterWorker(): TesterWorker3;
    public static function makeDeveloperWorker(): DeveloperWorker3;
}

class HomeWorkerFactory implements AbstractFactory {
    public static function makeTesterWorker(): TesterWorker3 {
        return new TesterWorker3('Дом');
    }

    public static function makeDeveloperWorker(): DeveloperWorker3 {
        return new DeveloperWorker3('Дом');
    }
}

class OfficeWorkerFactory implements AbstractFactory {
    public static function makeTesterWorker(): TesterWorker3 {
        return new TesterWorker3('Офис');
    }

    public static function makeDeveloperWorker(): DeveloperWorker3 {
        return new DeveloperWorker3('Офис');
    }
}

var_dump(HomeWorkerFactory::makeDeveloperWorker()->work());
var_dump(HomeWorkerFactory::makeTesterWorker()->work());
var_dump(OfficeWorkerFactory::makeDeveloperWorker()->work());
var_dump(OfficeWorkerFactory::makeTesterWorker()->work());

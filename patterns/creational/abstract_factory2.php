<?php
interface Worker {
    public function work(): void;
}

class Developer implements Worker {
    private string $type = '';
    public function __construct($type = 'outsource')
    {
        $this->type = $type;
    }

    public function work(): void
    {
        var_dump("My job is develop ({$this->type})");
    }
}

class Designer implements Worker {
    private string $type = '';
    public function __construct($type = 'outsource')
    {
        $this->type = $type;
    }
    public function work(): void
    {
        var_dump("My job is design ({$this->type})");
    }
}

interface AbstractWorkerFactory {
    public static function makeDeveloperWorker(): Developer;
    public static function makeDesignerWorker(): Designer;
}

class NativeWorkerFactory implements AbstractWorkerFactory {

    public static function makeDeveloperWorker(): Developer
    {
       return new Developer('native');
    }

    public static function makeDesignerWorker(): Designer
    {
        return new Designer('native');
    }
}

class OutsourceWorkerFactory implements AbstractWorkerFactory {

    public static function makeDeveloperWorker(): Developer
    {
        return new Developer();
    }

    public static function makeDesignerWorker(): Designer
    {
        return new Designer();
    }
}

NativeWorkerFactory::makeDeveloperWorker()->work();
NativeWorkerFactory::makeDesignerWorker()->work();
OutsourceWorkerFactory::makeDeveloperWorker()->work();
OutsourceWorkerFactory::makeDesignerWorker()->work();
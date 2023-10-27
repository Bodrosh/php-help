<?php

class Worker {

}

class WorkerPool {
    private array $freeWorkers = [];
    private array $busyWorkers = [];
    public function getWorker(): Worker
    {
        if (count($this->freeWorkers)) {
            $worker = array_pop($this->freeWorkers);
        }
        else {
            $worker = new Worker();
        }
        $this->busyWorkers[spl_object_hash($worker)] = $worker;
        return $worker;
    }

    public function release(Worker $worker): bool
    {
        $key = spl_object_hash($worker);
        if (!isset($this->busyWorkers[$key])) {
            var_dump('worker not found in busyWorkers');
            return false;
        }
        unset($this->busyWorkers[$key]);
        $this->freeWorkers[$key] = $worker;
        return true;
    }

    public function getFreeWorkers()
    {
        return $this->freeWorkers;
    }
    public function getBuzyWorkers()
    {
        return $this->busyWorkers;
    }
}




$pool = new WorkerPool();

$woker = $pool->getWorker();
$woker2 = $pool->getWorker();
$woker3 = $pool->getWorker();

var_dump($woker);
$pool->release($woker2);

$woker4 = $pool->getWorker();
//
var_dump($woker4);
var_dump($pool->getFreeWorkers());
<?php
// Наблюдатель - (watch), в php есть встроенные интерфейсы
class Worker implements SplSubject
{
    private SplObjectStorage $observers;
    private string $name = '';
    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function changeName($name)
    {
        $this->name = $name;
        $this->notify();
    }
}

class WorkerObserver implements SplObserver
{
    /**
     * @var Worker[]
     */
    private array $workers = [];
    public function update(SplSubject $subject)
    {
        $this->workers[] = clone $subject;
    }

    public function getWorkers(): array
    {
        return $this->workers;
    }
}

$observer = new WorkerObserver();

$worker = new Worker();
$worker->attach($observer);

$worker->changeName('Ivan');
$worker->changeName('Bob');

var_dump($observer->getWorkers());
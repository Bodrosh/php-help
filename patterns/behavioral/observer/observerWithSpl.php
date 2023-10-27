<?php
class Teacher implements SplObserver
{
    private string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function update(SplSubject $subject): void
    {
        printf("Я - учитель ({$this->name}), слышу звонок" . PHP_EOL);
    }
}

class Watchman implements SplSubject
{
    private SplObjectStorage $observers;

    /**
     * @param array $observers
     */
    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function clickOnButton(): void
    {
        printf("Я - охранник, нажимаю на кнопку звонка..." . PHP_EOL);
        $this->notify();
    }

    public function getObservers(): SplObjectStorage
    {
        return $this->observers;
    }
}

$teacher1Observer = new Teacher('Anna');
$teacher2Observer = new Teacher('Maria');

$watchmanSubject = new Watchman(); // observable
$watchmanSubject->attach($teacher1Observer);
$watchmanSubject->attach($teacher2Observer);

$watchmanSubject->clickOnButton();


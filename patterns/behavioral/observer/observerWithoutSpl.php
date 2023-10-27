<?php
// Охранник - Observable - нажимает на кнопку
// Observer - ученики и звонок, учитель - получают оповещение о звонке, вызывают у себя метод update со своей реализацией

interface Observer
{
    public function update(): void;
}

interface Observable // Subject
{
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}

class Watchman implements Observable
{
    /**
     * @var Observer[]
     */
    private array $observers = [];
    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        foreach ($this->observers as $key => $item) {
            if ($item === $observer) {
                unset($this->observers[$key]);
            }
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }

    public function clickOnButton()
    {
        printf('Я охранник, нажимаю кнопку звонка...' . PHP_EOL);
        $this->notify();
    }

    public function getObservers(): array
    {
        return $this->observers;
    }
}

class Teacher implements Observer
{
    public function update(): void
    {
        printf('Я учитель, слышу звонок' . PHP_EOL);
    }
}

class Pupil implements Observer
{
    public function update(): void
    {
        printf('Я ученик, слышу звонок' . PHP_EOL);
    }
}

$teacher = new Teacher();
$pupil = new Pupil();

$watchman = new Watchman();
$watchman->attach($teacher);
$watchman->attach($pupil);

var_dump($watchman->getObservers());

$watchman->clickOnButton();

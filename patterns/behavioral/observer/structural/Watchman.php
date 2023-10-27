<?php
namespace Patterns\behavioral\observer\structural;

class Watchman implements Observable
{
    /**
     * @var Observer[]
     */
    private array $observers = [];
    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void
    {
        foreach ($this->observers as $key => $item) {
            if ($observer === $item) {
                unset($this->observers[$key]);
            }
        }
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }

    public function clickOnButton(): void
    {
        printf('Я охранник, нажимаю кнопку звонка...' . PHP_EOL);
        $this->notify();
    }
}
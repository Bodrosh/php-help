<?php
class Comment implements SplSubject
{
    private string $text;
    private SplObjectStorage $observers;
    public function __construct(string $text)
    {
        $this->text = $text;
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

    public function save(): void
    {
        $this->notify();
    }

    public function getText(): string
    {
        return $this->text;
    }
}

class User implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        printf('Я юзер, получил комментарий: ' . $subject->getText() . PHP_EOL);
    }
}

class Mailer implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        printf('Я mailer, отправляю письмо с комментарием: ' . $subject->getText() . PHP_EOL);
    }
}

$comment = new Comment('Всем привет, скоро обновление...');
$comment->attach(new User());
$comment->attach(new User());
$comment->attach(new Mailer());

$comment->save();
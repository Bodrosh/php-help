<?php
// Приспособленец - разгружает память
interface Mail
{
    public function render();
}

abstract class TypeMail
{
    public string $text = '';
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}

class BusinessMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getText() . ' from business mail';
    }
}
class JobMail extends TypeMail implements Mail
{
    public function render(): string
    {
        return $this->getText() . ' from job mail';
    }
}
class MailFactory
{
    private array $pool = [];
    public function getMail(int $id, string $type): Mail
    {
        if (!isset($this->pool[$id])) {
            $this->pool[$id] = $this->make($type);
        }

        return $this->pool[$id];
    }
    private function make(string $type): Mail
    {
        if ($type === 'business')
            return new BusinessMail('Business text');

        return new JobMail('Job text');
    }
}

$mailFactory = new MailFactory();
$mail = $mailFactory->getMail(10, 'business');
var_dump($mail->render());


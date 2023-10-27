<?php
// Компоновщик - из частей создать целое (как билдер,только без создания (порождения) объектов)
interface Renderable {
    public function render(): string;
}
class Mail implements Renderable {
    private array $parts = [];
    public function addPart(Renderable $part): void
    {
        $this->parts[] = $part;
    }

    public function render(): string
    {
        $result = '';
        foreach ($this->parts as $part) {
            $result .= $part->render() . PHP_EOL;
        }
        return $result;
    }
}

abstract class Element {
    protected string $text;
    public function __construct($text)
    {
        $this->text = $text;
    }
}
class Header extends Element implements Renderable {
    public function render(): string
    {
        return $this->text;
    }
}

class Body extends Element implements Renderable {
    public function render(): string
    {
        return $this->text;
    }
}

class Footer extends Element implements Renderable {
    public function render(): string
    {
        return $this->text;
    }
}

$mail = new Mail();

$mail->addPart(new Header('Header text'));
//$mail->addPart(new Body('Body content'));
$mail->addPart(new Footer('Footer text'));

var_dump($mail->render());

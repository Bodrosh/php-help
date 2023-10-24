<?php
// Мост, похож на адаптер. Класс связывает 2 класса, но выдает специфичный результат
interface Formatter
{
    public function format(string $str): string;
}
class SimpleText implements Formatter
{

    public function format(string $str): string
    {
        return $str;
    }
}

class HTMLText implements Formatter
{

    public function format(string $str): string
    {
        return "<p>{$str}</p>";
    }
}

interface BridgeServiceInterface
{
    public function getFormatter(string $str): string;
}

abstract class BridgeService implements BridgeServiceInterface
{
    protected Formatter $formatter;

    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }
}

class SimpleTextService extends BridgeService
{
    public function getFormatter(string $str): string
    {
        return $this->formatter->format($str);
    }
}

class HTMLTextService extends BridgeService
{
    public function getFormatter(string $str): string
    {
        return $this->formatter->format($str);
    }
}

$simpleText = new SimpleText();
$htmlText = new HTMLText();

$simpleTextService = new SimpleTextService($simpleText);
$htmlTextService = new HTMLTextService($htmlText);

var_dump($simpleTextService->getFormatter('Hello'));
var_dump($htmlTextService->getFormatter('Hello'));
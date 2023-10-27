<?php
// За основу класс, в дочернем его расширяем
abstract class Task
{
    public function printSection()
    {
        $this->printHeader();
        $this->printBody();
        $this->printCustom();
        $this->printFooter();
    }

    private function printHeader()
    {
        printf('Header' . PHP_EOL);
    }
    private function printBody()
    {
        printf('Body' . PHP_EOL);
    }
    private function printFooter()
    {
        printf('Header' . PHP_EOL);
    }

    abstract protected function printCustom();
}

class DeveloperTask extends Task
{
    protected function printCustom()
    {
        printf('Custom developer' . PHP_EOL);
    }
}

class DesignerTask extends Task
{
    protected function printCustom()
    {
        printf('Custom designer' . PHP_EOL);
    }
}

$devTask = new DeveloperTask();
$devTask->printSection();
printf('------' . PHP_EOL);
$desTask = new DesignerTask();
$desTask->printSection();

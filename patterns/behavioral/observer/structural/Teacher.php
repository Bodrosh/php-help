<?php
namespace Patterns\behavioral\observer\structural;

class Teacher implements Observer
{
    public function update(): void
    {
       printf('Я учитель, слышу звонок, начинаю урок.' . PHP_EOL);
    }
}
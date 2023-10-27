<?php
namespace Patterns\behavioral\observer\structural;

class Pupil implements Observer
{
    public function update(): void
    {
       printf('Я ученик, слышу звонок, бегу в класс.' . PHP_EOL);
    }
}
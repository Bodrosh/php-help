<?php
namespace Patterns\behavioral\observer\structural;

interface Observable // Subject
{
    public function attach(Observer $observer): void;
    public function detach(Observer $observer): void;
    public function notify(): void;
}
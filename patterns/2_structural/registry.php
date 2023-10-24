<?php
// Хранилище, если в массиве есть данные, отдаем их
abstract class Registry {
    private static array $services = [];
    final public static function setService(int $key, Service $service)
    {
        self::$services[$key] = $service;
    }

    final public static function getService(int $key): string|Service
    {
        return self::$services[$key] ?? 'This service doesnt exists.';
    }
}
class Service {}

$service = new Service();
Registry::setService(1, $service);

$service = Registry::getService(1);

var_dump($service);
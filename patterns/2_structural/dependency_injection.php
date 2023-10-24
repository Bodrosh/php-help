<?php
// Хотим создать объект, всю конфигурацию  помещаем в отдельный класс
class ControllerConf {
    public string $name;
    public string $method;

    public function __construct(string $name, string $method)
    {
        $this->name = $name;
        $this->method = $method;
    }
}
class Controller {
    private ControllerConf $conf;

    public function __construct(ControllerConf $controllerConf)
    {
        $this->conf = $controllerConf;
    }

    public function getConf()
    {
        printf("{$this->conf->name}@{$this->conf->method}" . PHP_EOL) ;
    }
}

$conf = new ControllerConf('PostController', 'index');
$controller = new Controller($conf);
$controller->getConf();

$conf2 = new ControllerConf('TagController', 'show');
$controller = new Controller($conf2);
$controller->getConf();
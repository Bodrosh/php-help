<?php
interface Door {
    public function getWidth(): float;
    public function getHeight(): float;
}

class MetalDoor implements Door {
    protected $width;
    protected $height;
    public function __construct(float $width, float $height) {
        $this->width = $width;
        $this->height = $height;
    }
    public function getWidth(): float
    {
        return $this->width;
    }
    public function getHeight(): float
    {
        return $this->height;
    }
}

class DoorFactory {
    public static function createDoor($width, $height): Door {
        return new MetalDoor($width, $height);
    }
}

$door = DoorFactory::createDoor(300, 1000);
echo $door->getHeight();

<?php
// Посредник для взаимодействия между объектами, уменьшение связанности
class User
{
    private string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function sayHello(): string
    {
        return 'Hello, I am ' . $this->name;
    }
}

class Room
{
    private string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

}

class RoomUserMediator
{
    /**
     * @var User[]
     */
    private array $users;
    private Room $room;

    public function addUsers(User ...$users): void
    {
        $this->users = $users;
    }

    public function setRoom(Room $room): void
    {
        $this->room = $room;
    }

    public function helloMessages(): void
    {
        foreach ($this->users as $user) {
            printf($user->sayHello() . ' from ' . $this->room->getName() . PHP_EOL);
        }
    }
}


$user1 = new User('Ivan');
$user2 = new User('Lera');

$room1 = new Room('room1');

$roomUserMediator = new RoomUserMediator();
$roomUserMediator->addUsers($user1, $user2);
$roomUserMediator->setRoom($room1);

$roomUserMediator->helloMessages();
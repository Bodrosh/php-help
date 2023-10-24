<?php
// Есть общее хранилище для разных объектов
interface WorkerVisitor
{
    public function visitDeveloper(Developer $developer);
    public function visitDesigner(Designer $designer);
}

class RecorderVisitor implements WorkerVisitor
{
    /**
     * @var Worker[]
     */
    private array $visited = []; // или $workers
    public function visitDeveloper(Developer $developer)
    {
        $this->visited[] = $developer;
    }

    public function visitDesigner(Designer $designer)
    {
        $this->visited[] = $designer;
    }

    public function getVisited(): array
    {
        return $this->visited;
    }
}

interface Worker
{
    public function work();
    public function accept(WorkerVisitor $visitor);
}

class Developer implements Worker
{
    public function work()
    {
        printf('developer work' . PHP_EOL);
    }
    function accept(WorkerVisitor $visitor)
    {
        $visitor->visitDeveloper($this);
    }
}

class Designer implements Worker
{
    public function work()
    {
        printf('designer work' . PHP_EOL);
    }
    function accept(WorkerVisitor $visitor)
    {
        $visitor->visitDesigner($this);
    }
}

$visitor = new RecorderVisitor();
$developer = new Developer();
$designer = new Designer();

$developer->accept($visitor);
$designer->accept($visitor);

var_dump($visitor->getVisited());
foreach ($visitor->getVisited() as $worker)
{
    $worker->work();
}
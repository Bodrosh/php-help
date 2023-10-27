<?php
// Массив объектов, можно получать их по ключу, если найдены
class Worker
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public static function make($args)
    {
        return new self($args['name']);
    }
}
class WorkerStorageAdapter
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function find(int $id): ?Worker
    {
        $data = $this->data[$id] ?? null;
        if (!$data) return null;

        return Worker::make($data);
    }
}
class WorkerMapper
{
    private WorkerStorageAdapter $workerStorageAdapter;

    public function __construct(WorkerStorageAdapter $workerStorageAdapter)
    {
        $this->workerStorageAdapter = $workerStorageAdapter;
    }

    public function findById(int $id): ?Worker
    {
        return $this->workerStorageAdapter->find($id);
    }
}

$data = [
    1 => [
        'name' => 'Ivan'
    ]
];

$workerStorageAdapter = new WorkerStorageAdapter($data);
$workerMapper = new WorkerMapper($workerStorageAdapter);

$worker = $workerMapper->findById(1);
var_dump($worker);
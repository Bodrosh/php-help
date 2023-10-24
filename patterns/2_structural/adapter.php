<?php
// Когда есть 2 схожих класса, запустив один класс, дернуть такой же метод у другого класса
// Адаптер - связующее звено
interface OfficeWorker
{
    public function countSalary();
}

class OfficeDeveloper implements OfficeWorker
{
    public function countSalary(): int
    {
        return 3000 * 20;
    }
}

interface OutsourceWorker
{
    public function countSalaryByMonth(int $hours);
}

class OutsourceDeveloper implements OutsourceWorker
{
    public function countSalaryByMonth(int $hours): int
    {
        return 1000 * $hours;
    }
}

class OutsourceWorkerAdapter implements OfficeWorker
{
    private OutsourceDeveloper $outsourceDeveloper;

    public function __construct(OutsourceDeveloper $outsourceDeveloper)
    {
        $this->outsourceDeveloper = $outsourceDeveloper;
    }

    public function countSalary(): int
    {
        return $this->outsourceDeveloper->countSalaryByMonth(80);
    }
}

$officeDeveloper = new OfficeDeveloper();
$outsourceDeveloper = new OutsourceDeveloper();

$outsourceWorkerAdapter = new OutsourceWorkerAdapter($outsourceDeveloper);

var_dump($outsourceWorkerAdapter->countSalary());

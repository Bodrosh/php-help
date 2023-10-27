<?php
// Есть некая спецификация (ученик получил оценку) и определяем, осилил ли он проходной бал. Похож на интерпретатор.
class Pupil
{
    public int $rate = 0;
    public function __construct(int $rate)
    {
        $this->rate = $rate;
    }
}

interface Specification
{
    public function isNormal(Pupil $pupil): bool;
}

class PupilSpecification implements Specification
{
    private int $needRate = 0;
    public function __construct(int $needRate)
    {
        $this->needRate = $needRate;
    }

    public function isNormal(Pupil $pupil): bool
    {
       return $pupil->rate >= $this->needRate;
    }
}

class AndPupilSpecification implements Specification
{
    /**
     * @var Specification[]
     */
    public array $specifications;
    public function __construct(Specification ...$specification)
    {
        $this->specifications = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isNormal($pupil)) return false;
        }
        return true;
    }
}

class OrPupilSpecification implements Specification
{
    /**
     * @var Specification[]
     */
    public array $specifications;
    public function __construct(Specification ...$specification)
    {
        $this->specifications = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isNormal($pupil)) return true;
        }
        return false;
    }
}


$spec1 = new PupilSpecification(5);
$spec2 = new PupilSpecification(10);

$pupil = new Pupil(8);

var_dump($spec1->isNormal($pupil));
var_dump($spec2->isNormal($pupil));

$andSpec = new AndPupilSpecification($spec1, $spec2);
var_dump($andSpec->isNormal($pupil));

$orSpec = new OrPupilSpecification($spec1, $spec2);
var_dump($orSpec->isNormal($pupil));
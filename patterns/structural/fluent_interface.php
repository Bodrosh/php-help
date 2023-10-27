<?php
// Чейнинг методов, ("текучий интерфейс")
class QueryBuilder
{
    private array $select;
    private string $from;
    private array $where;
    public function select(array $fields): self
    {
        $this->select = $fields;
        return $this;
    }

    public function from(string $table): self
    {
        $this->from = $table;
        return $this;
    }
    public function where(array $conditions): self
    {
        $this->where = $conditions;
        return $this;
    }
    public function get(): string
    {
        $select = implode(', ', $this->select);
        $where = implode(' AND ', $this->where);

        return "SELECT {$select} FROM {$this->from} WHERE {$where}";
    }

}

$queryBuilder = new QueryBuilder();
$query = $queryBuilder
    ->select(['id', 'title'])
    ->from('posts')
    ->where(['id < 20', 'age > 30'])
    ->get();
var_dump($query);
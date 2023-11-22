<?php
/*
 * mechanics - id, name
 * cars - id, model, mechanic_id
 * owners - id, name, car_id
 * Можем получить доступ из механика к владельцу авто через машину
 */

class Mechanic extends Model
{
    public function carOwner(): HasOneThrough
    {
        return $this->hasOneThrough(Owner::class, Car::class);
        // return $this->hasOneThrough(Owners::class, Car::class, 'mechanic_id', 'car_id', 'id', 'id');
        // $this->through('cars')->has('owner'); // если в моделях есть эти связи
    }
}



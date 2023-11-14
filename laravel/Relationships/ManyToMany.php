<?php
// belongsToMany -> belongsToMany
/* users - id, name
 * role - id, name
 * role_user user_id, role_id
 *
 * У пользователя несколько ролей, у каждой роли может быть несколько пользователей
 */

class User extends Model
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
        //return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');

        // если нужны данные из промежуточной таблицы (по умолчанию только ключи)
        return $this->belongsToMany(Role::class)->withPivot('active', 'created_by');
        return $this->belongsToMany(Role::class)->withTimestamps(); // если нужны created_at and updated_at

        // pivot можно переименовать ->as('subscription')

        // для pivot есть различные методы
        return $this->belongsToMany(Role::class)->wherePivot('status', 1)->orderByPivot('created_at', 'desc');
        // ->wherePivotIn('priority', [1, 2]); | wherePivotNotIn
        // ->wherePivotBetween('created_at', ['2020-01-01 00:00:00', '2020-12-31 00:00:00']); | wherePivotNotBetween
        // ->wherePivotNull('expired_at')  | wherePivotNotNull
    }
}

class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

$roles = User::find(1)->roles()->orderBy('name')->get();

// Доступ к промежуточной таблице
$user = User::find(1);

foreach ($user->roles as $role) {
    echo $role->pivot->created_at;
}


////////////////
/*
 * Если нужна модель RoleUser
 */
class RoleUser extends Pivot {
    public $incrementing = true; // если нужен
}

class Role extends Model
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(RoleUser::class);
    }
}
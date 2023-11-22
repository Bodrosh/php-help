<?php
// User -> Phone (1 - 1), hasOne, belongsTo
class User extends Model
{
    public function phone(): HasOne
    {
        return $this->hasOne(Phone::class);
        // return $this->hasOne(Phone::class, 'foreign_key', 'local_key'); // (Phone::class, 'user_id', 'id')
    }
}
class Phone extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
        // return $this->>belongsTo(User::class, 'foreign_key', 'owner_key'); (User::class, 'user_id', 'id')
    }
}

$phone = User::find(1)->phone;
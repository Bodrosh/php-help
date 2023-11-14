<?php
// Изображения могут быть как у пользователей, так и  у постов
/*
 * posts - id, name
 * users - id, name
 * images - id, url, imageable_id, imageable_type
 *
 * В imageable_id - id поста или пользователя, imageable_type - название класса модели (App\Models\Post or App\Models\User)
 */

class Image extends Model
{
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}

class Post extends Model
{
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}

class User extends Model
{
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}


$image = Image::find(1);
$imageable = $image->imageable; // Вернет Post or User
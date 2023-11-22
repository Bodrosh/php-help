<?php
// Посты и видео могут иметь одни и те же теги (из общего списка)
/*
 * posts - id, name
 * video - id, name
 * tags - id, name
 * taggables - tag_id, taggable_id, taggable_type
 */

class Posts extends Model
{
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}

class Tag extends Model
{
    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }

}
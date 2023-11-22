<?php
// Много комментариев может быть как у поста, так и у видео
/*
 * posts - id, title, body
 * videos - id, title, url
 * comments - id, body, commentable_id, commentable_type
 */

class Comment extends Model
{
    // Get the parent commentable model (post or video)
    public function commentable(): MorhpTo
    {
        return $this->morphTo();
    }
}

class Post extends Model
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // One Of Many (Polymorphic)
    public function latestComment(): MorphOne
    {
        return $this->morphOne(Comment::class, 'commentable')->latestOfMany(); // oldestOfMany
        //return $this->morphOne(Comment::class, 'commentable')->ofMany('likes', 'max');
    }
}

class Video extends Model
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

$comment = Comment::find(1);
$postOrVideo = $comment->commentable;
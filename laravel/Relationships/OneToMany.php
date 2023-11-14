<?php
// Post -> Comment (1 - M), hasMany, BelongsTo
// latestComment - hasOne
class Post extends Model
{
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
        // return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    /*
     * HasOneOfMany
     */
    public function latestComment(): HasOne
    {
        return $this->hasOne(Comment::class)->latestOfMany(); // ofMany methods, oldestOfMany
        return $this->hasOne(Comment::class)->ofMany('likes', 'max'); // most liked comment
        return $this->comments()->one()->ofMany('likes', 'max'); // most liked comment
    }
}

class Comment extends Model
{
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
        // return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}

$comments = Post::find(1)->comments;
foreach ($comments as $comment) {}

$comment = Post::find(1)->comments()->where('title', 'foo')->first();
$postTitle = Comment::find(1)->post->title;


$userPosts = Post::where('user_id', $user->id)->get();
$userPosts = Post::whereBelongsTo($user)->get(); // то же самое

$usersPosts = Post::whereBelongsTo($users)->get();
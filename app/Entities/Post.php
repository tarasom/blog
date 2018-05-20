<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Post.
 *
 * @package namespace App\Entities;
 */
class Post extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'content',
        'file_name',
    ];

    protected $appends = [
        'imageUrl'
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->getImageUrlAttribute();
    }

    /**
     * @return string
     */
    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    /**
     * @return string
     */
    public function getImageUrlAttribute()
    {
        $defaultPath = 'public/' . config('image.default_image');
        $path        = 'public/' . $this->file_name;

        $url = Storage::url($defaultPath);

        if (!empty($this->file_name) && Storage::exists($path)) {
            $url = Storage::url($path);
        }
        return secure_asset($url);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_categories');
    }

    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

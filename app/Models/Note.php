<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mews\Purifier\Casts\CleanHtml;

class Note extends Model
{
    protected $fillable = ['title', 'category_id', 'content', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch($query, ?string $data)
    {
        $query->where('title', 'like', '%' . $data . '%')->orWhere('content', 'like', '%' . $data . '%');
    }

    protected $casts = [
        'conetnt' => CleanHtml::class,
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string $file_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SheetMusic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SheetMusic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SheetMusic query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SheetMusic whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SheetMusic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SheetMusic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SheetMusic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SheetMusic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SheetMusic extends Model
{
    protected $fillable = [
        'title',
        'author',
        'file_path',
    ];

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}

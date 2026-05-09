<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Measure 
{
    public float $left;
    public float $top;
    public float $right;
    public float $bottom;

    public function __construct(float $left, float $top, float $right, float $bottom)
    {
        $this->left = $left;
        $this->right = $right;
        $this->top = $top;
        $this->bottom = $bottom;
    }

    public function toArray(): array
    {
        return [
            'left' => $this->left,
            'top' => $this->top,
            'right' => $this->right,
            'bottom' => $this->bottom,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['left'] ?? 0,
            $data['top'] ?? 0,
            $data['right'] ?? 0,
            $data['bottom'] ?? 0
        );
    }
};

/**
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string $file_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Collection<int, array{ left: int, right: int, top: int, bottom: int }> $measures
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
        'measures',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'measures' => 'json',
        ];
    }

    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}

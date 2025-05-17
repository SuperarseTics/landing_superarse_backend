<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Section;

class Widget extends Model
{
    use HasFactory;

    protected $table = 'widgets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'properties'
    ];

    /**
     * Relationship to Section Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function section (): HasMany {
        return $this->hasMany(Section::class, 'widgets_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SubmenuOptions;
use App\Models\Section;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'options_id',
        'ruta',
        'name',
        'properties'
    ];

    /**
     * Relationship to Meny Model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function option (): BelongsTo {
        return $this->belongsTo(SubmenuOptions::class, 'options_id');
    }

    /**
     * Relationship to Section Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections (): HasMany {
        return $this->hasMany(Section::class, 'pages_id');
    }

}
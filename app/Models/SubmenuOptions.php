<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Submenu;
use App\Models\Page;

class SubmenuOptions extends Model
{
    use SoftDeletes;

    protected $table = 'submenu_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'submenus_id',
        'name',
        'active'
    ];

    /**
     * Relationship to Meny Model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function submenu (): BelongsTo {
        return $this->belongsTo(Submenu::class, 'menus_id');
    }

    /**
     * Relationship to Submenu Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages (): HasMany {
        return $this->hasMany(Page::class, 'options_id');
    }

    /**
     * Scope to filter by active
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
    
}

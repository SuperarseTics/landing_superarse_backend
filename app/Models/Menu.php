<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Submenu;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = 'menus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'active'
    ];

    /**
     * Relationship to Submenu Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submenus (): HasMany {
        return $this->hasMany(Submenu::class, 'menus_id');
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

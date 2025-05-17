<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Menu;
use App\Models\SubmenuOptions;

class Submenu extends Model
{
    use SoftDeletes;

    protected $table = 'submenus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menus_id',
        // 'section',
        'name',
        'active'
    ];

    /**
     * Relationship to Meny Model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu (): BelongsTo {
        return $this->belongsTo(Menu::class, 'menus_id');
    }

    /**
     * Relationship to Submenu Options Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options (): HasMany {
        return $this->hasMany(SubmenuOptions::class, 'submenus_id');
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

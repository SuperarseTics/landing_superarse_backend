<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Page;
use App\Models\Widget;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pages_id',
        'widgets_id',
        'name',
        'properties',
        'data'
    ];

    /**
     * Relationship to Meny Model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page (): BelongsTo {
        return $this->belongsTo(Page::class, 'pages_id');
    }

    /**
     * Relationship to Meny Model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function widget (): BelongsTo {
        return $this->belongsTo(Widget::class, 'widgets_id');
    }

}
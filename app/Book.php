<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\Filterable;
use App\Presenters\Presentable;

class Book extends Model
{
    use Filterable, Presentable;

    protected $presenter = 'App\Presenters\BookPresenter';

    protected $fillable = [
        'title',
        'publish_date',
        'author_id'
    ];

    protected $with = ['author', 'translations'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function translations()
    {
        return $this->belongsToMany(Country::class)->withTimestamps();
    }

    public function getTranslationsListAttribute()
    {
        return $this->translations->pluck('id')->toArray();
    }
}

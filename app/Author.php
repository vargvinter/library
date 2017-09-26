<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Presenters\Presentable;

class Author extends Model
{
    use Presentable;

    protected $presenter = 'App\Presenters\AuthorPresenter';

    protected $fillable = [
        'name',
        'surname',
        'country_id'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

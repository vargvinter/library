<?php

namespace App\Filters;

class BooksFilter extends Filters
{
    protected $filters = [
        'author',
        'title',
        'translation'
    ];

    protected $sortables = [
        'title',
        'publish_date'
    ];

    /**
     * @return mixed
     */
    function defaultOrderBy()
    {
        return ['publish_date' => 'desc'];
    }

    protected function author($string)
    {
        $this->builder->whereHas('author', function ($author) use ($string) {
            $author
                ->where('name', 'like', '%' . $string . '%')
                ->orWhere('surname', 'like', '%' . $string . '%')
                ->orWhereRaw("concat(name, ' ', surname) like '%{$string}%'")
                ->orWhereRaw("concat(surname, ' ', name) like '%{$string}%'");
        });
    }

    protected function title($string)
    {
        $this->builder->where('title', 'like', '%' . $string . '%');
    }

    protected function translation($string)
    {
        $this->builder->whereHas('translations', function ($translations) use ($string) {
            $translations
                ->where('name', 'like', '%' . $string . '%');
        });
    }
}

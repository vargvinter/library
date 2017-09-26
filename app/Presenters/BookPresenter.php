<?php

namespace App\Presenters;

class BookPresenter extends Presenter
{
    public function translations()
    {
        return implode(', ', $this->entity->translations->pluck('name')->toArray());
    }
}

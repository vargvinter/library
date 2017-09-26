<?php

namespace App\Presenters;

class AuthorPresenter extends Presenter
{
    public function fullName()
    {
        return $this->entity->surname . ' ' . $this->entity->name;
    }
}

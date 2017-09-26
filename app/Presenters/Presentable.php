<?php

namespace App\Presenters;

use Exception;

trait Presentable
{
	protected $presenterInstance;

	public function present()
	{
		if ( ! $this->presenter or ! class_exists($this->presenter))
		{
			throw new Exception('Set the $presenter property to your presenter path.');
		}

		if ( ! $this->presenterInstance)
		{
			$this->presenterInstance = new $this->presenter($this);
		}

		return $this->presenterInstance;
	}
}

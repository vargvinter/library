<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
	protected $request;

	protected $builder;

	protected $filters;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function apply($builder)
	{
		$this->builder = $builder;

		foreach ($this->getFilters() as $filter => $value) {
			if (method_exists($this, $filter)) {
				$this->$filter($value);
			}
		}

        $this->orderBy();

		return $this->builder;
	}

	public function getFilters()
	{
		return array_only($this->request->all(), $this->filters);
	}

    public function orderBy()
    {
        if ($this->hasSortParameters())

            return $this->builder->orderBy($this->request->input('sort'), $this->request->input('direction'));

        $column = key($this->defaultOrderBy());
        $direction = $this->defaultOrderBy()[$column];

        return $this->builder->orderBy($column, $direction);
    }

    private function hasSortParameters()
    {
        return $this->request->has('sort')
            && $this->request->has('direction')
            && in_array($this->request->input('sort'), $this->sortables);
    }

    abstract function defaultOrderBy();

    public function sortByLink($column, $link_body, $route, array $route_params = [])
    {
        if (request('sort') == $column AND request('direction') == 'asc')
            $direction = 'desc';
        else if ( (! request('sort') || ! request('direction')) && ! empty($default))
            $direction  = ($default == 'desc') ? 'asc' : 'desc';
        else
            $direction = 'asc';

        if (request('sort') == $column)
            $sort_class = ($direction == 'desc') ? 'asc' : 'desc';
        else if ( ! request('sort') && ! empty($default))
            $sort_class = $default;
        else
            $sort_class = '';

        $array = ['sort' => $column, 'direction' => $direction];
        $request = request()->except(['sort', 'direction']);

        $params = array_merge($route_params, $array, $request);

        return link_to_route($route, $link_body, $params, ['class' => $sort_class]);
	}
}

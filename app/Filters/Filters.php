<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    const SORT_BY_COLUMN_KEY = 'sort';

    const SORT_ORDER_KEY = 'direction';

    const ASC_ORDER_KEY = 'asc';

    const DESC_ORDER_KEY = 'desc';

    protected $request;

    protected $builder;

    protected $filters;

    protected $sortables;

    public function __construct(Request $request)
	{
		$this->request = $request;
	}

    abstract function defaultOrderBy();

    public function apply($builder)
	{
		$this->builder = $builder;

		foreach ($this->getFilters() as $filter => $value) {
			if (method_exists($this, $filter) && strlen($value)) {
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

        return $this->builder->orderBy($this->getDefaultSortColumn(), $this->getDefaultSortDirection());
    }

    private function hasSortParameters()
    {
        return $this->request->has('sort')
            && $this->request->has('direction')
            && in_array($this->request->input('sort'), $this->sortables);
    }

    private function getDefaultSortColumn()
    {
        return key($this->defaultOrderBy());
    }

    private function getDefaultSortDirection()
    {
        return $this->defaultOrderBy()[$this->getDefaultSortColumn()];
    }

    public function url($route, $column, $link_body, array $route_params = [])
    {
        if ( ! $this->hasSortParameters())
            $direction = ($this->getDefaultSortColumn() == $column && $this->getDefaultSortDirection() == 'desc')
                ? 'asc'
                : 'desc';

        else if ($this->request->get('sort') == $column && $this->request->get('direction') == 'asc')
            $direction = 'desc';

        else $direction = 'asc';


        if ($this->request->get('sort') == $column)
            $sort_class = ($direction == 'desc') ? 'asc' : 'desc';
        else if ( ! $this->request->get('sort') && $column == $this->getDefaultSortColumn())
            $sort_class = $this->getDefaultSortDirection();
        else
            $sort_class = '';


        $sort_params = ['sort' => $column, 'direction' => $direction];
        $request = $this->request->except(['sort', 'direction']);

        $params = array_merge($route_params, $sort_params, $request);

        return link_to_route($route, $link_body, $params, ['class' => $sort_class]);
	}
}

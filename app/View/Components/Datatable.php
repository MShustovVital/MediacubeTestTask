<?php

namespace App\View\Components;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Datatable extends Component
{
	public array $fields;
	public LengthAwarePaginator $records;
	public array $config;
	public string $route;
	public string $entity;
	public bool $actions;

	public function __construct(LengthAwarePaginator $records, array $fields, array $config = [])
	{
		$this->fields = $fields;
		$this->records = $records;
		$this->config = $config;
		if (! empty($this->config['entity']) && ! empty($this->config['route'])) {
			$this->route = $config['route'] ?? '';
		} else {
			$this->route = Str::plural($this->config['entity'], 2);
		}

		$this->entity = $this->config['entity'] ?? '';
		$this->actions = $this->config['actions'] ?? false;
	}

	public function render()
	{
		return view('components.datatable');
	}
}

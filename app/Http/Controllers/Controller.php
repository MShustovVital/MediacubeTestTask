<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use InvalidArgumentException;

class Controller extends BaseController
{
	use AuthorizesRequests;
	use DispatchesJobs;
	use ValidatesRequests;

	protected function flashStatus(string $entity, string $value, string $type = 'created'): void
	{
		$message = $this->getStatusMessage($type);
		session()->flash('status', "$entity $value $message");
	}

	private function getStatusMessage(string $type): string
	{
		switch ($type) {
			case 'created':
				return 'created successfully';
			case 'updated':
				return 'updated successfully';
		}
		throw new InvalidArgumentException();
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Employee.
 *
 * @property int $id_listino
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property float $salary
 */
class Employee extends Model
{
	use HasFactory;
	protected $guarded = ['id'];
	protected $appends = ['full_name'];

	public function getFullNameAttribute(): string
	{
		return sprintf('%s %s %s', $this->name, $this->surname, $this->patronymic);
	}

	public function departments(): BelongsToMany
	{
		return $this->belongsToMany(Department::class);
	}
}

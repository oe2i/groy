<?php //*** ModelX ~ trait » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Trait;

use Groy\Xeno\Data\RandomX;

trait ModelX
{
	// • === getFillable »
	public function getFillable()
	{
		if (method_exists($this, 'fillableColumns')) {
			$fillable = array_merge($this->fillableColumns(), $this->fillable);
		}
		$this->fillable = array_unique($fillable);
		return $this->fillable ?? parent::getFillable();
	}



	// • === scopePuid »
	public function scopePuid($query, $puid)
	{
		return $query->where('puid', $puid);
	}



	// • === scopeSuid »
	public function scopeSuid($query, $suid)
	{
		return $query->where('suid', $suid);
	}



	// • === booted »
	protected static function booted()
	{
		// ~ creating :: runs before a record is created
		static::creating(function ($model) {
			$model->puid = !empty($model->puid) ? $model->puid : RandomX::puid(10);
			$model->suid = !empty($model->suid) ? $model->suid : RandomX::suid(100);
		});
	}



	// • === fillableColumns »
	private function fillableColumns()
	{
		return ['puid', 'suid'];
	}
} //> end of trait ~ ModelX
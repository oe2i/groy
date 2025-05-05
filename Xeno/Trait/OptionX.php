<?php //*** OptionX ~ trait » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Trait;

trait OptionX
{
	// • === name »
	public function name(): string
	{
		//NOTE: usage Gender::MALE->name();
		return $this->name;
	}




	// • === value »
	public function value(): string
	{
		//NOTE: usage Gender::MALE->value();
		return $this->value;
	}




	// • === abbr »
	public function abbr(): string
	{
		//NOTE: usage Gender::MALE->number();
		return isset($this->value[0]) ? strtoupper($this->value[0]) : '';
	}




	// • === choice »
	public static function choice($choice, $prop = 'value'): string
	{
		$choice = strtoupper($choice);
		foreach (self::cases() as $case) {
			if ($case->name === $choice || $case->value === $choice) {
				if ($prop === 'label') {
					return $case->label();
				}
				return $case->$prop;
			}
		}
		return '';
	}




	// • === option »
	public static function option()
	{
		$options = [];

		$method = 'name';
		if (method_exists(self::class, 'label')) {
			$method = 'label';
		}

		foreach (self::cases() as $case) {
			$options[$case->value()] = ucwords($case->{$method}());
		}

		return $options;
	}




	// • === toArray »
	public static function toArray($data = []): array
	{
		foreach (self::cases() as $case) {
			$data[$case->name] = $case->value;
		}
		return $data;
	}




	// • === toObject »
	public static function toObject($data = []): object
	{
		return (object) self::toArray($data);
	}

} //> end of trait ~ OptionX
<?php //*** OptionX ~ trait » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Trait;

trait OptionX
{
	// • === label »
	public function label(): string
	{
		//NOTE: usage Gender::MALE->label();
		return $this->name;
	}




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




	// • === retrieve »
	public static function retrieve($gender, $prop = 'value'): string
	{
		$gender = strtoupper($gender);
		foreach (self::cases() as $case) {
			if ($case->name === $gender || $case->value === $gender) {
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
		foreach (self::cases() as $case) {
			$options[$case->value()] = ucwords($case->label());
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
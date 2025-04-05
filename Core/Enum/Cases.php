<?php //*** Cases ~ enum » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Core\Enum;

enum Cases: string
{
	// • constant
	case LOWERCASE = 'lowercase';
	case UPPERCASE = 'uppercase';
	case BOTH = 'both';



	// • === toArray »
	public static function toArray($status = []): array
	{
		foreach (self::cases() as $case) {
			$status[$case->name] = $case->value;
		}
		return $status;
	}



	// • === toObject »
	public static function toObject(): object
	{
		return (object) self::toArray();
	}



	// • === label »
	public function label(): string
	{
		return match ($this) {
			self::LOWERCASE => 'lowercase',
			self::UPPERCASE => 'uppercase',
			self::BOTH => 'both'
		};
	}



	// • === toValue »
	public static function value($case)
	{
		return match ($case) {
			self::LOWERCASE => range('a', 'z'),
			self::UPPERCASE => range('A', 'Z'),
			self::BOTH => array_merge(range('a', 'z'), range('A', 'Z'))
		};
	}
} //> end of enum ~ Cases
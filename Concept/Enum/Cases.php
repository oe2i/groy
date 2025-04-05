<?php //*** Cases ~ enum » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Concept\Enum;

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
	public function label(self $case): string
	{
		// NOTE: code is same as below (Only use version if: You want to return different labels [like localized or formatted versions] OR want more descriptive strings than the raw values.)
		//return match ($this) {
		// 	self::LOWERCASE => 'lowercase',
		// 	self::UPPERCASE => 'uppercase',
		// 	self::BOTH => 'both'
		// };

		return $case->value;
	}



	// • === value »
	public static function value(self $case): array
	{
		return match ($case) {
			self::LOWERCASE => range('a', 'z'),
			self::UPPERCASE => range('A', 'Z'),
			self::BOTH => array_merge(range('a', 'z'), range('A', 'Z'))
		};
	}



	// • === toValue »
	public static function getCase($value): ?self
	{
		foreach (self::cases() as $case) {
			if ($case->value === $value) {
				return $case;
			}
		}
		return null;
	}
} //> end of enum ~ Cases
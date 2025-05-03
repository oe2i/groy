<?php //*** Gender ~ enum » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Enum;

use Groy\Xeno\Trait\OptionX;

enum Gender: string
{
	// • trait
	use OptionX;




	// • cases
	case MALE = 'M';
	case FEMALE = 'F';




	// • === label »
	public function label(): string
	{
		return match ($this) {
			self::MALE => 'male',
			self::FEMALE => 'female',
		};
	}




	// • === number »
	public function number(): string
	{
		//NOTE: usage Gender::MALE->number();
		return match ($this) {
			self::MALE => '1',
			self::FEMALE => '0',
		};
	}

} //> end of enum ~ Gender
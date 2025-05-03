<?php //*** Status ~ enum » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Enum;

use Groy\Xeno\Trait\OptionX;

enum Status: string
{
	// • trait
	use OptionX;




	// • cases
	case ACTIVE = 'ACTIVE';
	case SHELVED = 'SHELVED';





	// • === label »
	public function label(): string
	{
		return match ($this) {
			self::ACTIVE => 'active',
			self::SHELVED => 'shelved',
		};
	}

} //> end of enum ~ Status
<?php //*** Cases ~ enum » Groy™ Library © 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Enum;

use Groy\Xeno\Trait\OptionX;

enum Cases: string
{
	// • trait
	use OptionX;




	// • cases
	case LOWERCASE = 'lowercase';
	case UPPERCASE = 'uppercase';
	case BOTH = 'both';




	// • === grab »
	public function grab(): array
	{
		return match ($this) {
			self::LOWERCASE => range('a', 'z'),
			self::UPPERCASE => range('A', 'Z'),
			self::BOTH => array_merge(range('a', 'z'), range('A', 'Z'))
		};
	}
} //> end of enum ~ Cases
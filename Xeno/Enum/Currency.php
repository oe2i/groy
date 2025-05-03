<?php //*** Currency ~ enum » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Enum;

use Groy\Xeno\Trait\OptionX;

enum Currency: string
{
	// • trait
	use OptionX;




	// • cases
	case EUR = 'EUR';
	case GBP = 'GBP';
	case NGN = 'NGN';
	case USD = 'USD';





	// • === label »
	public function label(): string
	{
		return match ($this) {
			self::EUR => 'euro (€)',
			self::GBP => 'pound (£)',
			self::NGN => 'naira (₦)',
			self::USD => 'dollar ($)',
		};
	}

} //> end of enum ~ Currency
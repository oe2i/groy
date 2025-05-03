<?php //*** Title ~ enum » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Enum;

use Groy\Xeno\Trait\OptionX;

enum Title: string
{
	// • trait
	use OptionX;




	// • cases
	case ALH = 'ALH';
	case CHIEF = 'CHIEF';
	case DR = 'DR';
	case ENGR = 'ENGR';
	case MR = 'MR';
	case MRS = 'MRS';
	case MS = 'MS';





	// • === label »
	public function label(): string
	{
		return match ($this) {
			self::ALH => 'alhaji',
			self::CHIEF => 'chief',
			self::DR => 'dr.',
			self::ENGR => 'engr.',
			self::MR => 'mr.',
			self::MRS => 'mrs.',
			self::MS => 'ms.',
		};
	}

} //> end of enum ~ Title
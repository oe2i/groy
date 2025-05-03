<?php //*** Role ~ enum » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Enum\User;

use Groy\Xeno\Trait\OptionX;

enum Role: string
{
	// • trait
	use OptionX;




	// • cases
	case ADMIN = 'ADMIN';
	case GUARDIAN = 'GUARDIAN';
	case HR = 'HR';
	case ICT = 'ICT';
	case ZERO = 'ZERO';





	// • === label »
	public function label(): string
	{
		return match ($this) {
			self::ADMIN => 'admin',
			self::GUARDIAN => 'guardian',
			self::HR => 'human resource',
			self::ICT => 'ICT',
			self::ZERO => 'zero',
		};
	}

} //> end of enum ~ Role
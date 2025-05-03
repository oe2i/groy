<?php //*** Type ~ enum » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Enum\User;

use Groy\Xeno\Trait\OptionX;

enum Type: string
{
	// • trait
	use OptionX;




	// • cases
	case ADMIN = 'ADMIN';
	case BASIC = 'BASIC';
	case HOD = 'HOD';
	case MANAGER = 'MANAGER';
	case STANDARD = 'STANDARD';
	case SUPERVISOR = 'SUPERVISOR';
	case ZERO = 'ZERO';





	// • === label »
	public function label(): string
	{
		return match ($this) {
			self::ADMIN => 'admin',
			self::BASIC => 'basic',
			self::HOD => 'hod',
			self::MANAGER => 'manager',
			self::STANDARD => 'standard',
			self::SUPERVISOR => 'supervisor',
			self::ZERO => 'zero',
		};
	}

} //> end of enum ~ Type
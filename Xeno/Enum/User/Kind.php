<?php //*** Kind ~ enum » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Enum\User;

use Groy\Xeno\Trait\OptionX;

enum Kind: string
{
	// • trait
	use OptionX;




	// • cases
	case CLIENT = 'CLIENT';
	case CONTRACTOR = 'CONTRACTOR';
	case GUEST = 'GUEST';
	case PARTNER = 'PARTNER';
	case PROVIDER = 'PROVIDER';
	case STAFF = 'STAFF';
	case SUPPLIER = 'SUPPLIER';
	case ZERO = 'ZERO';





	// • === label »
	public function label(): string
	{
		return match ($this) {
			self::CLIENT => 'client',
			self::CONTRACTOR => 'contractor',
			self::GUEST => 'guest',
			self::PARTNER => 'partner',
			self::PROVIDER => 'provider',
			self::STAFF => 'staff',
			self::SUPPLIER => 'supplier',
			self::ZERO => 'zero',
		};
	}

} //> end of enum ~ Kind
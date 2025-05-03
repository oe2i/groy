<?php //*** Unit ~ enum » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Enum;

use Groy\Xeno\Trait\OptionX;

enum Unit: string
{
	// • trait
	use OptionX;




	// • cases
	case BAG = 'BAG';
	case CAN = 'CAN';
	case CRT = 'CRT';
	case DAY = 'DAY';
	case GAL = 'GAL';
	case KG = 'KG';
	case LEN = 'LEN';
	case LOT = 'LOT';
	case LTR = 'LTR';
	case MENDAY = 'MENDAY';
	case MONTH = 'MONTH';
	case MTR = 'MTR';
	case NOS = 'NOS';
	case PCS = 'PCS';
	case PER = 'PER';
	case PKT = 'PKT';
	case SET = 'SET';
	case WEEK = 'WEEK';
	case YARD = 'YARD';





	// • === label »
	public function label(): string
	{
		return match ($this) {
			self::BAG => 'bag',
			self::CAN => 'can',
			self::CRT => 'carton',
			self::DAY => 'day',
			self::GAL => 'gallon',
			self::KG => 'kilogram',
			self::LEN => 'length',
			self::LOT => 'lot',
			self::LTR => 'litre',
			self::MENDAY => 'men days',
			self::MONTH => 'month',
			self::MTR => 'meter',
			self::NOS => 'number',
			self::PCS => 'piece',
			self::PER => 'percent',
			self::PKT => 'packet',
			self::SET => 'set',
			self::WEEK => 'week',
			self::YARD => 'yard',
		};
	}

} //> end of enum ~ Unit
<?php //*** CalculateX ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Number;

class CalculateX
{
	// • === minus »
	public static function minus($amount, $less, $decimal = 2, $pad = false)
	{
		$compute = $amount - $less;
		return DecimalX::format($compute, $decimal, $pad);
	}




	// • === plus »
	public static function plus($amount, $plus, $decimal = 2, $pad = false)
	{
		$compute = $amount + $plus;
		return DecimalX::format($compute, $decimal, $pad);
	}




	// • === multiply »
	public static function multiply($amount, $number, $decimal = 2, $pad = false)
	{
		$compute = $amount * $number;
		return DecimalX::format($compute, $decimal, $pad);
	}




	// • === divide »
	public static function divide($amount, $number, $decimal = 2, $pad = false)
	{
		$compute = $amount / $number;
		return DecimalX::format($compute, $decimal, $pad);
	}




	// • === price »
	public static function price($price, $quantity = 1, $decimal = 2, $pad = false)
	{
		return self::multiply($price, $quantity, $decimal, $pad);
	}




	// • === percent »
	public static function percent($amount, $percent, $decimal = 2, $pad = false)
	{
		$compute = ($percent / 100) * $amount;
		return DecimalX::format($compute, $decimal, $pad);
	}




	// • === percentOf » what percent of the total is an amount
	public static function percentOf($amount, $total)
	{
		return ($amount / $total) * 100;
	}




	// • === holding » with-holding tax
	public static function holding($amount, $percent = '5')
	{
		return self::percent($amount, $percent);
	}




	// • === vat »
	public static function vat($amount, $percent = '7.5')
	{
		return self::percent($amount, $percent);
	}

} //> end of class ~ CalculateX
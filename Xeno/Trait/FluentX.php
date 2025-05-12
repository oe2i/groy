<?php //*** FluentX ~ trait » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Trait;

trait FluentX
{
	// ◇ property
	private $fluent;





	// ◇ === construct » to allow static class instantiation
	public function __construct()
	{
	}




	// ◇ === chain »
	public static function chain($fluent): static
	{
		$obj = new static;
		$obj->fluent = $fluent;
		return $obj;
	}





	// ◇ === bind »
	public function bind($method, ...$args): static
	{
		if (method_exists(static::class, $method)) {
			array_unshift($args, $this->fluent);
			$this->fluent = static::$method(...$args);
		} elseif (method_exists($this, $method)) {
			array_unshift($args, $this->fluent);
			$this->fluent = $this->$method(...$args);
		} else {
			throw new \BadMethodCallException("Method '$method' not found.");
		}

		return $this;
	}





	// ◇ === __toString »
	public function __toString(): string
	{
		return $this->fluent;
	}





	// ◇ === fluent »
	public function fluent()
	{
		return $this->fluent;
	}

} //> end of trait ~ FluentX
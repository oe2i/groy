<?php //*** Alias ~ class » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

use App\Yaic\Vine\Auth\Organizer;

// namespace Groy;
// use RecursiveIteratorIterator;
// use RecursiveDirectoryIterator;

class Alias
{
	// • property
	private $rd;




	// • === construct »
	public function __construct($rd = '')
	{
		if (empty($rd)) {
			$rd = __DIR__;
		}

		if (!empty($rd)) {
			$this->rd = rtrim($rd, DIRECTORY_SEPARATOR);
		}

	}




	// • === className »
	private function className($path)
	{
		$className = basename($path, '.php');
		if (preg_match('/^[A-Z][a-zA-Z0-9]*$/', $className)) {
			return $className;
		}
		return null;
	}




	// • === namespace »
	private function namespace($path)
	{
		$pathWithoutClass = dirname($path);
		$namespace = str_replace(DIRECTORY_SEPARATOR, '\\', $pathWithoutClass);

		if (!empty($namespace)) {
			return 'Groy' . '\\' . $namespace;
		}
	}




	// • === generate »
	public function generate()
	{
		$result = [];

		if (!is_dir($this->rd)) {
			return $result;
		}

		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($this->rd),
			RecursiveIteratorIterator::LEAVES_ONLY
		);

		foreach ($files as $file) {
			if ($file->isFile() && $file->getExtension() === 'php') {
				$path = str_replace($this->rd . DIRECTORY_SEPARATOR, '', $file->getRealPath());
				$className = $this->className($path);
				$this->organize($className, $path, $result);
			}
		}

		return $result;
	}




	// • === exclude »
	private function organize($class, $path, &$result)
	{
		if (
			$class
			&& str_ends_with($class, 'X')
			&& !str_contains(strtolower($path), 'trait\\')
		) {
			$namespace = $this->namespace($path);
			$className = $namespace . '\\' . $class;


			// ... for string child-classes
			if (str_contains(strtolower($className), 'string\\')) {
				$class = 'Str' . $class;
			}

			// ... for array child-classes
			if (str_contains(strtolower($className), 'array\\')) {
				$class = 'Arr' . $class;
			}

			$result[$class] = $className;
		}

		return $result;
	}

} //> end of class ~ Alias

<?php //*** Image ~ enum » Groy™ Library © May, 2025 ∞ OE2i™ • www.oe2i.com ∞ Apache License ***//

namespace Groy\Xeno\Enum;

use Groy\Xeno\Trait\Option as OptionTraitX;

enum Image: string
{
	// • trait
	use OptionTraitX;




	// • cases
	case PNG = 'PNG';
	case SVG = 'SVG';
	case JPG = 'JPG';
	case GIF = 'GIF';

} //> end of enum ~ Image

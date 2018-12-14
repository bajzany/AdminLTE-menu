<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\LTEMenu\Exceptions;

use Bajzany\LTEMenu\Panel\LeftPanel\Item;

class LTEException extends \Exception
{

	/**
	 * @param string $interface
	 * @return LTEException
	 */
	public static function componentNotExist(string $interface)
	{
		return new self("Component {$interface} doesn't exist");
	}

	/**
	 * @return LTEException
	 */
	public static function isNotItemControl()
	{
		return new self("Is not instance of IItemControl");
	}

}

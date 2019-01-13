<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE\Exceptions;

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
	 * @param string $group
	 * @return LTEException
	 */
	public static function groupExists(string $group)
	{
		return new self("Group exists '{$group}'");
	}

	/**
	 * @return LTEException
	 */
	public static function isNotItemControl()
	{
		return new self("Is not instance of IItemControl");
	}

	/**
	 * @param string $id
	 * @return LTEException
	 */
	public static function duplicityIdentification(string $id)
	{
		return new self("Duplicity identification {$id}");
	}

	/**
	 * @return LTEException
	 */
	public static function isNotBuild()
	{
		return new self("Menu is not build");
	}

}

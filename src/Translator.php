<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\LTEMenu;

use Nette\Localization\ITranslator;

class Translator implements ITranslator
{

	public function translate($message, $count = NULL)
	{
		return $message;
	}

}

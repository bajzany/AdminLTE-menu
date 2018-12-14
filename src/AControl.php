<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE;

use Nette\Application\UI\Control;
use Nette\Localization\ITranslator;

abstract class AControl extends Control
{

	/**
	 * @var ITranslator|null
	 */
	protected $translator;

	/**
	 * @return ITranslator|null
	 */
	public function getTranslator(): ?ITranslator
	{
		return $this->translator;
	}

	/**
	 * @param ITranslator $translator
	 * @return $this
	 */
	public function setTranslator(ITranslator $translator)
	{
		$this->translator = $translator;
		return $this;
	}

}

<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE\Panel\TopPanel;

use Nette\Application\UI\Control;
use Nette\Localization\ITranslator;

abstract class ItemControl extends Control implements IItemControl
{

	/**
	 * @var ITranslator
	 */
	private $translator;

	/**
	 * @var ControlItem
	 */
	private $item;

	/**
	 * @return ITranslator|null
	 */
	public function getTranslator(): ?ITranslator
	{
		return $this->translator;
	}

	/**
	 * @param \Nette\ComponentModel\IComponent $presenter
	 */
	protected function attached($presenter)
	{
		parent::attached($presenter);
		$this->startup();
	}

	protected function startup()
	{
		//TODO:: your startup method
	}

	/**
	 * @param ITranslator $translator
	 * @return mixed|void
	 */
	public function setTranslator(ITranslator $translator)
	{
		$this->translator = $translator;
	}

	protected function setDefault()
	{
		$this->template->item = $this->getItem();
		$this->template->setTranslator($this->getTranslator());
	}

	public function renderWrapped()
	{
		$this->setDefault();
		$this->template->setFile(__DIR__ . '/../../templates/controlWrapped.latte');
		$this->template->render();
	}

	/**
	 * @return ControlItem
	 */
	public function getItem(): ?ControlItem
	{
		return $this->item;
	}

	/**
	 * @param ControlItem $item
	 */
	public function setItem(ControlItem $item)
	{
		$this->item = $item;
	}

}

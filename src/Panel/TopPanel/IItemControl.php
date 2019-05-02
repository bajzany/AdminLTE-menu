<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE\Panel\TopPanel;

use Bajzany\AdminLTE\Menu;
use Nette\Localization\ITranslator;

interface IItemControl
{

	/**
	 * @return ITranslator|null
	 */
	public function getTranslator(): ?ITranslator;

	/**
	 * @param ITranslator $translator
	 * @return mixed
	 */
	public function setTranslator(ITranslator $translator);

	public function renderWrapped();

	public function renderContent();

	public function setItem(ControlItem $item);

	public function getItem(): ?ControlItem;

	/**
	 * @param Menu $menu
	 * @return int
	 */
	public function getSortPriority(Menu $menu): int;

}

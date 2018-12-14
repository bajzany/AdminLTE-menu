<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 14.12.2018
 */

namespace App\Core\LTEMenu\src\Panel\LeftPanel;

use Bajzany\LTEMenu\Exceptions\LTEException;
use Bajzany\LTEMenu\Panel\LeftPanel\Item;

class Group
{

	/**
	 * @var string|null
	 */
	private $identification;

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var Item[]
	 */
	private $items = [];

	public function __construct(string $identification)
	{
		$this->setIdentification($identification);
	}

	/**
	 * @return Item[]
	 */
	public function getItems(): array
	{
		return $this->items;
	}

	/**
	 * @param Item $item
	 */
	public function addItem(Item $item)
	{
		$this->items[] = $item;
	}

	/**
	 * @return string
	 */
	public function getTitle(): ?string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * @return string|null
	 */
	public function getIdentification(): ?string
	{
		return $this->identification;
	}

	/**
	 * @param string|null $identification
	 */
	public function setIdentification($identification)
	{
		$this->identification = $identification;
	}

}

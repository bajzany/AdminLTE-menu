<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\LTEMenu\Panel\LeftPanel;

/**
 * Class Item
 * @package Bajzany\Menu
 * @author Radek Zika <radek.zika@dipcom.cz>
 */
class Item
{

	/**
	 * @var string
	 */
	private $identification;

	/**
	 * @var string
	 */
	private $label;

	/**
	 * @var string
	 */
	private $link = '#';

	/**
	 * @var Icon
	 */
	private $icon;

	/**
	 * @var Label[]
	 */
	private $rightLabels = [];

	/**
	 * @var Item|null
	 */
	private $parent;

	/**
	 * @var Item[]
	 */
	private $children = [];

	/**
	 * @param string $identification
	 */
	public function __construct(string $identification)
	{
		$this->setIdentification($identification);
		$this->icon = new Icon();
	}

	/**
	 * @return string
	 */
	public function getLabel(): ?string
	{
		return $this->label;
	}

	/**
	 * @param string $label
	 */
	public function setLabel($label)
	{
		$this->label = $label;
	}

	/**
	 * @return string
	 */
	public function getLink(): ?string
	{
		return $this->link;
	}

	/**
	 * @param string $link
	 */
	public function setLink($link)
	{
		$this->link = $link;
	}

	/**
	 * @return Icon|null
	 */
	public function getIcon(): ?Icon
	{
		return $this->icon;
	}

	/**
	 * @param Icon $icon
	 */
	public function setIcon(Icon $icon)
	{
		$this->icon = $icon;
	}

	/**
	 * @return Label[]
	 */
	public function getRightLabels(): array
	{
		return $this->rightLabels;
	}

	/**
	 * @param Label $rightLabel
	 */
	public function addRightLabel(Label $rightLabel)
	{
		$this->rightLabels[] = $rightLabel;
	}

	/**
	 * @return Item[]
	 */
	public function getChildren(): array
	{
		return $this->children;
	}

	/**
	 * @param Item $child
	 */
	public function addChild(Item $child)
	{
		$child->setParent($this);
		$child->setIdentification($this->getIdentification() . '.' . $child->getIdentification());
		$this->children[] = $child;
	}

	/**
	 * @return bool
	 */
	public function hasChildren(): bool
	{
		return !empty($this->getChildren());
	}

	/**
	 * @return bool
	 */
	public function hasRightLabels(): bool
	{
		return !empty($this->getRightLabels());
	}

	/**
	 * @return string|null
	 */
	public function getIdentification(): ?string
	{
		return $this->identification;
	}

	/**
	 * @param string $identification
	 */
	public function setIdentification(string $identification)
	{
		$this->identification = $identification;
	}

	/**
	 * @return Item|null
	 */
	public function getParent(): ?Item
	{
		return $this->parent;
	}

	/**
	 * @param Item|null $parent
	 */
	public function setParent($parent)
	{
		$this->parent = $parent;
	}

}

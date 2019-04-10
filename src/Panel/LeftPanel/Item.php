<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE\Panel\LeftPanel;

use Bajzany\AdminLTE\Exceptions\LTEException;

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
	private $link = [
		'destination' => '#',
		'parameters' => [],
	];

	/**
	 * @var Icon
	 */
	private $icon;

	/**
	 * @var Label[]
	 */
	private $rightLabels = [];

	/**
	 * @var Item|Group
	 */
	private $parent;

	/**
	 * @var Item[]
	 */
	private $children = [];

	/**
	 * @var bool
	 */
	private $active;

	/**
	 * @var bool
	 */
	private $selected;

	private $hidden = FALSE;

	/**
	 * @param string $identification
	 * @param Group|Item $parent
	 */
	public function __construct(string $identification, $parent)
	{
		$this->identification = $identification;
		$this->parent = $parent;
		$this->icon = new Icon();
		$this->active = FALSE;
		$this->selected = FALSE;
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
	 * @return Item
	 */
	public function setLabel($label)
	{
		$this->label = $label;
		return $this;
	}

	/**
	 * @param bool $hidden
	 */
	public function setHidden($hidden = TRUE)
	{
		$this->hidden = $hidden;
	}

	/**
	 * @return bool
	 */
	public function isHidden(): bool
	{
		return $this->hidden;
	}

	/**
	 * @return string
	 */
	public function getLink(): array
	{
		return $this->link;
	}

	/**
	 * @param string $destination
	 * @return Item
	 */
	public function setLink($destination, array $parameters = [])
	{
		$this->link = [
			"destination" => $destination,
			"parameters" => $parameters
		];
		return $this;
	}

	/**
	 * @return Icon|null
	 */
	public function getIcon(): ?Icon
	{
		return $this->icon;
	}

	/**
	 * @param string $class
	 * @param string $color
	 * @return Icon
	 */
	public function setIcon(string $class = 'fa fa-dashboard', string $color = 'white')
	{
		$icon = new Icon();
		$icon->setFontAwesome($class);
		$icon->setIconColor($color);
		$this->icon = $icon;
		return $icon;
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
	 * @param string $identification
	 * @return Item
	 */
	public function createChild(string $identification)
	{
		$item = new Item($this->getIdentification() . '.' . $identification, $this);
		$this->children[] = $item;
		return $item;
	}

	/**
	 * @return bool
	 */
	public function hasChildren(bool $hidden = FALSE): bool
	{
		if (!$hidden) {
			foreach ($this->getChildren() as $child) {
				if ($child->isHidden() === FALSE) {
					return TRUE;
				}
			}
			return FALSE;
		}

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
	 * @return Item|Group
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * @param string $link
	 * @return bool
	 */
	public function isActiveLink(string $link): bool
	{
		return $this->searchLink($link, $this);
	}

	/**
	 * @param string $link
	 * @param Item $item
	 * @return bool
	 */
	private function searchLink(string $link, Item $item): bool
	{
		if ($item->getLink() == $link) {
			return TRUE;
		}

		foreach ($this->getChildren() as $child) {
			return $this->searchLink($link, $child);
		}

		return FALSE;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 * @param bool $selected
	 * @return Item
	 */
	public function setActive($active, $selected = FALSE)
	{
		$this->selected = $selected;
		$this->active = $active;
		if (!empty($this->getParent())) {
			$this->parent->setActive(TRUE);
		}
		return $this;
	}

	/**
	 * @return Group
	 */
	public function getGroup()
	{
		if ($this->parent instanceof Group) {
			return $this->parent;
		}
		return $this->parent->getGroup();
	}

	/**
	 * @return Item|null
	 */
	public function getParentItem(): ?Item
	{
		if ($this->parent instanceof Group) {
			return NULL;
		}
		return $this->parent;
	}

	/**
	 * @return bool
	 */
	public function isSelected(): bool
	{
		return $this->selected;
	}

	/**
	 * @return Item[]
	 * @throws \Exception
	 */
	public function getItemsList()
	{
		$list = [];
		foreach ($this->children as $item) {
			$list[$item->getIdentification()] = $item;
			$this->recursiveList($item, $list);
		}
		return $list;
	}

	/**
	 * @param Item $item
	 * @param array $list
	 * @throws \Exception
	 */
	private function recursiveList(Item $item, &$list = [])
	{
		foreach ($item->getChildren() as $child) {
			if (array_key_exists($child->getIdentification(), $list)) {
				throw LTEException::duplicityIdentification($child->getIdentification());
			}
			$list[$child->getIdentification()] = $child;
			$this->recursiveList($child, $list);
		}
	}

	/**
	 * @return Item[]
	 * @throws \Exception
	 */
	public function getVisibleChildren(): array
	{
		$visibleChildren = [];

		$list = $this->getItemsList();
		foreach ($list as $item) {
			if ($item->isHidden()) {
				continue;
			}
			$visibleChildren[] = $item;
		}

		return $visibleChildren;
	}

}

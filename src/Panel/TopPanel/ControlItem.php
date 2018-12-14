<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE\Panel\TopPanel;

use Bajzany\AdminLTE\Exceptions\LTEException;
use Nette\Application\UI\Control;

class ControlItem
{

	/**
	 * @var string|null
	 */
	private $iconClass = 'fa fa-envelope-o';

	/**
	 * @var string|null
	 */
	private $labelText;

	/**
	 * @var string
	 */
	private $labelClass = 'label-success';

	/**
	 * @var string|null
	 */
	private $interface;

	/**
	 * @var Control
	 */
	private $component;

	/**
	 * @param string $interface
	 * @throws LTEException
	 */
	public function __construct(string $interface)
	{
		if (!interface_exists($interface)) {
			throw LTEException::componentNotExist($interface);
		}

		$this->interface = $interface;
	}

	/**
	 * @return string|null
	 */
	public function getIconClass(): ?string
	{
		return $this->iconClass;
	}

	/**
	 * @param string|null $iconClass
	 */
	public function setIconClass($iconClass)
	{
		$this->iconClass = $iconClass;
	}

	/**
	 * @return string|null
	 */
	public function getLabelText(): ?string
	{
		return $this->labelText;
	}

	/**
	 * @param string|null $labelText
	 */
	public function setLabelText($labelText)
	{
		$this->labelText = $labelText;
	}

	/**
	 * @return string
	 */
	public function getLabelClass(): string
	{
		return $this->labelClass;
	}

	/**
	 * @param string $labelClass
	 */
	public function setLabelClass($labelClass)
	{
		$this->labelClass = $labelClass;
	}

	/**
	 * @return string|null
	 */
	public function getInterface(): ?string
	{
		return $this->interface;
	}

	/**
	 * @return Control
	 */
	public function getComponent(): Control
	{
		return $this->component;
	}

	/**
	 * @param Control $component
	 * @return $this
	 */
	public function setComponent(Control $component)
	{
		$this->component = $component;
		return $this;
	}

}

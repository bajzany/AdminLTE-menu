<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\AdminLTE;

use Bajzany\AdminLTE\Exceptions\LTEException;
use Bajzany\AdminLTE\Panel\TopPanel\ControlItem;
use Bajzany\AdminLTE\Panel\TopPanel\IItemControl;
use Bajzany\AdminLTE\Panel\TopPanel\ItemControl;
use Nette\DI\Container;
use Nette\Utils\Strings;

class Builder
{

	/**
	 * @var Container
	 */
	private $container;

	/**
	 * @var Menu
	 */
	private $menu;

	/**
	 * @var callable[]
	 */
	private $onBuild = [];

	/**
	 * @var bool
	 */
	private $built = FALSE;

	public function __construct(Container $container, Menu $menu)
	{
		$this->container = $container;
		$this->menu = $menu;
	}

	public function build()
	{
		if ($this->built) {
			return;
		}

		$serviceList = $this->getBuildMenuServices();

		foreach ($serviceList as $service) {
			$service->build($this->menu);
			foreach ($this->onBuild as $event) {
				if ($event['name'] === get_class($service)) {
					call_user_func_array($event['callable'], [$service]);
				}
			}
		}

		$menuControl = $this->menu->createComponent();

		foreach ($this->menu->getTopPanel()->getControls() as $controlItem) {
			$component = $this->createComponent($controlItem);
			$controlItem->setComponent($component);

			$component->setTranslator($this->menu->getTranslator());
			$component->setItem($controlItem);

			$names = Strings::webalize(get_class($component));
			$names = explode("-", $names);
			$names = array_map('ucfirst', $names);
			$name = implode("", $names);
			$menuControl->addComponent($component, $name);
		}

		$this->built = TRUE;
	}

	/**
	 * @param ControlItem $controlItem
	 * @return IItemControl
	 * @throws LTEException
	 */
	protected function createComponent(ControlItem $controlItem)
	{
		$factory = $this->container->getByType($controlItem->getInterface());
		/**
		 * @var ItemControl $control
		 */
		$control = $factory->create();
		if (!$control instanceof IItemControl) {
			throw LTEException::isNotItemControl();
		}

		return $control;
	}


	/**
	 * @return BundleMenu[]
	 */
	private function getBuildMenuServices()
	{
		$builds = $this->container->findByType(BundleMenu::class);

		$serviceList = [];
		foreach ($builds as $serviceName) {
			$service = $this->container->getService($serviceName);
			$serviceList[] = $service;
		}
		return $serviceList;
	}

	/**
	 * @return bool
	 */
	public function isBuilt(): bool
	{
		return $this->built;
	}

	/**
	 * @param string $className
	 * @param callable $callable
	 */
	public function onBuild(string $className, callable $callable)
	{
		$this->onBuild[] = [
			'name' => $className,
			'callable' => $callable
		];
	}

}

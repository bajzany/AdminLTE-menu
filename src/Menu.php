<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 13.12.2018
 */

namespace Bajzany\LTEMenu;

use Bajzany\LTEMenu\Panel\LeftPanel;
use Bajzany\LTEMenu\Panel\TopPanel;
use Nette\DI\Container;
use Nette\Localization\ITranslator;

class Menu
{

	/**
	 * @var string|null
	 */
	private $projectName;

	/**
	 * @var string|null
	 */
	private $projectShortName;

	/**
	 * @var TopPanel
	 */
	private $topPanel;

	/**
	 * @var LeftPanel
	 */
	private $leftPanel;

	/**
	 * @var Container
	 */
	private $container;

	/**
	 * @var Builder
	 */
	private $builder;

	/**
	 * @var ITranslator
	 */
	private $translator;

	/**
	 * @var MenuControl
	 */
	private $menuControl;

	public function __construct(Container $container)
	{
		$this->container = $container;
		$this->topPanel = new TopPanel($this);
		$this->leftPanel = new LeftPanel($this);
		$this->builder = new Builder($container, $this);
		$this->translator = new Translator();
	}

	public function createComponent()
	{
		if (!$this->menuControl) {
			/**
			 * @var MenuControl $menuControl
			 */
			$menuControl = $this->container->createInstance(MenuControl::class);
			$menuControl->setMenu($this);
			$menuControl->setTranslator($this->translator);
			$this->menuControl = $menuControl;
		}
		return $this->menuControl;
	}

	public function build()
	{
		$this->builder->build();
	}

	/**
	 * @return TopPanel
	 */
	public function getTopPanel(): TopPanel
	{
		return $this->topPanel;
	}

	/**
	 * @param TopPanel $topPanel
	 * @return $this
	 */
	public function setTopPanel($topPanel)
	{
		$this->topPanel = $topPanel;
		return $this;
	}

	/**
	 * @return LeftPanel
	 */
	public function getLeftPanel(): LeftPanel
	{
		return $this->leftPanel;
	}

	/**
	 * @return string|null
	 */
	public function getProjectName(): ?string
	{
		return $this->projectName;
	}

	/**
	 * @return string|null
	 */
	public function getProjectShortName(): ?string
	{
		return $this->projectShortName;
	}

	/**
	 * @param string|null $projectShortName
	 * @return $this
	 */
	public function setProjectShortName($projectShortName)
	{
		$this->projectShortName = $projectShortName;
		return $this;
	}

	/**
	 * @return Builder
	 */
	public function getBuilder(): Builder
	{
		return $this->builder;
	}

	/**
	 * @param string|null $projectName
	 * @return $this
	 */
	public function setProjectName($projectName)
	{
		$this->projectName = $projectName;
		return $this;
	}

	/**
	 * @return ITranslator
	 */
	public function getTranslator(): ITranslator
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

## AdminLTE - Nette menu

### Instalation

##### Composer

	composer require bajzany/adminlte-menu @dev 

##### Config

	extensions:
    	LTEMenu: Bajzany\AdminLTE\DI\AdminLTEMenuExtensions
    	
    	
### How to use

Inject this menu into your basePresenter

	/**
	 * @var Menu @inject
	 */
	public $menu;
	
	public function createComponentMenu()
	{
		$this->menu->setProjectName("PROJECT_NAME");
		$this->menu->setProjectShortName("SORT_PROJECT_NAME");
		$this->menu->setTranslator("OWN TRANSLATOR");
		return $this->menu->createComponent();
	}
	
Render in template:

	<!DOCTYPE html>
    <html>
    <head>
    	
    </head>
    
    <body class="skin-purple sidebar-mini fixed">
    	<div class="wrapper">
    	
    		//SECTION TOP
    		{control menu:top}
    		
			//SECTION LEFT
    		{control menu:left}
    		
    		
    		// YOUR CONTENT
    		<div class="content-wrapper">
    			{include content}
    		</div>
    	</div>
    	{include @adminTheme/bottom.latte}
    </body>
    </html>
    
If you want breadCrumb use this in your content latte

	{block content}
    
    {control menu:breadcrumb}
    


### ADD TO LIST MENU
 
Create php class BuildMenu witch implements Bajzany\AdminLTE\BundleMenu.
This class have one function build with parameter Bajzany\AdminLTE\Menu.

	#BuildMenu.php
	
    use Bajzany\AdminLTE\BundleMenu;
    use Bajzany\AdminLTE\Menu;
    use Bajzany\AdminLTE\Panel\TopPanel\ControlItem;
    use Bundles\User\Menu\DropDown\IUserDropDown;
    use Chomenko\AutoInstall\AutoInstall;
    use Chomenko\AutoInstall\Config;
    
    /**
     * @Config\Tag({"adminLTE.menu"})
     */
    class BuildMenu implements BundleMenu, AutoInstall
    {
    
    	public function build(Menu $menu)
    	{
    		
    	}
    
    }
    
##### LEFT PANEL:

For render left panel items.

	#BuildMenu.php
	
    namespace Bundles\User\Menu;
    
    use Bajzany\AdminLTE\BundleMenu;
    use Bajzany\AdminLTE\Menu;
    use Bajzany\AdminLTE\Panel\TopPanel\ControlItem;
    use Bundles\User\Menu\DropDown\IUserDropDown;
    
    class BuildMenu implements BundleMenu
    {
    
    	public function build(Menu $menu)
    	{
    		$leftPanel = $menu->getLeftPanel();
    
    		$userGroup = $leftPanel->createGroup('userGroup');
    		$userGroup->setTitle('User');
    		$users = $userGroup->createItem('users');
    		$users->setLabel('Users');
    		$users->setIcon('fa fa-users');
    
    		$users->createChild('userList')
    			->setLink('User:default')
    			->setLabel('List')
    			->setIcon('fa fa-user');
    
    		$users->createChild('userProfile')
    			->setLink('Profile:default')
    			->setLabel('Profile')
    			->setIcon('fa fa-user-circle');
    	}
    
    }


##### TOP PANEL:
For rendering topPanel items you needed another Control.

For example i use UserDropDown.



	#BuildMenu.php
	
 	namespace Bundles\User\Menu;
    
    use Bajzany\AdminLTE\BundleMenu;
    use Bajzany\AdminLTE\Menu;
    use Bajzany\AdminLTE\Panel\TopPanel\ControlItem;
    use Bundles\User\Menu\DropDown\IUserDropDown;
    
    class BuildMenu implements BundleMenu
    {
    
    	public function build(Menu $menu)
    	{
    		$control = new ControlItem(IUserDropDown::class);
			$menu->getTopPanel()->addControl($control);
    	}
    
    }
    
###### UserDropDown.php

UserDropDown must extend Bajzany\AdminLTE\Panel\TopPanel\ItemControl witch have 2 override methods renderContent and renderWrapped.
This is your custom render.


	#UserDropDown.php
	
	namespace Bundles\User\Menu\DropDown;
    
    use Bajzany\AdminLTE\Panel\TopPanel\ItemControl;
    use Nette\Security\User;
    
    class UserDropDown extends ItemControl
    {
    
    	/**
    	 * @var User @inject
    	 */
    	public $user;
    
    	public function renderContent()
    	{
    		$this->setDefault();
    		$this->template->user = $this->user->getIdentity();
    		$this->template->setFile(__DIR__ . '/userContent.latte');
    		$this->template->render();
    	}
    
    	public function renderWrapped()
    	{
    		$this->setDefault();
    		$this->template->user = $this->user->getIdentity();
    		$this->template->setFile(__DIR__ . '/userControlWrapped.latte');
    		$this->template->render();
    	}
    
    }


###### UserDropDown.php class need so interface factory

	#IUserDropDown.php
	
	namespace Bundles\User\Menu\DropDown;
    
    interface IUserDropDown
    {
    
    	/**
    	 * @return UserDropDown
    	 */
    	public function create(): UserDropDown;
    
    }


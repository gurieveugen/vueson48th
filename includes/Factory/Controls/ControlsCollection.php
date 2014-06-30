<?php 
namespace Factory\Controls;

class ControlsCollection{
	//                                       __  _          
	//     ____  _________  ____  ___  _____/ /_(_)__  _____
	//    / __ \/ ___/ __ \/ __ \/ _ \/ ___/ __/ / _ \/ ___/
	//   / /_/ / /  / /_/ / /_/ /  __/ /  / /_/ /  __(__  ) 
	//  / .___/_/   \____/ .___/\___/_/   \__/_/\___/____/  
	// /_/              /_/                                 
	private $controls;
	private $controls_by_name;
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct($controls = null)
	{
		$this->controls         = $controls;
		$this->controls_by_name = null;	
		$this->init();					
	}

	/**
	 * Initialize controls collection
	 */
	private function init()
	{
		if($this->controls)
		{
			foreach ($this->controls as $ctrl) 
			{
				$this->controls_by_name[$ctrl->name] = $ctrl;
			}
		}
	}	 

	/**
	 * Get count countrols
	 * @return integer --- count controls
	 */
	public function getCount()                           
	{		
		return count($this->controls);
	}

	/**
	 * Get all controls by ID
	 * @return array --- controls array by ID
	 */
	public function getControls()
	{
		return $this->controls;
	}                 

	/**
	 * Get one control by ID
	 * @param  integer $ID --- index
	 * @return mixed       --- control [object] | NULL
	 */
	public function getControlByID($ID = 0)
	{
		return isset($this->controls[$ID]) ? $this->controls[$ID] : null;
	}

	/**
	 * Get one control by Name
	 * @param  integer $name --- name
	 * @return mixed         --- control [object] | NULL
	 */
	public function getControlByName($name = '')
	{			
		return isset($this->controls_by_name[$name]) ? $this->controls_by_name[$name] : null;
	}
}
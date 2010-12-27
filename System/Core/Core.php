<?php
/**
 *	OUTRAGEbot development
 */


class Core
{
	private static
		$aModules = array(),
		$aInstances = array();
	
	
	public static
		$aPluginCache = array();
	
	
	/**
	 *	Called to load a module
	 */
	static function Module($sModule)
	{
		$sModuleLocation = ROOT."/System/Modules/{$sModule}.php";
		
		if(file_exists($sModuleLocation))
		{
			include $sModuleLocation;
			
			self::$aModules[] = "Module{$sModule}";
			
			return true;
		}
		
		return false;
	}
	
	
	/**
	 *	Called to load a core module
	 */
	static function LModule($sModule)
	{
		$sModuleLocation = ROOT."/System/Core/{$sModule}.php";
		
		if(file_exists($sModuleLocation))
		{
			include $sModuleLocation;
			
			self::$aModules[] = "Core{$sModule}";
			
			return true;
		}
		
		return false;
	}
	
	
	/**
	 *	Called to load a system class.
	 */
	static function Library($sClass)
	{
		$sClassLocation = ROOT."/System/Core/{$sClass}.php";
		
		if(file_exists($sClassLocation))
		{
			include $sClassLocation;
			return true;
		}
		
		return false;
	}
	
	
	/**
	 *	Called on every iteration, deals with global modules.
	 */
	static function Tick()
	{
		foreach(self::$aModules as $sModuleClass)
		{
			if(is_callable($sModuleClass.'::onTick'))
			{
				$sModuleClass::onTick();
			}
		}
	}
	
	
	/**
	 *	Called on every iteration, deals with the sockets.
	 */
	static function Socket()
	{
		foreach(self::$aInstances as $pInstance)
		{
			$pInstance->Socket();
		}
	}
	
	
	/**
	 *	Scan the configuration directory for settings.
	 */
	static function scanConfig()
	{
		foreach(glob(ROOT.'/Configuration/*.ini') as $sDirectory)
		{
			CoreConfiguration::ParseLocation($sDirectory);
		}
	}
	
	
	/**
	 *	Adds an instance of the master class to the core.
	 */
	static function addInstance($sInstance, $pInstance)
	{
		self::$aInstances[$sInstance] = $pInstance;
	}
	
	
	/**
	 *	Deals with the callback handlers
	 */
	static function Handler(CoreMaster $pInstance, $pMessage)
	{
		$sNumeric = $pMessage->Numeric;
		
		if(!method_exists("CoreHandler", $sNumeric))
		{
			return CoreHandler::Unhandled($pInstance, $pMessage);
		}
		
		return CoreHandler::$sNumeric($pInstance, $pMessage);
	}
}
<?php if (!defined('APPLICATION')) exit();
 
class BearsThemesHooks implements Gdn_IPlugin {
	public function NBBCPlugin_AfterNBBCSetup_Handler($Sender, $Args) {
		$BBCode = $Args['BBCode'];
	}
 
 
	public function Setup() {
		
	}
}
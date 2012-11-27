<?php if(!defined('APPLICATION')) exit();

$PluginInfo['AddonManager'] = array(
	'Name'			=>	'Addon Manager',
	'Description' 	=>	'This Plugin automaticly downloads and unzipps new Addons and puts them into the right folder. Administrators only have to copy the URL of the specific Addon.',
	'Version' 		=>	'0.2.0',
	'Author' 		=>	"NiklasG",
	'AuthorEmail' 	=>	'niklas@pernix.de',
	'AuthorUrl' 	=>	'http://vanillaforums.org/profile/17109/niklasg',
	'HasLocale' => TRUE
);

class AddonManagerPlugin extends Gdn_Plugin {
		
	public function PluginController_AddonManager_Create(&$Sender) {
	
		$Sender->AddSideMenu('plugin/addonmanager');
		$Sender->Form = new Gdn_Form();
		$Validation = new Gdn_Validation();
		$ConfigurationModel = new Gdn_ConfigurationModel($Validation);
		$ConfigurationModel->SetField(array('AddonManager.FileUrl', 'AddonManager.FileTyp'));
		$Sender->Form->SetModel($ConfigurationModel);
            
		if ($Sender->Form->AuthenticatedPostBack() === FALSE) {
			$Sender->Form->SetData($ConfigurationModel->Data);
		} else {
			$Data = $Sender->Form->FormValues();
			$ConfigurationModel->Validation->ApplyRule('AddonManager.FileUrl', 'Required');
			$ConfigurationModel->Validation->ApplyRule('AddonManager.FileTyp', 'Required');
			if ($Sender->Form->Save() !== FALSE) {
				// include ZIP lib
				require_once(PATH_PLUGINS . DS . 'AddonManager' . DS . 'lib' . DS . 'pclzip.lib.php');
			
				$FileUrl = Gdn::Config('AddonManager.FileUrl');
				$FileTyp = Gdn::Config('AddonManager.FileTyp');	
				$FileContent = file_get_contents($FileUrl);
				
				if (substr($FileUrl, -3) == 'zip') { // Check if Addon is ZIP					
					
					// set install path
					switch ($FileTyp) {
						default: 
							$InstallPath = PATH_PLUGINS . DS;
							break;
						case 0: 
							$InstallPath = PATH_PLUGINS . DS;
							break;
						case 1: 
							$InstallPath = PATH_THEMES . DS;
							break;						
						/* case 2: 
							$InstallPath = PATH_LOCALES . DS;
							break; */					
						case 3: 
							$InstallPath = PATH_APPLICATIONS . DS;
							break;
					}		
					
					// difine tmp archive
					$FileTmpName = 'addonmanager_tmp_t' . $FileTyp . '.zip';
					
					if ($FileNew = fopen($FileTmpName, 'x')) {
						fwrite($FileNew, $FileContent);
						fclose($FileNew);
						
						// unzipps with lib						
						$archive = new PclZip($FileTmpName);
						if (($v_result_list = $archive->extract(PCLZIP_OPT_PATH, $InstallPath)) == 0) {
							die($Sender->StatusMessage = T('Error while unzipping.'));
						}
						
						// delete tmp archive
						unlink($FileTmpName);
								
						$Sender->StatusMessage = T('Addon has been successfully installed.');
					} else {
						$Sender->StatusMessage = T('Addon already exists.');
					}
				} else {
					$Sender->StatusMessage = T('Addon has to be an ZIP file.');
				}	
			}
		}
      
		$Sender->View = dirname(__FILE__) . DS . 'view' . DS . 'manager.php';
		$Sender->Render();
	}		

	public function Base_GetAppSettingsMenuItems_Handler(&$Sender) {
		$Menu = $Sender->EventArguments['SideMenu'];
		$Menu->AddLink('Add-ons', T('Addon Manager'), 'plugin/addonmanager', 'Garden.Settings.Manage');
	}

	public function Setup() { 
		// No setup required.
	}
   
}

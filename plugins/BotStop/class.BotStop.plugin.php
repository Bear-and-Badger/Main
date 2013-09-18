<?php if (!defined('APPLICATION')) exit();

// Define the plugin:
$PluginInfo['BotStop'] = array(
   'Description' => 'Adds a question designed to stop bots from registering',
   'Version' => '1.0.1',
   'Author' => "David Massey",
   'AuthorEmail' => 'davidmassey@carolina.rr.com',
   'AuthorUrl' => ''
);


class BotStop extends Gdn_Plugin 

{

public function Setup() 
        {
        SaveToConfig('Plugins.BotStop.Question', 'What is three plus four?');
        SaveToConfig('Plugins.BotStop.Answer1', '7');
        SaveToConfig('Plugins.BotStop.Answer2', 'seven');
        }


	public function EntryController_Render_Before($Sender,$Args)
	{
		if(strcasecmp($Sender->RequestMethod,'register')==0)
		{
			if(strcasecmp($Sender->View,'registerthanks')!=0 && strcasecmp($Sender->View,'registerclosed')!=0)
			{
				$RegistrationMethod = Gdn::Config('Garden.Registration.Method');
				$Sender->View = $this->GetView( 'register'.strtolower($RegistrationMethod).'.php');
			}
		}
    }

	public function UserModel_BeforeRegister_Handler($Sender)
	{
        $test = $Sender->EventArguments['User']['BotCheck'];
$a1 = C('Plugins.BotStop.Answer1');
$a2 = C('Plugins.BotStop.Answer2');

if ($test != $a1 && strtolower($test) != $a2)
{
        $Sender->Validation->AddValidationResult('BotCheck','Your humanity is suspect... Please try again.');
        $Sender->EventArguments['Valid'] = FALSE;
}
       // return FALSE;
	}


	public function Base_GetAppSettingsMenuItems_Handler($Sender)
	{
		$Menu = $Sender->EventArguments['SideMenu'];
		$Menu->AddItem('Forum', T('Forum'));
		$Menu->AddLink('Forum', T('BotStop'), 'settings/botstop', 'Garden.Settings.Manage');
	}


	public function SettingsController_BotStop_Create($Sender)
	{

		$Sender->Permission('Garden.Settings.Manage');
                $Sender->Form = new Gdn_Form();
                $Validation = new Gdn_Validation();
                $ConfigurationModel = new Gdn_ConfigurationModel($Validation);
                $ConfigurationModel->SetField(array('Plugins.BotStop.Question','Plugins.BotStop.Answer1','Plugins.BotStop.Answer2',));
                $Sender->Form->SetModel($ConfigurationModel);
		$Sender->Title('BotStop Plugin Settings');
		$Sender->AddSideMenu('settings/botstop');

    if ($Sender->Form->AuthenticatedPostBack() === FALSE) 
     {
     $Sender->Form->SetData($ConfigurationModel->Data);
     } 
     else 
     {
     $Data = $Sender->Form->FormValues();
     if ($Sender->Form->Save() !== FALSE) $Sender->StatusMessage = T("Your settings have been saved.");
     }
    $Sender->Render($this->GetView('settings.php'));
	}
}

?>
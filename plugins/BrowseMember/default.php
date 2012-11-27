<?php if (!defined('APPLICATION')) exit();

// Define the plugin:
$PluginInfo['BrowseMember'] = array(
   'Name' => 'BrowseMember',
   'Description' => 'A simple one pager List of Members that can be accessed at www.domain.com/plugin/BrowseMember',
   'Version' => '1.0',
   'Author' => "Adrian Lee",
   'AuthorEmail' => 'l33.adrian@gmail.com',
   'AuthorUrl' => 'http://pinoyau.info'
);

class BrowseMemberPlugin implements Gdn_IPlugin {	
	
	public function PluginController_BrowseMember_Create(&$Sender) {
				

		$this->MainLogic($Sender,((count($Sender->RequestArgs)>0)?$Sender->RequestArgs[0]:FALSE),((count($Sender->RequestArgs)>0)?$Sender->RequestArgs[1]:""));
	}
	
	public function Base_Render_Before($Sender) {
      // Add "Mark All Viewed" to menu
      $Session = Gdn::Session();
      if ($Sender->Menu && $Session->IsValid()) {
         // Comment out this next line if you want to put the link somewhere else manually
         $Sender->Menu->AddLink('BrowseMember', T('Browse members'), '/plugin/browsemember');
      }
   }

	public function MainLogic(&$Sender,$Offset = FALSE,$Keywords = ""){
		$Session = Gdn::Session();
		$Sender->Form = new Gdn_Form();
		$Sender->AddJsFile('jquery.gardenmorepager.js');
		$Sender->Title(T('Browse Users'));
		$Sender->Form->Method = 'get';

		// Input Validation
		$Offset = is_numeric($Offset) ? $Offset : 0;
		if (!$Keywords) {
			$Keywords = $Sender->Form->GetFormValue('Keywords');
			if ($Keywords) $Offset = 0;
		}

		// Put the Keyword back in the form
		if ($Keywords)
		$Sender->Form->SetFormValue('Keywords', $Keywords);	  
		$UserModel = new UserModel();
		$Limit = 30;
		$TotalRecords = $UserModel->SQL
         ->Select('u.UserID', 'count', 'UserCount')
         ->From('User u')
		 ->Where('u.Deleted', 0)
		 ->Like('u.Name', $Keywords, 'right')
		 ->Get()
		 ->FirstRow()->UserCount;
	
		//Select Users
		$Sender->UserData = $UserModel->SQL
				->Select('u.*')
				->From('User u')         		 
				->Where('u.Deleted', 0)
				->Like('u.Name', $Keywords, 'right')
				->OrderBy('u.Name', $OrderDirection)
				->Limit($Limit, $Offset)
				->Get();
		
		//Pager
		$PagerFactory = new Gdn_PagerFactory();
		$Sender->Pager = $PagerFactory->GetPager('MorePager', $Sender);
		$Sender->Pager->MoreCode = 'More';
		$Sender->Pager->LessCode = 'Previous';
		$Sender->Pager->ClientID = 'Pager';
		$Sender->Pager->Wrapper = '<div %1$s>%2$s</div>';
		$Sender->Pager->Configure(
			$Offset,
			$Limit,
			$TotalRecords,
			'plugin/BrowseMember/%1$s/'.urlencode($Keywords)
		);
		
		//Rendering the users
		$Path = PATH_PLUGINS . DS . 'BrowseMember' . DS . 'files' . DS;
		$Page = 'default';
		//keep this intact
		if ($this->_DeliveryType != DELIVERY_TYPE_ALL) {		
			$Sender->SetJson('LessRow', $Sender->Pager->ToString('less'));
			$Sender->SetJson('MoreRow', $Sender->Pager->ToString('more'));
			$Sender->View = $Path.'users.php';
		}
		
		$Sender->ClearCssFiles();
		$Sender->AddCssFile('style.css');
		$Sender->MasterView = 'default';
		if($Offset > 0){ // just generate the users template
			$Sender->Render($Path.'users.php');
		}else{ // just the default including the search test field
			$Sender->Render($Path.$Page.'.php');
		}
	}

	public function Setup() {
	// No setup required.
	}
}
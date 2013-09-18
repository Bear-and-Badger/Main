<?php if (!defined('APPLICATION')) exit();
 
$PluginInfo['Tapatalk'] = array(
   'Name' => 'Tapatalk',
   'Description' => 'Tapatalk Plugin for Vanilla 2',
   'Version' => 'vn20_1.1.0',
   'Author' => "Tapatalk",
   'AuthorEmail' => 'admin@tapatalk.com',
   'AuthorUrl' => 'http://tapatalk.com',
   'MobileFriendly' => true
);

class TapatalkPlugin extends Gdn_Plugin {
    
    public function DiscussionController_BeforeDiscussionRender_Handler(&$Sender) {
        $Sender->AddJsFile('/mobiquo/tapatalkdetect.js');
    }

	public function Setup() {
	}
	
}

?>
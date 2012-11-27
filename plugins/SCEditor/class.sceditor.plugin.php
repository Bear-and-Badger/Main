<?php if (!defined('APPLICATION')) exit();

/**
 * ButtonBar Plugin
 * 
 * @author Tim Gunter <tim@vanillaforums.com>
 * @copyright 2003 Vanilla Forums, Inc
 * @license http://www.opensource.org/licenses/gpl-2.0.php GPL
 * @package Addons
 */

$PluginInfo['SCEditor'] = array(
   'Name' => 'SCEditor',
   'Description' => 'Implements SCEditor for post formatting.',
   'Version' => '1.0',
   'Author' => "Peter Hughes",
   'AuthorEmail' => 'phughes.dev@gmail.com',
   'AuthorUrl' => 'http://www.peterhughesdev.com'
);

class SCEDitorPlugin extends Gdn_Plugin {
 	public function Base_Render_Before($Sender) {
		if( !IsMobile() ) {
			$Sender->RemoveJsFile('jquery.autogrow.js');
			$Sender->AddJsFile('jquery.sceditor.min.js', 'plugins/SCEditor');
			$Sender->addCssFile('jquery.sceditor.min.css', 'plugins/SCEditor');
		//	$Sender->addCssFile('jquery.sceditor.default.min.css', 'plugins/SCEditor');
			
			$Sender->Head->addString( $Sender->FetchView('sceditor','','plugins/SCEditor') );
		}
	}
}
<?php if (!defined('APPLICATION')) die();

$PluginInfo['SimpleVideo'] = array(
    'Description' => 'Support various BBCode video embeds',
    'Version' => '1.0.0',
    'Author' => 'Peter Hughes',
	'MobileFriendly' => TRUE,
    'AuthorEmail' => 'peterhughes.dev@gmail.com',
    'AuthorUrl' => 'http://www.peterhughesdev.com'
);

class SimpleVideoPlugin extends Gdn_Plugin {
	public function NBBCPlugin_AfterNBBCSetup_Handler($Sender, $Args) {
		$BBCode = $Args['BBCode'];
		
		$youtube = Array(
			'mode' => BBCODE_MODE_ENHANCED,
			'template' => '<iframe width="560" height="315" src="http://www.youtube.com/embed/{$_content}?wmode=opaque" data-youtube-id="{$_content}" frameborder="0" allowfullscreen></iframe>',
			'class' => 'block',
			'allow_in' => Array('listitem', 'block', 'columns'),
		);
		
		$BBCode->AddRule('video', $youtube );
		$BBCode->AddRule('youtube', $youtube );
	}
}
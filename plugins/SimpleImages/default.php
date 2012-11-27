<?php if (!defined('APPLICATION')) die();

$PluginInfo['SimpleImages'] = array(
    'Description' => 'Dynamically resize <img/> tags to fit browser width, with lightbox for desktop browsers',
    'Version' => '1.0.5',
    'Author' => 'Peter Hughes',
    'AuthorEmail' => 'peterhughes.dev@gmail.com',
    'AuthorUrl' => 'http://www.peterhughesdev.com',
	'MobileFriendly' => TRUE
);

class SimpleImagesPlugin extends Gdn_Plugin {
  public function Base_Render_Before($Sender) {
	if( !IsMobile() ) {
		$Sender->AddJsFile('jquery.colorbox-min.js', 'plugins/SimpleImages' );
		$Sender->AddJsFile('SimpleImagesFull.js', 'plugins/SimpleImages' );
		
		$Sender->AddCssFile('colorbox.css', 'plugins/SimpleImages' );
	} else {
		$Sender->AddJsFile('SimpleImagesMobile.js', 'plugins/SimpleImages' );
	}
	
    $Sender->AddCssFile('SimpleImages.css', 'plugins/SimpleImages' );
  }

  public function Setup() {
    // Intentionally left blank
  }
}  

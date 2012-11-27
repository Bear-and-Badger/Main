<?php if (!defined('APPLICATION')) die();

$PluginInfo['ImageResizer'] = array(
    'Description' => 'Dynamically resize <img/> tags to fit browser width',
    'Version' => '2.0.1',
    'Author' => 'Eric Gillingham',
    'AuthorEmail' => 'Gillingham@bikezen.net',
    'AuthorUrl' => 'http://bikezen.net'
);

class imageResizerPlugin extends Gdn_Plugin
{
  public function Base_Render_Before(&$Sender)
  {
    $Sender->AddJsFile($this->GetResource('ImageResizer.js', FALSE, FALSE));
    $Sender->AddCssFile($this->GetResource('ImageResizer.css', FALSE, FALSE));
  }

  public function Setup()
  {
    // Intentionally left blank
  }
}  

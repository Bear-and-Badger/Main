<?php if (!defined('APPLICATION'))  exit();


// Define the plugin:
$PluginInfo['PageNavigator'] = array(
    'Name' => 'PageNavigator',
    'Description' => 'This plugin adds First and Last Links to the discussions page and top and bottom links to comments on each discussion page.',
    'Version' => '1.3',
    'RequiredApplications' => FALSE,
    'RequiredTheme' => FALSE,
    'RequiredPlugins' => FALSE,
    'SettingsUrl' => '/dashboard/plugin/pagenavigator',
    'SettingsPermission' => 'Garden.Settings.Manage',
    'RegisterPermissions' => array('Plugins.PageNavigator.Manage'),
    'Author' => "Peregrine"
);

class PageNavigatorPlugin extends Gdn_Plugin {

    public function DiscussionsController_Render_Before($Sender) {
       if ((C('Plugins.PageNavigator.Show_First')) || (C('Plugins.PageNavigator.Show_Last')) ){
        $Formatter = C('Garden.InputFormatter', 'Html');
        $this->AttachPageNavigatorResources($Sender, $Formatter);
        }
    }

    public function DiscussionController_Render_Before($Sender) {
         if (  (C('Plugins.PageNavigator.Show_Top')) || (C('Plugins.PageNavigator.Show_Bottom')) ) {
        $Formatter = C('Garden.InputFormatter', 'Html');
        $this->AttachPageNavigatorResources($Sender, $Formatter);
        }
    }

    public function PluginController_PageNavigator_Create(&$Sender, $Args = array()) {

        $Sender->Permission('Garden.Settings.Manage');
        $Sender->Form = new Gdn_Form();
        $Validation = new Gdn_Validation();
        $ConfigurationModel = new Gdn_ConfigurationModel($Validation);
        $ConfigurationModel->SetField(array(
            'Plugins.PageNavigator.Show_First',
            'Plugins.PageNavigator.Show_Last',
            'Plugins.PageNavigator.Show_Top',
            'Plugins.PageNavigator.Show_Bottom'
        
        ));
        $Sender->Form->SetModel($ConfigurationModel);


        if ($Sender->Form->AuthenticatedPostBack() === FALSE) {
            $Sender->Form->SetData($ConfigurationModel->Data);
        } else {
            $Data = $Sender->Form->FormValues();

            if ($Sender->Form->Save() !== FALSE)
                $Sender->StatusMessage = T("Your settings have been saved.");
        }

        $Sender->Render($this->GetView('pn-settings.php'));
    }

    public function DiscussionsController_BeforeDiscussionMeta_Handler($Sender) {
      if ((C('Plugins.PageNavigator.Show_First')) || (C('Plugins.PageNavigator.Show_Last'))) {
        $Object = ($Sender->EventArguments['Discussion']);

        $did = $Object->DiscussionID;
        $lid = $Object->LastCommentID;
         $dtitle = $Object->Name;
       
        if($lid > 1) {
       if (C('Plugins.PageNavigator.Show_First')) {
       echo sprintf(' <a class="pagenavigator" href="/vanilla/index.php?p=/discussion/'  . $did . '/x/p1' . '">First page</a>');
      //    echo sprintf(' <a class="pagenavigator" href="/vanilla/index.php?p=/discussion/'  . $did . '/p1' . '">First</a>');
        
          }
         if (C('Plugins.PageNavigator.Show_Last')) {
           echo sprintf(' <a class="pagenavigator"  href="/vanilla/index.php?p=/discussion/comment/' . $lid . '#Comment_' . $lid . '">Last page</a>');
          }
    }
  }
}
    
    
    public function DiscussionController_BeforeCommentMeta_Handler($Sender) {
     if ((C('Plugins.PageNavigator.Show_Top')) ||  (C('Plugins.PageNavigator.Show_Bottom')) ){
        $Object = ($Sender->EventArguments['Discussion']);
        $did = $Object->DiscussionID;
        $x = 0;
        foreach ($Sender->CommentData as $cdata) {
            if (!$did) {
                $did = $cdata->DiscussionID;
            }
            $CommmentIdArray[$x++] = ($cdata->CommentID);
        }

        $topcom = $CommmentIdArray[0];
        $botcom = $CommmentIdArray[$x - 1];

    
        if ($topcom != $botcom) {
           if (C('Plugins.PageNavigator.Show_Top')) {
           // echo sprintf(' <a class="pagenavigator" href="/vanilla/index.php?p=/discussion/comment/' . $topcom . '#Comment_' . $topcom . '">Top</a>');
          
            echo sprintf(' <a class="pagenavigator pntop" >Top</a>');
           }
            if (C('Plugins.PageNavigator.Show_Bottom')) {
           // echo sprintf(' <a class="pagenavigator" href="/vanilla/index.php?p=/discussion/comment/' . $botcom . '#Comment_' . $botcom . '">Bottom</a>');
          
            echo sprintf(' <a class="pagenavigator pnbottom" >Bottom</a>');
            
            }
        }
     }
    }

   public function CategoriesController_BeforeCommentMeta_Handler(&$Sender) {
        $this->DiscussionController_BeforeCommentMeta_Handler($Sender);
    }

    public function CategoriesController_BeforeDiscussionMeta_Handler(&$Sender) {
       $this->DiscussionsController_BeforeDiscussionMeta_Handler($Sender);
    }
  
   public function CategoriesController_Render_Before(&$Sender) {
             $this->DiscussionsController_Render_Before($Sender);
    }
  
    protected function AttachPageNavigatorResources($Sender, $Formatter) {
       // $Sender->AddCssFile('pagenavigator.css', 'plugins/PageNavigator');
       // $Sender->AddJsFile('/plugins/PageNavigator/js/pnav.js');
    }

    public function Setup() {
        
    }

    public function OnDisable() {
     //  RemoveFromConfig('Plugins.PageNavigator.Show_First');
     //  RemoveFromConfig('Plugins.PageNavigator.Show_Last');
    //  RemoveFromConfig('Plugins.PageNavigator.Show_Top');
    //  RemoveFromConfig('Plugins.PageNavigator.Show_Bottom');
    }

}


<?php if (!defined('APPLICATION')) exit();

// Define the plugin:
$PluginInfo['SimpleIgnore'] = array(
    'Name' => 'SimpleIgnore',
    'Description' => 'This plugin allows each user to create a customized list of individuals to ignore.  Comments for individuals that are ignored will be hidden (ignored) only to the user that ignored them. Settings for each user are provided on their profile page.',
    'Version' => '0.1',
    'Author' => "Petey"
);
class IgnoreUser implements Gdn_IPlugin {

    public function ProfileController_AfterAddSideMenu_Handler($Sender) {
        $SideMenu = $Sender->EventArguments['SideMenu'];
        $Session = Gdn::Session();
        $VUserID = $Session->UserID;
        $SenderID = $Sender->User->UserID;  

        if ($Sender->User->UserID == $VUserID) {
            $SideMenu->AddLink('Options', T('IgnoredTab'), '/profile/ignoreedit/' . $Sender->User->UserID . '/' . Gdn_Format::Url($Sender->User->Name), FALSE, array('class' => 'Popup'));    
        }
    }

    public function ProfileController_IgnoreEdit_Create($Sender) {
        $Session = Gdn::Session();
        $IgnoreUserID = $Session->UserID;

        $IgnoreUserModel = new Gdn_Model('SimpleIgnore');
        $IgnoreUserData = $IgnoreUserModel->GetWhere(array('UserID' => $IgnoreUserID));
        $IgnoreUser = $IgnoreUserData->FirstRow();

        $igfound = "y";
        if (empty($IgnoreUser)) {
            $igfound = "n";
        }
        $Sender->IgnoreUser = $IgnoreUser;
        $IgnoreUserList = $Sender->IgnoreUser->IgnoreUserList;
        $Sender->Form = new Gdn_Form();
        $Sender->Form->SetModel($IgnoreUserModel, $IgnoreUser);

        // If seeing the form for the first time...FALSE
        if ($Sender->Form->AuthenticatedPostBack() === FALSE) {

            // Apply settings to the form.
            $Sender->Form->SetData($Sender->IgnoreUser);
        } else {
            // add record if none existed for userid
            if ($igfound == "n") {
                $this->AddIgUser($IgnoreUserID);
            }
 
             $IgnoreUserList = $Sender->Form->GetFormValue('IgnoreUserList', $IgnoreUserList);
            $IgnoreUserList  =  $this->clean_list($IgnoreUserList);
            $Sender->Form->SetFormValue('UserID', $IgnoreUserID);
            $Saved = $Sender->Form->Save();
         
            if ($Saved) {
                $Sender->InformMessage(T("SaveMessage"));
           
            }
            // delete record if blank 
           if (!preg_match("/[A-za-z0-9]/", $IgnoreUserList)) {
              $this->DelIgUser($IgnoreUserID);
            }
        }
        $Sender->View = dirname(__FILE__) . DS . 'views' . DS . 'simpleignore_edit.php';
        $Sender->Render();
    }

    // cleanup anything not a number letter or _ is removed from userlist
    public function clean_list($igline) {
        $search = array('/[^A-Za-z_0-9 ]/', '/\s+/');
        $replace = array('', ' ');
        return trim(preg_replace($search, $replace, $igline));
    }

    public static function AddIgUser($IgnoreUserID) {
        $SQL = Gdn::SQL();
        $SQL->Insert('SimpleIgnore', array('UserID' => $IgnoreUserID));
    }

    public static function DelIgUser($IgnoreUserID) {
        $SQL = Gdn::SQL();
        $SQL->Delete('SimpleIgnore', array('UserID' => $IgnoreUserID));
    }

    public function Structure() {
        $Structure = Gdn::Structure();
        $Structure
                ->Table('SimpleIgnore')
                ->Column('UserID', 'int', FALSE, 'primary')
                ->Column('IgnoreUserList', 'varchar(255)', TRUE)
                ->Set(FALSE, FALSE);
    }

   public function DiscussionController_Render_Before($Sender) {
       $Formatter = C('Garden.InputFormatter', 'Html');
        $this->AttachSimpleIgnoreResources($Sender, $Formatter);
        $Session = Gdn::Session();
        $IgnoreUserID = $Session->UserID;
        $IgnoreUserModel = new Gdn_Model('SimpleIgnore');
        $IgnoreUserData = $IgnoreUserModel->GetWhere(array('UserID' => $IgnoreUserID));
        $FirstRow = $IgnoreUserData->FirstRow();
        $IgnoreUserList = $FirstRow->IgnoreUserList;
        $this->CacheIg(explode(' ',$IgnoreUserList ));
       
       }
 
    public function DiscussionController_AfterAuthorMeta_Handler($Sender) {
       if ($Sender->EventArguments['Ignored']) {
            echo '<span class="ignore-user">(ignored)</span>';
        }
    }
   
    public function DiscussionController_CommentOptions_Handler($Sender, $Args) {
        if ($Sender->EventArguments['Ignored']) {
            echo '<span class="ignore-button">';
            echo '<button>Show</button>';
            echo '</span>';
        }
    }
   
   
     public function DiscussionController_BeforeCommentDisplay_Handler($Sender) {
        $CssItem = $Sender->EventArguments['CssClass']; 
        $commenter = $Sender->EventArguments['Object']->InsertName;
        $IgnoreArray = $this->GetCacheIg();
        $ignoreEdit = array_search($commenter, $IgnoreArray);

        if (($ignoreEdit === 0 ) || ($ignoreEdit > 0 )) {
             $CssItem = str_replace("Item", "Item Ignored", $CssItem);
             $Sender->EventArguments['CssClass'] = $CssItem;
             $Sender->EventArguments['Ignored'] = true;
         } else {
            $Sender->EventArguments['Ignored'] = false;
         }
   }
    
  
   protected function AttachSimpleIgnoreResources($Sender) {
        $Sender->AddJsFile('/plugins/SimpleIgnore/js/simple-ignore.js');
        $Sender->AddCssFile('simple-ignore.css', 'plugins/SimpleIgnore');  
    }
  
 
  
    public function CacheIg($IgnoreArray) {
        $this->IgnoreArray = $IgnoreArray;
    }

    public function GetCacheIg() {
        return $this->IgnoreArray;
    }
 
  public function CategoriesController_BeforeCommentMeta_Handler($Sender) {
        $this->DiscussionController_BeforeCommentMeta_Handler($Sender);
    }  

 public function CategoriesController_BeforeCommentDisplay_Handler($Sender) {
        $this->DiscussionController_BeforeCommentDisplay_Handler($Sender);
    }  

    public function Setup() {
        $this->Structure();
    }

}


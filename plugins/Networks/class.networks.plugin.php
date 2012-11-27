<?php if (!defined('APPLICATION')) exit();
/*
Copyright 2008, 2009 Vanilla Forums Inc.
This file is part of Garden.
Garden is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
Garden is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with Garden.  If not, see <http://www.gnu.org/licenses/>.
Contact Vanilla Forums Inc. at support [at] vanillaforums [dot] com
*/

// Define the plugin:
$PluginInfo['Networks'] = array(
   'Name' => 'Networks',
   'Description' => 'This plugin allows users to attach their user IDs from various networks to their profiles.',
   'Version' => '0.1',
   'MobileFriendly' => TRUE,
   'RequiredApplications' => FALSE,
   'RequiredTheme' => FALSE, 
   'RequiredPlugins' => FALSE,
   'Author' => "Peter Hughes",
   'AuthorEmail' => 'peterhughes.dev@gmail.com',
   'AuthorUrl' => 'http://www.peterhughesdev.com'
);

class NetworksPlugin extends Gdn_Plugin {
	public static $networks = array( "Facebook", "Twitter", "Xbox", "PSN", "Steam", "Wii" );


   public function ProfileController_AfterAddSideMenu_Handler($Sender) {      
      $SideMenu = $Sender->EventArguments['SideMenu'];
      $Session = Gdn::Session();
      $ViewingUserID = $Session->UserID;
      
      if ($Sender->User->UserID == $ViewingUserID) {
         $SideMenu->AddLink('Options', T('My Networks'), '/profile/networks', FALSE, array('class' => 'Popup'));
      } else {
         $SideMenu->AddLink('Options', T('Edit Networks'), '/profile/networks/'.$Sender->User->UserID.'/'.Gdn_Format::Url($Sender->User->Name), 'Garden.Users.Edit', array('class' => 'Popup'));
      }
   }
   
   public function ProfileController_Networks_Create($Sender) {
      $Args = $Sender->RequestArgs;
      if (sizeof($Args) < 2)
         $Args = array_merge($Args, array(0,0));
      elseif (sizeof($Args) > 2)
         $Args = array_slice($Args, 0, 2);
      
      list($UserReference, $Username) = $Args;
      $Sender->Permission('Garden.SignIn.Allow');
      $Sender->GetUserInfo($UserReference, $Username);
      $UserPrefs = Gdn_Format::Unserialize($Sender->User->Preferences);
      if (!is_array($UserPrefs))
         $UserPrefs = array();
      
      $Validation = new Gdn_Validation();
      $ConfigurationModel = new Gdn_ConfigurationModel($Validation);
      $ConfigArray = array();
	  foreach( self::$networks as $key ) {
		 $ConfigArray[ 'Plugin.Networks.'.$key ] = NULL;
      }
	
      $SigUserID = $ViewingUserID = Gdn::Session()->UserID;
      
      if ($Sender->User->UserID != $ViewingUserID) {
         $Sender->Permission('Garden.Users.Edit');
         $SigUserID = $Sender->User->UserID;
      }
      
      $Sender->SetData('Plugin-Networks-ForceEditing', ($SigUserID == Gdn::Session()->UserID) ? FALSE : $Sender->User->Name);
      
      $UserMeta = $this->GetUserMeta($SigUserID, '%');
    
      if ($Sender->Form->AuthenticatedPostBack() === FALSE && is_array($UserMeta))
         $ConfigArray = array_merge($ConfigArray, $UserMeta);
      
      $ConfigurationModel->SetField($ConfigArray);
      
      // Set the model on the form.
      $Sender->Form->SetModel($ConfigurationModel);
      
      // If seeing the form for the first time...
      if ($Sender->Form->AuthenticatedPostBack() === FALSE) {
         // Apply the config settings to the form.
         $Sender->Form->SetData($ConfigurationModel->Data);
      } else {
         $Values = $Sender->Form->FormValues();
         $FrmValues = array_intersect_key($Values, $ConfigArray);
		 
         if (sizeof($FrmValues)) {
            foreach ($FrmValues as $UserMetaKey => $UserMetaValue) {
               $this->SetUserMeta($SigUserID, $this->TrimMetaKey($UserMetaKey), $UserMetaValue);
            }
         }
         
         $Sender->StatusMessage = T("Your changes have been saved.");
      }

      $Sender->Render($this->GetView('networks.php'));
   }
   
   public function DiscussionController_BeforeDiscussionRender_Handler(&$Sender) {
      $this->CacheNetworks($Sender);
   }
   
   public function PostController_BeforeCommentRender_Handler(&$Sender) {
      $this->CacheNetworks($Sender);
   }
   
   protected function CacheNetworks(&$Sender) {
      $Discussion = $Sender->Data('Discussion');
      $Comments = $Sender->Data('CommentData');
      $UserIDList = array();
      
      if ($Discussion)
         $UserIDList[$Discussion->InsertUserID] = 1;
         
      if ($Comments && $Comments->NumRows()) {
         $Comments->DataSeek(-1);
         while ($Comment = $Comments->NextRow())
            $UserIDList[$Comment->InsertUserID] = 1;
      }
      
      $UserNetworks = array();
      if( sizeof($UserIDList) ) {
		 $networks = $this->GetUserMeta(array_keys($UserIDList), '%');
		 foreach( $networks as $UserID => $UserNetwork)
			$UserNetworks[$UserID] = $UserNetwork;
      }
      $Sender->SetData('Plugin-Networks-UserNetworks', $UserNetworks);
   }
   
   public function DiscussionController_Render_Before(&$Sender) {
      $this->PrepareController($Sender);
   }
   
   public function PostController_Render_Before(&$Sender) {
      $this->PrepareController($Sender);
   }
   
   protected function PrepareController(&$Controller) {
      $Controller->AddCssFile($this->GetResource('design/networks.css', FALSE, FALSE));

	  $Controller->Head->addString( $Controller->FetchView('networksscript','','plugins/Networks') );
   }
   
   public function GetUserSignature($UserID, $Default = NULL) {
      $UserSig = $this->GetUserMeta($UserID, 'Sig');
         
      return (is_array($UserSig)) ? $UserSig['Value'] : $Default;
   }
   
   public function DiscussionController_CommentInfo_Handler(&$Sender) {
		if( !isMobile() ) {
      $this->_DrawNetworks($Sender);
	}
   }
   
   public function PostController_CommentInfo_Handler(&$Sender) {
		if( !isMobile() ) {
      $this->_DrawNetworks($Sender);
	}
   }
   
   public function DiscussionController_AfterCommentBody_Handler(&$Sender) {
	if( isMobile() ) {
      $this->_DrawNetworks($Sender);
	}
   }
   
   public function PostController_AfterCommentBody_Handler(&$Sender) {
      if( isMobile() ) {
      $this->_DrawNetworks($Sender);
	}
   }
   
   protected function _DrawNetworks(&$Sender) {
      if ($this->_HideAllSignatures($Sender)) return;
      
      if (isset($Sender->EventArguments['Discussion'])) 
         $Data = $Sender->EventArguments['Discussion'];
         
      if (isset($Sender->EventArguments['Comment'])) 
         $Data = $Sender->EventArguments['Comment'];
      
      $SourceUserID = $Data->InsertUserID;
	 $UserNetworks =& $Sender->Data('Plugin-Networks-UserNetworks');
	 if (isset($UserNetworks[$SourceUserID])) {
			
		 $UserNetwork = $UserNetworks[$SourceUserID];
		 $UserNetworkDisplay = array();
		 foreach( self::$networks as $key ) {
			$metakey = $this->MakeMetaKey($key);
			if( isset( $UserNetwork[ $metakey ] ) && $UserNetwork[ $metakey ] != "" ) {
				$UserNetworkDisplay[ $key ] = $this->_FormatNetwork( $key, $UserNetwork[ $metakey ] );
			}
		 }
		 
		 $Sender->UserNetworks = $UserNetworkDisplay;
		 $Display = $Sender->FetchView($this->GetView('usernetworks.php'));
		 unset($Sender->UserNetworks);
		 echo $Display;
	  }
   }
   
   protected function _FormatNetwork( $key, $value ) {
		$value = Gdn_Format::Text( $value );
		$link = null;
		
		if( $value != "" ) {
			switch( strtolower($key) ) {
				case "facebook" :
					$link = "http://www.facebook.com/";
					break;
				case "twitter" : 
					$link = "https://twitter.com/#!/";
					break;
				case "xbox" :
					$link = "http://live.xbox.com/en-US/Profile?gamertag=";
					break;
				case "psn" :
					$link = "http://us.playstation.com/publictrophy/index.htm?onlinename=";
					break;
			}
			
			if( $link ) {
				return '<a href="'.$link.$value.'" target="_blank" title="View profile">'.$value.'</a>';
			} else {
				return $value;
			}
		}
		
		return null;
   }
   
   protected function _HideAllSignatures(&$Sender) {
      
      if (!$Sender->Data('Plugin-Networks-ViewingUserData')) {
         // TIM: RC3 now, using built in UserMeta methods
         //
         $UserSig = $this->GetUserMeta(Gdn::Session()->UserID, '%');
         
         // TIM: Leaving this here until RC3+ UserMeta stuff is proven
         //$UserSig = $this->_GetUserSignatureData();
         //
         
         $Sender->SetData('Plugin-Networks-ViewingUserData',$UserSig);
      }
      
      $HideSigs = ArrayValue('Plugin.Networks.HideAll', $Sender->Data('Plugin-Networks-ViewingUserData'), FALSE);
      if ($HideSigs == "TRUE") return TRUE;
      return FALSE;
   }

   public function Setup() {
      // Nothing to do here!
   }
   
   public function Structure() {
      // Nothing to do here!
   }
         
}
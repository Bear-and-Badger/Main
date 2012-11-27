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
$PluginInfo['SimpleSpoilers'] = array(
   'Name' => 'SimpleSpoilers',
   'Description' => "This plugin adds simple javascript to native spoiler functionality.",
   'Version' => '0.1.1',
   'MobileFriendly' => TRUE,
   'RequiredApplications' => array('Vanilla' => '2.0.18'),
   'RequiredTheme' => FALSE, 
   'RequiredPlugins' => FALSE,
   'Author' => "Peter Hughes",
   'AuthorEmail' => 'peterhughes.dev@gmail.com',
   'AuthorUrl' => 'http://www.peterhughesdev.co.uk'
);


class SimpleSpoilersPlugin extends Gdn_Plugin {
	public function Base_Render_Before( $Sender ) {
		 $Sender->AddJsFile( 'simplespoilers.js', 'plugins/SimpleSpoilers' );
	}     
}
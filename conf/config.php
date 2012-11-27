<?php if (!defined('APPLICATION')) exit();

// AddonManager
$Configuration['AddonManager']['FileUrl'] = 'http://static-cl1.vanilladev.com/www.vanillaforums.org/uploads/N7I6DGSY8DYS.zip';
$Configuration['AddonManager']['FileTyp'] = '0';

// Conversations
$Configuration['Conversations']['Version'] = '2.0.18.4';

// Database
$Configuration['Database']['Name'] = '';
$Configuration['Database']['Host'] = '';
$Configuration['Database']['User'] = '';
$Configuration['Database']['Password'] = '';

// EnabledApplications
$Configuration['EnabledApplications']['Conversations'] = 'conversations';
$Configuration['EnabledApplications']['Vanilla'] = 'vanilla';

// EnabledPlugins
$Configuration['EnabledPlugins']['HtmLawed'] = 'HtmLawed';
$Configuration['EnabledPlugins']['NBBC'] = TRUE;
$Configuration['EnabledPlugins']['Pockets'] = TRUE;
$Configuration['EnabledPlugins']['Quotes'] = TRUE;
$Configuration['EnabledPlugins']['SCEditor'] = TRUE;
$Configuration['EnabledPlugins']['Signatures'] = TRUE;
$Configuration['EnabledPlugins']['WhosOnline'] = TRUE;
$Configuration['EnabledPlugins']['VanillaStats'] = TRUE;
$Configuration['EnabledPlugins']['TrollManagement'] = TRUE;
$Configuration['EnabledPlugins']['SimpleImages'] = TRUE;
$Configuration['EnabledPlugins']['SimpleSpoilers'] = TRUE;
$Configuration['EnabledPlugins']['SimpleVideo'] = TRUE;
$Configuration['EnabledPlugins']['Flagging'] = TRUE;
$Configuration['EnabledPlugins']['BrowseMember'] = TRUE;
$Configuration['EnabledPlugins']['AllViewed'] = TRUE;
$Configuration['EnabledPlugins']['ButtonBar'] = TRUE;
$Configuration['EnabledPlugins']['Networks'] = TRUE;

// Garden
$Configuration['Garden']['Title'] = 'The Bear and Badger - a better class of conversation.';
$Configuration['Garden']['Cookie']['Salt'] = 'GIUEGCKVAZ';
$Configuration['Garden']['Cookie']['Domain'] = '';
$Configuration['Garden']['Registration']['ConfirmEmail'] = FALSE;
$Configuration['Garden']['Registration']['Method'] = 'Captcha';
$Configuration['Garden']['Registration']['ConfirmEmailRole'] = '3';
$Configuration['Garden']['Registration']['CaptchaPrivateKey'] = '6Les59ASAAAAAAr1wkhQDUkJ7j-kDMBlFRxHJMqL';
$Configuration['Garden']['Registration']['CaptchaPublicKey'] = '6Les59ASAAAAADRuww-3HG4nkRYw8mkPsOADcyL3';
$Configuration['Garden']['Registration']['InviteExpiration'] = '-1 week';
$Configuration['Garden']['Registration']['InviteRoles'] = 'a:5:{i:3;s:1:"0";i:4;s:1:"0";i:8;s:1:"0";i:16;s:1:"0";i:32;s:1:"0";}';
$Configuration['Garden']['Email']['SupportName'] = 'The Bear and Badger';
$Configuration['Garden']['Version'] = '2.0.18.4';
$Configuration['Garden']['RewriteUrls'] = TRUE;
$Configuration['Garden']['CanProcessImages'] = TRUE;
$Configuration['Garden']['Installed'] = TRUE;
$Configuration['Garden']['InstallationID'] = 'A469-B444B049-4DB516AC';
$Configuration['Garden']['InstallationSecret'] = '3ab0906f598ae1154dbc76de7d91d5d9cbc7da28';
$Configuration['Garden']['Logo'] = 'B2D3S02FB76H.jpg';
$Configuration['Garden']['Theme'] = 'bears';
$Configuration['Garden']['Messages']['Cache'] = 'a:1:{i:0;s:6:"[Base]";}';
$Configuration['Garden']['EditContentTimeout'] = '-1';
$Configuration['Garden']['Thumbnail']['Size'] = 100;
$Configuration['Garden']['Format']['EmbedSize'] = 'small';
$Configuration['Garden']['InputFormatter'] = 'BBCode';

// Plugins
$Configuration['Plugins']['GettingStarted']['Dashboard'] = '1';
$Configuration['Plugins']['GettingStarted']['Registration'] = '1';
$Configuration['Plugins']['GettingStarted']['Categories'] = '1';
$Configuration['Plugins']['GettingStarted']['Plugins'] = '1';
$Configuration['Plugins']['GettingStarted']['Discussion'] = '1';
$Configuration['Plugins']['GettingStarted']['Profile'] = '1';
$Configuration['Plugins']['Signatures']['Enabled'] = TRUE;
$Configuration['Plugins']['PageNavigator']['Show_First'] = FALSE;
$Configuration['Plugins']['PageNavigator']['Show_Last'] = FALSE;
$Configuration['Plugins']['PageNavigator']['Show_Top'] = FALSE;
$Configuration['Plugins']['PageNavigator']['Show_Bottom'] = FALSE;
$Configuration['Plugins']['TrollManagement']['Cache'] = 'a:1:{i:0;s:1:"2";}';

// Routes
$Configuration['Routes']['DefaultController'] = 'a:2:{i:0;s:14:"categories/all";i:1;s:8:"Internal";}';
$Configuration['Routes']['DefaultForumRoot'] = 'a:2:{i:0;s:11:"discussions";i:1;s:8:"Internal";}';

// Vanilla
$Configuration['Vanilla']['Version'] = '2.0.18.4';
$Configuration['Vanilla']['Discussions']['PerPage'] = '30';
$Configuration['Vanilla']['Comments']['AutoRefresh'] = '0';
$Configuration['Vanilla']['Comments']['PerPage'] = '30';
$Configuration['Vanilla']['Archive']['Date'] = '';
$Configuration['Vanilla']['Archive']['Exclude'] = FALSE;
$Configuration['Vanilla']['Discussion']['SpamCount'] = '3';
$Configuration['Vanilla']['Discussion']['SpamTime'] = '60';
$Configuration['Vanilla']['Discussion']['SpamLock'] = '120';
$Configuration['Vanilla']['Comment']['SpamCount'] = '15';
$Configuration['Vanilla']['Comment']['SpamTime'] = '60';
$Configuration['Vanilla']['Comment']['SpamLock'] = '120';
$Configuration['Vanilla']['Comment']['MaxLength'] = '55000';
$Configuration['Vanilla']['AdminCheckboxes']['Use'] = FALSE;
$Configuration['Vanilla']['Modules']['ShowBookmarkedModule'] = TRUE;

// WhosOnline
$Configuration['WhosOnline']['Frequency'] = '30';
$Configuration['WhosOnline']['Location']['Show'] = 'every';
$Configuration['WhosOnline']['Hide'] = FALSE;

// Last edited by Petey (86.23.108.220)2012-05-16 17:48:15
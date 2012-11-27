<?php if (!defined('APPLICATION')) exit(); ?>
<h1><?php echo T($this->Data['Title']); ?></h1>
<div class="Info">
   <?php echo T("Signatures are HTML-capable custom taglines that appear at the bottom of a user's comments. If enabled, users can customize their signatures and signature-related preferences from their profile. Options include: disabling html in other user signatures, and disabling other user signatures altogether."); ?>
</div>
<div class="FilterMenu">
      <?php
      echo Anchor(
         T(C('Plugins.Signatures.Enabled') ? 'Disable Signatures' : 'Enable Signatures'),
         'settings/togglesignatures/'.Gdn::Session()->TransientKey(),
         'SmallButton'
      );
   ?>
</div>
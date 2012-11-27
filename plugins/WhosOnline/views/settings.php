<?php if (!defined('APPLICATION')) exit(); ?>
<h2><?php echo T('Who\'s Online Settings'); ?></h2>
<?php
echo $this->Form->Open();
echo $this->Form->Errors();
?>
<ul>
   <li>
      <?php
         echo $this->Form->Label('Settings');
         echo $this->Form->CheckBox('Plugin.WhosOnline.Invisible','Make me invisible? (Will not show you on the list)');
      ?>
   </li>

</ul>
<?php echo $this->Form->Close('Save');
<?php if (!defined('APPLICATION')) exit(); ?>
<h2><?php echo T('Signature Settings'); ?></h2>
<?php
echo $this->Form->Open();
echo $this->Form->Errors();
?>
<ul>
   <?php
      if (isset($this->Data['Plugin-Signatures-ForceEditing']) && $this->Data['Plugin-Signatures-ForceEditing'] != FALSE) {
   ?>
         <div class="Warning"><?php echo sprintf(T("You are editing %s's signature"),$this->Data['Plugin-Signatures-ForceEditing']); ?></div>
   <?php
      }
   ?>
   <li>
      <?php
         echo $this->Form->Label('Settings');
         echo $this->Form->CheckBox('Plugin.Signatures.HideAll','Hide signatures?');
         echo $this->Form->CheckBox('Plugin.Signatures.HideImages','Strip images out of signatures?');
      ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Signature Code', 'Plugin.Signatures.Sig');
         echo $this->Form->TextBox('Plugin.Signatures.Sig', array('MultiLine' => TRUE));
      ?>
   </li>
   <?php
      $this->FireEvent('EditMySignatureAfter');
   ?>
</ul>
<?php echo $this->Form->Close('Save');
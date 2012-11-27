<?php if (!defined('APPLICATION')) exit(); ?>
<h2><?php echo T('Network Links'); ?></h2>
<p>Enter in your unique IDs for each network. If you leave it blank, it will not be displayed to other members.</p>
<?php
echo $this->Form->Open();
echo $this->Form->Errors();
?>
<ul style="padding: 10px;">
   <?php
      if (isset($this->Data['Plugin-Networks-ForceEditing']) && $this->Data['Plugin-Networks-ForceEditing'] != FALSE) {
   ?>
         <div class="Warning"><?php echo sprintf(T("You are editing %s's Gaming networks"),$this->Data['Plugin-Networks-ForceEditing']); ?></div>
   <?php
      }
   ?>
   <li>
      <?php
         echo $this->Form->Label('Facebook', 'Plugin.Networks.Facebook');
         echo $this->Form->TextBox('Plugin.Networks.Facebook', array('MultiLine' => FALSE));
      ?>
   </li>
   
   <li>
      <?php
         echo $this->Form->Label('Twitter', 'Plugin.Networks.Twitter');
         echo $this->Form->TextBox('Plugin.Networks.Twitter', array('MultiLine' => FALSE));
      ?>
   </li>
   
   <li>
      <?php
         echo $this->Form->Label('Xbox Live', 'Plugin.Networks.Xbox');
         echo $this->Form->TextBox('Plugin.Networks.Xbox', array('MultiLine' => FALSE));
      ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('PSN', 'Plugin.Networks.PSN');
         echo $this->Form->TextBox('Plugin.Networks.PSN', array('MultiLine' => FALSE));
      ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Steam', 'Plugin.Networks.Steam');
         echo $this->Form->TextBox('Plugin.Networks.Steam', array('MultiLine' => FALSE));
      ?>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Wii', 'Plugin.Networks.Wii');
         echo $this->Form->TextBox('Plugin.Networks.Wii', array('MultiLine' => FALSE));
      ?>
   </li>
   <?php
      $this->FireEvent('EditNetworksAfter');
   ?>
   <?php echo $this->Form->Close('Save'); ?>
</ul>

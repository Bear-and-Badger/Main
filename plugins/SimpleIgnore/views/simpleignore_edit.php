<?php if (!defined('APPLICATION')) exit(); ?>
<?php
// Initialize the Form
echo $this->Form->Open();
echo $this->Form->Errors();

?>
<h2><?php echo T('IgnoredHeading'); ?></h2>
<ul>
	 <li>
      <?php
         echo $this->Form->Label(T('IgnoredDirections'), 'IgnoreUserList');
         echo $this->Form->TextBox(T('IgnoreUserList'));
      ?>
   </li>
 </ul>
	<?php
// Close the form
				echo $this->Form->Close(T('IgnoreButton')); 



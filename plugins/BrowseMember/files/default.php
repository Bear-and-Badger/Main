<?php if (!defined('APPLICATION')) exit();
$Session = Gdn::Session();
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
   // Make paging function in the user table
   $('.MorePager').morepager({
      pageContainerSelector: '#Users',
      pagerInContainer: true
   });   
});
</script>
<?php
echo $this->Form->Open(array('action' => Url('/plugin/BrowseMember')));
?>
<h1><?php echo T('Browse Members'); ?></h1>
<div class="Info">
   <?php
      echo $this->Form->Errors();
      //echo '<div>', T('Search Users.', 'User Search Field'), '</div>';
      echo '<p>';
      echo $this->Form->TextBox('Keywords');
      echo $this->Form->Button(T('Search'));
      printf(T('%s user(s) found.'), $this->Pager->TotalRecords);
      echo '</p>';
	  echo '<p> <a href="'.Url('plugin/BrowseMember').'"><span class="Count">Reset</span></a> ';
	  $letters = range('a', 'z');
	foreach ($letters as $letter) {
		echo "<a href='".Url('plugin/BrowseMember/0')."/".$letter."'>".$letter."</a> ";
	}
	echo '</p>';
   ?>
</div>
      <?php
		echo $this->Pager->ToString('less');
		$Alt = FALSE;		
		include( PATH_PLUGINS . DS . 'BrowseMember' . DS . 'files' . DS.'users.php');
		echo $this->Pager->ToString('more');
      ?>
<?php
echo $this->Form->Close();
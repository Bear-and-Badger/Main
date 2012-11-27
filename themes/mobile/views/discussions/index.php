<?php if (!defined('APPLICATION')) exit();
$Session = Gdn::Session();
include($this->FetchViewLocation('helper_functions', 'discussions', 'vanilla'));

WriteFilterTabs($this);
if ($this->DiscussionData->NumRows() > 0 || (isset($this->AnnounceData) && is_object($this->AnnounceData) && $this->AnnounceData->NumRows() > 0)) {
?>

<?php
$CatModel = new CategoryModel();
$Categories = $CatModel->GetFull()->Result();
$CategoryID = isset($this->_Sender->CategoryID) ? $this->_Sender->CategoryID : '';
?>
<ul class="DataList Discussions" style="padding: 10px 0; margin: 10px 0; border-bottom: 1px solid #ccc;" >
<li>
Select category: <select class="cat-select">
<option value="all">All</option>
<?php
   $MaxDepth = C('Vanilla.Categories.MaxDisplayDepth');
     
   foreach ( $Categories as $Category) {
      if ($Category->CategoryID < 0 || $MaxDepth > 0 && $Category->Depth > $MaxDepth)
         continue;

     $selected = ($CategoryID == $Category->CategoryID ? 'selected="selected"' : '');
      
      echo '<option value="'.rawurlencode($Category->UrlCode).'" '.$selected.'>';
	  echo $Category->Name;
	  echo "</option>\n";
   }
?>
</select>
</li>
</ul>
<ul class="DataList Discussions">
   <?php include($this->FetchViewLocation('discussions')); ?>
</ul>
<?php
   $PagerOptions = array('RecordCount' => $this->Data('CountDiscussions'), 'CurrentRecords' => $this->Data('Discussions')->NumRows());
   if ($this->Data('_PagerUrl')) {
      $PagerOptions['Url'] = $this->Data('_PagerUrl');
   }
   echo PagerModule::Write($PagerOptions);
} else {
   ?>
   <div class="Empty"><?php echo T('No discussions were found.'); ?></div>
   <?php
}
?>
<ul class="DataList Discussions" style="padding: 10px 0; margin: 10px 0;" >
<li>
Select category: <select class="cat-select">
<option value="all">All</option>
<?php
   $MaxDepth = C('Vanilla.Categories.MaxDisplayDepth');
     
   foreach ( $Categories as $Category) {
      if ($Category->CategoryID < 0 || $MaxDepth > 0 && $Category->Depth > $MaxDepth)
         continue;

     $selected = ($CategoryID == $Category->CategoryID ? 'selected="selected"' : '');
      
      echo '<option value="'.rawurlencode($Category->UrlCode).'" '.$selected.'>';
	  echo $Category->Name;
	  echo "</option>\n";
   }
?>
</select>
</li>
</ul>
<script type="text/javascript">
$(function() {
	$('.cat-select').change(function() {
		var cat = $(this).val();
		window.location.href = "http://www.thebearandbadger.co.uk/categories/"+cat;
	});
});
</script>

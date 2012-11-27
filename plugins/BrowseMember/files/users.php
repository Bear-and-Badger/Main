<?php if (!defined('APPLICATION')) exit();
$Session = Gdn::Session();
foreach ($this->UserData->Format('Text')->Result() as $User) {
?>
	<div style="display:inline-block;width:130px;height:120px;vertical-align:top;margin-top:10px;">
		<div>
			<?php 						
				if($User->Photo == '' || is_null($User->Photo)) $User->Photo = UserBuilder($User)->Photo; 							
				//print UserAnchor("<img src=\"".((stristr($User->Photo,"http://"))?$User->Photo:Url('uploads/'.ChangeBasename($User->Photo, 'n%s')))."\" width=\"40px\">");
				echo $PhotoAnchor = UserPhoto($User, 'Photo');
			?>
			<?php if($Session->IsValid()){ ?>
			<a href="<?php echo Url('messages/add/')."/".$User->Name; ?>">PM</a>
			<?php } ?>
		</div>
		<div>
			<strong><?php echo UserAnchor($User); ?></strong>
		</div>
		<div style="font-size:10px;margin-top:-5px;">
			<p>Joined:<?php echo date("F d Y",strtotime($User->DateFirstVisit)); ?><br />
			Posts: <?php echo T($User->CountComments + $User->CountDiscussions); ?><br />						
			</p>					
		</div>
	</div>
<?php
}
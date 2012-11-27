<?php if (!defined('APPLICATION')) exit();
	echo $this->Form->Open();
	echo $this->Form->Errors();
?>

<h1>Addon Manager</h1>
<div class="Info">
	<?php echo T('Locale.Usage'); ?>
</div>
<table>
	<tbody>
		<tr>
			<th><?php echo T('Download-URL'); ?></th>
			<td><?php echo $this->Form->TextBox('AddonManager.FileUrl'); ?></td>
		</tr>
		<tr>
			<th><?php echo T('Addon-Typ'); ?></th>
			<td><?php				
				echo $this->Form->DropDown(
					'AddonManager.FileTyp', 
					array (
						0 => T('Plugin Addon'), 
						1 => T('Theme Addon'), 
						//2 => T('Locale Addon'), 
						3 => T('Application Addon')					
					)
				);
            ?></td>
		</tr>
		<tr>
			<td colspan="2">
				<iframe src="http://vanillaforums.org/addons" width="100%" height="500px"></iframe>
			</td>
		</tr>			
	</tbody>
</table><br />

<?php echo $this->Form->Close(T('Install')); ?>


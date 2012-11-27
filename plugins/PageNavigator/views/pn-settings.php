<?php if (!defined('APPLICATION')) exit();
echo $this->Form->Open();
echo $this->Form->Errors();
?>


<h1><?php echo Gdn::Translate('Page Navigator'); ?></h1>

<div class="Info"><?php echo Gdn::Translate('Page Navigator Options.'); ?></div>

<table class="AltRows">
    <thead>
        <tr>
            <th><?php echo Gdn::Translate('Option'); ?></th>
            <th class="Alt"><?php echo Gdn::Translate('Description'); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                    'Plugins.PageNavigator.Show_Top', 'ShowTop',
                    array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Check to show "Top Link" with each comment in individual discussion page'); ?>
            </td>
        </tr>

          <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                    'Plugins.PageNavigator.Show_Bottom', 'ShowBottom',
                    array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Check to show "Bottom Link" with each comment in individual discussion page'); ?>
            </td>
        </tr>   
            
            
            
            
              <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                    'Plugins.PageNavigator.Show_First', 'ShowFirst',
                    array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Check to show "First Link" with each discussion in discussions listing page'); ?>
            </td>
        </tr>


    <tr>
            <td>
                <?php
                echo $this->Form->CheckBox(
                    'Plugins.PageNavigator.Show_Last', 'ShowLast',
                    array('value' => '1', 'selected' => 'selected')
                );
                ?>
            </td>
            <td class="Alt">
                <?php echo Gdn::Translate('Check the box to show "Last Link" with each discussion in discussions listing page'); ?>
            </td>
        </tr>

</table>

<?php echo $this->Form->Close('Save');



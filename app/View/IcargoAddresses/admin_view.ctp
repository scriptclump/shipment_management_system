<div class="icargoAddresses view">
<h2><?php echo __('Icargo Address'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($icargoAddress['IcargoAddress']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($icargoAddress['IcargoAddress']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address One'); ?></dt>
		<dd>
			<?php echo h($icargoAddress['IcargoAddress']['address_one']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address Two'); ?></dt>
		<dd>
			<?php echo h($icargoAddress['IcargoAddress']['address_two']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($icargoAddress['IcargoAddress']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($icargoAddress['IcargoAddress']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip Code'); ?></dt>
		<dd>
			<?php echo h($icargoAddress['IcargoAddress']['zip_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($icargoAddress['IcargoAddress']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($icargoAddress['IcargoAddress']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($icargoAddress['IcargoAddress']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Icargo Address'), array('action' => 'edit', $icargoAddress['IcargoAddress']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Icargo Address'), array('action' => 'delete', $icargoAddress['IcargoAddress']['id']), null, __('Are you sure you want to delete # %s?', $icargoAddress['IcargoAddress']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Icargo Addresses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Icargo Address'), array('action' => 'add')); ?> </li>
	</ul>
</div>

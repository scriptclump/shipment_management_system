<div class="icargoAddresses form">
<?php echo $this->Form->create('IcargoAddress'); ?>
	<fieldset>
		<legend><?php echo __('Add Icargo Address'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('address_one');
		echo $this->Form->input('address_two');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip_code');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Icargo Addresses'), array('action' => 'index')); ?></li>
	</ul>
</div>

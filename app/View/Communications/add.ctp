<div class="communications form">
<?php echo $this->Form->create('Communication'); ?>
	<fieldset>
		<legend><?php echo __('Add Communication'); ?></legend>
	<?php
		echo $this->Form->input('alert_id');
		echo $this->Form->input('from_id');
		echo $this->Form->input('to_id');
		echo $this->Form->input('ip_address');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Communications'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Alerts'), array('controller' => 'alerts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Alert'), array('controller' => 'alerts', 'action' => 'add')); ?> </li>
	</ul>
</div>

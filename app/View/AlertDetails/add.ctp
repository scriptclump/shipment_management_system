<div class="alertDetails form">
<?php echo $this->Form->create('AlertDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Alert Detail'); ?></legend>
	<?php
		echo $this->Form->input('alert_id');
		echo $this->Form->input('body');
		echo $this->Form->input('qty');
		echo $this->Form->input('declaration_amt');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Alert Details'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Alerts'), array('controller' => 'alerts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Alert'), array('controller' => 'alerts', 'action' => 'add')); ?> </li>
	</ul>
</div>

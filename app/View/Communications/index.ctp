<div class="communications index">
	<h2><?php echo __('Communications'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('alert_id'); ?></th>
			<th><?php echo $this->Paginator->sort('from_id'); ?></th>
			<th><?php echo $this->Paginator->sort('to_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ip_address'); ?></th>
			<th><?php echo $this->Paginator->sort('message'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($communications as $communication): ?>
	<tr>
		<td><?php echo h($communication['Communication']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($communication['Alert']['user_id'], array('controller' => 'alerts', 'action' => 'view', $communication['Alert']['id'])); ?>
		</td>
		<td><?php echo h($communication['Communication']['from_id']); ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['to_id']); ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['ip_address']); ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['message']); ?>&nbsp;</td>
		<td><?php echo h($communication['Communication']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $communication['Communication']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $communication['Communication']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $communication['Communication']['id']), null, __('Are you sure you want to delete # %s?', $communication['Communication']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Communication'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Alerts'), array('controller' => 'alerts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Alert'), array('controller' => 'alerts', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="alertDetails index">
	<h2><?php echo __('Alert Details'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('alert_id'); ?></th>
			<th><?php echo $this->Paginator->sort('body'); ?></th>
			<th><?php echo $this->Paginator->sort('qty'); ?></th>
			<th><?php echo $this->Paginator->sort('declaration_amt'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($alertDetails as $alertDetail): ?>
	<tr>
		<td><?php echo h($alertDetail['AlertDetail']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($alertDetail['Alert']['user_id'], array('controller' => 'alerts', 'action' => 'view', $alertDetail['Alert']['id'])); ?>
		</td>
		<td><?php echo h($alertDetail['AlertDetail']['body']); ?>&nbsp;</td>
		<td><?php echo h($alertDetail['AlertDetail']['qty']); ?>&nbsp;</td>
		<td><?php echo h($alertDetail['AlertDetail']['declaration_amt']); ?>&nbsp;</td>
		<td><?php echo h($alertDetail['AlertDetail']['status']); ?>&nbsp;</td>
		<td><?php echo h($alertDetail['AlertDetail']['created']); ?>&nbsp;</td>
		<td><?php echo h($alertDetail['AlertDetail']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $alertDetail['AlertDetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $alertDetail['AlertDetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $alertDetail['AlertDetail']['id']), null, __('Are you sure you want to delete # %s?', $alertDetail['AlertDetail']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Alert Detail'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Alerts'), array('controller' => 'alerts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Alert'), array('controller' => 'alerts', 'action' => 'add')); ?> </li>
	</ul>
</div>

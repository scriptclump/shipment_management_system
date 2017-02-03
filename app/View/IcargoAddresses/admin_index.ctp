<div class="icargoAddresses index">
	<h2><?php echo __('Icargo Addresses'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('address_one'); ?></th>
			<th><?php echo $this->Paginator->sort('address_two'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('zip_code'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($icargoAddresses as $icargoAddress): ?>
	<tr>
		<td><?php echo h($icargoAddress['IcargoAddress']['id']); ?>&nbsp;</td>
		<td><?php echo h($icargoAddress['IcargoAddress']['name']); ?>&nbsp;</td>
		<td><?php echo h($icargoAddress['IcargoAddress']['address_one']); ?>&nbsp;</td>
		<td><?php echo h($icargoAddress['IcargoAddress']['address_two']); ?>&nbsp;</td>
		<td><?php echo h($icargoAddress['IcargoAddress']['city']); ?>&nbsp;</td>
		<td><?php echo h($icargoAddress['IcargoAddress']['state']); ?>&nbsp;</td>
		<td><?php echo h($icargoAddress['IcargoAddress']['zip_code']); ?>&nbsp;</td>
		<td><?php echo h($icargoAddress['IcargoAddress']['status']); ?>&nbsp;</td>
		<td><?php echo h($icargoAddress['IcargoAddress']['created']); ?>&nbsp;</td>
		<td><?php echo h($icargoAddress['IcargoAddress']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $icargoAddress['IcargoAddress']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $icargoAddress['IcargoAddress']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $icargoAddress['IcargoAddress']['id']), null, __('Are you sure you want to delete # %s?', $icargoAddress['IcargoAddress']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Icargo Address'), array('action' => 'add')); ?></li>
	</ul>
</div>

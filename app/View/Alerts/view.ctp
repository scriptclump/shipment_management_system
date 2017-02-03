<div class="alerts view">
<h2><?php echo __('Alert'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($alert['Alert']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($alert['User']['id'], array('controller' => 'users', 'action' => 'view', $alert['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Note'); ?></dt>
		<dd>
			<?php echo h($alert['Alert']['note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($alert['Alert']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($alert['Alert']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($alert['Alert']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Alert'), array('action' => 'edit', $alert['Alert']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Alert'), array('action' => 'delete', $alert['Alert']['id']), null, __('Are you sure you want to delete # %s?', $alert['Alert']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Alerts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Alert'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Alert Details'), array('controller' => 'alert_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Alert Detail'), array('controller' => 'alert_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Communications'), array('controller' => 'communications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Communication'), array('controller' => 'communications', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Alert Details'); ?></h3>
	<?php if (!empty($alert['AlertDetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Alert Id'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Declaration Amt'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($alert['AlertDetail'] as $alertDetail): ?>
		<tr>
			<td><?php echo $alertDetail['id']; ?></td>
			<td><?php echo $alertDetail['alert_id']; ?></td>
			<td><?php echo $alertDetail['body']; ?></td>
			<td><?php echo $alertDetail['qty']; ?></td>
			<td><?php echo $alertDetail['declaration_amt']; ?></td>
			<td><?php echo $alertDetail['status']; ?></td>
			<td><?php echo $alertDetail['created']; ?></td>
			<td><?php echo $alertDetail['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'alert_details', 'action' => 'view', $alertDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'alert_details', 'action' => 'edit', $alertDetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'alert_details', 'action' => 'delete', $alertDetail['id']), null, __('Are you sure you want to delete # %s?', $alertDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Alert Detail'), array('controller' => 'alert_details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Communications'); ?></h3>
	<?php if (!empty($alert['Communication'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Alert Id'); ?></th>
		<th><?php echo __('Member Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php  foreach ($alert['Communication'] as $communication): ?>
		<tr>
			<td><?php echo $communication['id']; ?></td>
			<td><?php echo $communication['alert_id']; ?></td>
			<td><?php echo $communication['member_id']; ?></td>
			<td><?php echo $communication['user_id']; ?></td>
			<td><?php echo $communication['body']; ?></td>
			<td><?php echo $communication['status']; ?></td>
			<td><?php echo $communication['created']; ?></td>
			<td><?php echo $communication['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'communications', 'action' => 'view', $communication['alert_id'] )); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'communications', 'action' => 'edit', $communication['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'communications', 'action' => 'delete', $communication['id']), null, __('Are you sure you want to delete # %s?', $communication['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Communication'), array('controller' => 'communications', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>

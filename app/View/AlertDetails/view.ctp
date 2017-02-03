<div class="alertDetails view">
<h2><?php echo __('Alert Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($alertDetail['AlertDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alert'); ?></dt>
		<dd>
			<?php echo $this->Html->link($alertDetail['Alert']['username'], array('controller' => 'alerts', 'action' => 'view', $alertDetail['Alert']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Body'); ?></dt>
		<dd>
			<?php echo h($alertDetail['AlertDetail']['body']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Qty'); ?></dt>
		<dd>
			<?php echo h($alertDetail['AlertDetail']['qty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Declaration Amt'); ?></dt>
		<dd>
			<?php echo h($alertDetail['AlertDetail']['declaration_amt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($alertDetail['AlertDetail']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($alertDetail['AlertDetail']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($alertDetail['AlertDetail']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Alert Detail'), array('action' => 'edit', $alertDetail['AlertDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Alert Detail'), array('action' => 'delete', $alertDetail['AlertDetail']['id']), null, __('Are you sure you want to delete # %s?', $alertDetail['AlertDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Alert Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Alert Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Alerts'), array('controller' => 'alerts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Alert'), array('controller' => 'alerts', 'action' => 'add')); ?> </li>
	</ul>
</div>

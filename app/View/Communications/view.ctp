<div class="communications view">
<h2><?php echo __('Communication'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($communication['Communication']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alert'); ?></dt>
		<dd>
			<?php echo $this->Html->link($communication['Alert']['user_id'], array('controller' => 'alerts', 'action' => 'view', $communication['Alert']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From Id'); ?></dt>
		<dd>
			<?php echo h($communication['Communication']['from_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('To Id'); ?></dt>
		<dd>
			<?php echo h($communication['Communication']['to_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ip Address'); ?></dt>
		<dd>
			<?php echo h($communication['Communication']['ip_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($communication['Communication']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($communication['Communication']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Communication'), array('action' => 'edit', $communication['Communication']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Communication'), array('action' => 'delete', $communication['Communication']['id']), null, __('Are you sure you want to delete # %s?', $communication['Communication']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Communications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Communication'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Alerts'), array('controller' => 'alerts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Alert'), array('controller' => 'alerts', 'action' => 'add')); ?> </li>
	</ul>
</div>

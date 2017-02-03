<div class="md-overlay"></div>
<div class="page-head">
   <ol class="breadcrumb">
     <!--  <li class="active"><i class="fa fa-plus-square"></i>&nbsp;<?php echo $this->Html->link(__('New Alert'), array('action' => 'add')); ?></li> -->
   </ol>
</div>
<div class="block block-color primary">
   <div class="header">
      <h3><?php echo __('Alerts'); ?></h3>
   </div>
   <div class="content">
      <!-- <div class="row">
         <div class="col-sm-3"></div>
         <div class="col-sm-6 col-md-6">
            <div class="bs_border_container">
               <div class="header">
                  <h3>Search Records</h3>
               </div>
               <div class="content">
                  <?php
                     $inputDefaults = array(
                        'class' => 'form-horizontal',
                        'inputDefaults' => array(
                           'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                           'label' => array('class' => 'col-sm-2 control-label'),
                           'class' => 'form-control',
                           'div' => 'form-group',
                           'between' => '<div class="col-sm-10">',
                           'error' => array(
                              'attributes' => array('wrap' => 'span', 'class' => 'help-inline')
                           ),
                           'after' => '</div>'
                        ),
                        'novalidate' => true,
                        'parsley-validate' => ''
                     );
                     echo $this->Form->create('', $inputDefaults);
                     echo $this->Form->input('body', array('class' => 'form-control parsley-validated', 'placeholder' => 'Enter keywords to search', 'label' => array('class' => 'col-sm-2 control-label', 'text' => 'Keywords') ));
                     echo $this->Form->input('status', array('options' => array('' => '(choose one)', '1' => 'Active', '0' => 'Inactive')));
                  ?>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php
                        echo $this->Form->button('Submit', array(
                            'type' => 'submit',
                            'class' => 'btn btn-primary',
                            'data-dismiss'  => 'modal'
                        ));
                        echo $this->Form->button('Reset', array(
                            'type' => 'reset',
                            'class' => 'btn btn-default',
                            'data-dismiss'  => 'modal'
                        ));
                        echo $this->Html->link(__('Reset Search'), array('action' => 'index'), array('class' => 'btn btn-warning') );
                        ?>
                    </div>
                  </div>
                  <?php echo $this->Form->end(); ?>
               </div>
            </div>
         </div>
         <div class="col-sm-3"></div>
      </div> -->
      <div class="row">&nbsp;</div>
      <?php echo $this->Form->create('Alert', array('action' => 'bulk_action/','onsubmit'=>'return confirm("Are you sure, you want to perform the bulk actions?");')); ?>
         <div class="table-responsive">
            <div id="datatable2_wrapper" class="dataTables_wrapper form-inline no-footer">
               <table class="table table-bordered" id="datatable2" >
                  <thead>
                     <tr>
                        <th><?php echo $this->Form->checkbox('del_item', array('id' => 'selectall') ); ?></th>
                        <th><?php echo $this->Paginator->sort('id'); ?></th>
                        <th><?php echo __('User'); ?></th>
                        <th><?php echo $this->Paginator->sort('note'); ?></th>
                        <th><?php echo $this->Paginator->sort('status'); ?></th>
                        <th><?php echo __('Message'); ?>&nbsp; <i class="fa fa-comments"></i></th>
                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                        <th><?php echo __('Actions'); ?></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php //pr($alerts);
                        foreach ($alerts as $alert): ?>
                     <tr>
                        <td><?php echo $this->Form->checkbox('del_item.', array('class' => 'del_item', 'hiddenField' => false, 'value' => $alert['Alert']['id'] ) ); ?></td>
                        <td><?php echo h($alert['Alert']['id']); ?></td>
                        <td><?php echo $this->Html->link(
                              '<strong>'.h($alert['User']['Profile']['fname']). '&nbsp;' .h($alert['User']['Profile']['lname']).' / '.$alert['User']['id'].'</strong>
                              <br />'.$alert['User']['email'],
                              array('controller' => 'users', 'action' => 'view', $alert['User']['id']),
                              array('target' => '_blank', 'escape' => false)  ); ?>
                        </td>
                        <td><?php echo $this->Text->excerpt($alert['Alert']['note'], 'method', 80, ''); ?></td>
                        <td><?php
                        if( $alert['Alert']['status'] == '1' ){
                           echo "Recibidos";
                        } else if( $alert['Alert']['status'] == '2' ){
                           echo "Consolidation";
                        } else if( $alert['Alert']['status'] == '3' ){
                           echo "Pago Pendiente";
                        } else if( $alert['Alert']['status'] == '4' ){
                           echo "Despachado";
                        } else if( $alert['Alert']['status'] == '5' ){
                           echo "Entregado a la Transportadora";
                        } else if( $alert['Alert']['status'] == '6' ){
                           echo "Entregado";
                        } else{
                           echo 'Pendiente';
                        }
                         ?></td>
                        <td><?php
                           if( count($alert['Communication']) > 0 ){
                              echo $this->Html->link(__('%s Unread Messages', $alert['Communication'][0]['Communication'][0]['unread']), array('action' => 'communications', $alert['Alert']['id'], $alert['User']['id']));
                           } else{
                              echo $this->Html->link(__('0 Unread Message'), array('action' => 'communications', $alert['Alert']['id'], $alert['User']['id']));
                           }
                           ?></td>
                        <td><?php echo h($alert['Alert']['created']); ?></td>
                        <td>
                           <div class="btn-group">
                              <button class="btn btn-default btn-xs" type="button">Actions</button><button data-toggle="dropdown" class="btn btn-xs btn-primary dropdown-toggle" type="button"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                              <ul role="menu" class="dropdown-menu">
                                 <li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $alert['Alert']['id'])); ?></li>
                                 <li><?php echo $this->Html->link(__('Communications'), array('action' => 'communications', $alert['Alert']['id'], $alert['User']['id'])); ?></li>
                                 <li class="divider"></li>
                                 <li>
                                    <?php
                                       echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $alert['Alert']['id']), null, __('Are you sure you want to delete # %s?', $alert['Alert']['id']));
                                       ?>
                                 </li>
                              </ul>
                           </div>
                        </td>
                     </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
               <div class="row">
                   <div class="col-sm-12">
                     <div class="pull-right">&nbsp;</div>
                     <div class="pull-left">
                        <div class="dataTables_length" id="datatable2_length">
                           <label>
                              <?php
                              echo $this->Form->input('do_action', array(
                              'options' => array('' => 'Bulk Actions', 'delete' => 'Delete'),
                              'class' => 'form-control',
                              'div' => false,
                              'label' => false
                              ));

                              echo $this->Form->button('Apply', array(
                                  'type' => 'submit',
                                  'class' => 'btn btn-prusia btn-rad',
                                  'data-dismiss'  => 'modal'
                              ));
                              ?>
                           </label>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="pull-left">
                        <div class="dataTables_info" id="datatable2_info" role="status" aria-live="polite">
                           <?php
                              echo $this->Paginator->counter(array(
                              'format' => __('Showing {:start} to {:end} of {:count} entries')
                              ));
                           ?>
                        </div>
                     </div>
                     <div class="pull-right">
                        <div class="dataTables_paginate paging_bs_normal" id="datatable2_paginate">
                           <?php if( $this->Paginator->params['paging']['Alert']['pageCount'] > 1 ){ ?>
                           <ul class="pagination">
                              <?php
                                 echo $this->Paginator->prev('< ' . __('Previous'), array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
                                 echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'currentClass' => 'active'));
                                 echo $this->Paginator->next(__('Next') . ' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
                              ?>
                           </ul>
                           <?php } ?>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                  </div>
               </div>
            </div>
         </div>
      <?php echo $this->Form->end(); ?>
   </div>
</div>
<?php echo $this->Html->css(
         array(
            '/back_end/js/jquery.datatables/bootstrap-adapter/css/datatables'
            )
         );?>
<?php echo $this->Html->script('ckeditor/ckeditor');?>
<div class="page-head">
	<ol class="breadcrumb">
		<li><i class="fa fa-bars"></i>&nbsp;<?php echo $this->Html->link(__('List Alerts'), array('action' => 'index')); ?></li>
		<li><i class="fa fa-times"></i>&nbsp;<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Alert.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Alert.id'))); ?></li>
		<li><i class="fa fa-comments"></i>&nbsp;<?php echo $this->Html->link(__('View Communications'), array('action' => 'communications', $this->request->data['Alert']['id'])); ?></li>
 	</ol>
</div>
<div class="panel-group accordion accordion-semi" id="accordion4">
	<div class="panel panel-default">
	  <div class="panel-heading">
	     <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion4" href="#ac4-1">
	        <i class="fa fa-angle-right"></i> <?php echo __('Update Alert Status'); ?>
	        </a>
	     </h4>
	  </div>
	  <div id="ac4-1" class="panel-collapse collapse in">
	     <div class="panel-body">
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
					echo $this->Form->create('Alert', $inputDefaults);
					echo $this->Form->input('id');
					?>
					<div class="form-group">
					   <label class="col-sm-2 control-label" for="AlertUserId">User</label>
					   <div class="col-sm-10">
					     <?=$this->request->data['User']['username']?> (<?=$this->Text->autoLinkEmails($this->request->data['User']['email'])?>)
					     <?php echo $this->Form->input('User.email', array('type' => 'hidden', 'value' => $this->request->data['User']['email'])); ?>
					   </div>
					</div>
					<div class="form-group">
					   <label class="col-sm-2 control-label" for="AlertUserId">User Note</label>
					   <div class="col-sm-10">
					     <?=$this->request->data['Alert']['note']?>
					   </div>
					</div>
					<?php
					echo $this->Form->input('status',
						array(
						'options' => array('' => '(choose one)',
											'0' => 'Pendiente',
											'1' => 'Recibidos',
											'2' => 'Consolidation',
											'3' => 'Pago Pendiente',
											'4' => 'Despachado',
											'5' => 'Entregado a la Transportadora',
											'6' => 'Entregado'
											),
						'required' => 'required'
						));
				?>
				<div class="form-group" id="consolidacion_comment">
				   <label class="col-sm-2 control-label" for="AlertConsolidacionComment"><?=__('Comment')?></label>
				   <div class="col-sm-10">
				   	<textarea name="data[Alert][consolidacion_comment]" id="data[Alert][consolidacion_comment]" class="form-control parsley-validated" cols="30" rows="10"><?=$this->request->data['Alert']['consolidacion_comment']?></textarea>
				   	</div>
				</div>
				<div class="form-group" id="pago_pendiente_comment">
				   <label class="col-sm-2 control-label" for="AlertConsolidacionComment"><?=__('Comment')?></label>
				   <div class="col-sm-10">
				   	<textarea name="data[Alert][pago_pendiente_comment]" id="data[Alert][pago_pendiente_comment]" class="form-control parsley-validated" cols="30" rows="10"><?=$this->request->data['Alert']['pago_pendiente_comment']?></textarea>
				   	</div>
				</div>
				<div class="form-group" id="despachado_comment">
				   <label class="col-sm-2 control-label" for="AlertConsolidacionComment"><?=__('Comment')?></label>
				   <div class="col-sm-10">
				   	<textarea name="data[Alert][despachado_comment]" id="data[Alert][despachado_comment]" class="form-control parsley-validated" cols="30" rows="10"><?=$this->request->data['Alert']['despachado_comment']?></textarea>
				   	</div>
				</div>
				<div class="form-group" id="entregado_a_la_transportadora_comment">
				   <label class="col-sm-2 control-label" for="AlertConsolidacionComment"><?=__('Comment')?></label>
				   <div class="col-sm-10">
				   	<textarea name="data[Alert][entregado_a_la_transportadora_comment]" id="data[Alert][entregado_a_la_transportadora_comment]" class="form-control parsley-validated" cols="30" rows="10"><?=$this->request->data['Alert']['entregado_a_la_transportadora_comment']?></textarea>
				   	</div>
				</div>
				<div class="form-group" id="entregado_comment">
				   <label class="col-sm-2 control-label" for="AlertConsolidacionComment"><?=__('Comment')?></label>
				   <div class="col-sm-10">
				   	<textarea name="data[Alert][entregado_comment]" id="data[Alert][entregado_comment]" class="form-control parsley-validated" cols="30" rows="10"><?=$this->request->data['Alert']['entregado_comment']?></textarea>
				   	</div>
				</div>
				<div class="form-group" id="icargobox_tracking_no">
				   <label class="col-sm-2 control-label" for="Alerticargobox_tracking_no"><?=__('	ICargoBox Tracking No')?></label>
				   <div class="col-sm-10"><input type="text" id="data[Alert][icargobox_tracking_no]" value="<?=$this->request->data['Alert']['icargobox_tracking_no']?>" maxlength="255"  class="form-control parsley-validated" name="data[Alert][icargobox_tracking_no]"></div>
				</div>
				<div class="form-group" id="national_tracking_no">
				   <label class="col-sm-2 control-label" for="Alertnational_tracking_no"><?=__('	National Tracking No')?></label>
				   <div class="col-sm-10"><input type="text" id="data[Alert][national_tracking_no]" value="<?=$this->request->data['Alert']['national_tracking_no']?>" maxlength="255"  class="form-control parsley-validated" name="data[Alert][national_tracking_no]"></div>
				</div>
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
						?>
				  </div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
	     </div>
	  </div>
	</div>
	<?php //if( $this->request->data['Alert']['status'] == 1 ||  $this->request->data['Alert']['status'] == 0 ||  $this->request->data['Alert']['status'] == "" ){?>
	<div class="panel panel-default">
	  <div class="panel-heading">
	     <h4 class="panel-title">
	        <a class="collapsed" data-toggle="collapse" data-parent="#accordion4" href="#ac4-2">
	        <i class="fa fa-angle-right"></i> <?=__('Update Items Weight')?>
	        </a>
	     </h4>
	  </div>
	  <div id="ac4-2" class="panel-collapse collapse">
	     <div class="panel-body">
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
					'parsley-validate' => '',
        			'url' => array('controller' => 'AlertDetails', 'action' => 'admin_edit')
				);
				echo $this->Form->create('AlertDetail', $inputDefaults);
				?>
	        <div class="content">
	        	<?php
	        	$consignment_total_declaration_rec_amt = '';
	        	$consignment_total_weight = '';
				if( $this->request->data['Alert']['price_per_lb'] != NULL){
       				$price_per_lb = $this->request->data['Alert']['price_per_lb'];
       			} else{
       				$price_per_lb = '';
       			}
       			if( $this->request->data['Alert']['declaration_amt_client'] != NULL){
       				$declaration_amt_client = $this->request->data['Alert']['declaration_amt_client'];
       			} else{
       				$declaration_amt_client = '';
       			}
       			if( $this->request->data['Alert']['tax'] != NULL){
       				$tax = $this->request->data['Alert']['tax'];
       			} else{
       				$tax = '';
       			}
				$consignment_total_fee = '';
	        	for($i=0; $i<count($this->request->data['AlertDetail']); $i++){
	        		// Performing the calculation for the below task.
					$consignment_total_weight              = (int)$consignment_total_weight + (int)$this->request->data['AlertDetail'][$i]['weight'];
					$consignment_total_declaration_rec_amt = $consignment_total_declaration_rec_amt + $this->request->data['AlertDetail'][$i]['declaration_rec_amt'];
	        	?>
	        	<h4> (#<?=$i+1?>) <strong><?=$this->request->data['AlertDetail'][$i]['body']?></strong></h4>
			  	<hr />
	        	<input type="hidden" name="data[AlertDetail][<?=$i?>][id]" value="<?=$this->request->data['AlertDetail'][$i]['id']?>" >
				<div class="form-group">
				   <label class="col-sm-2 control-label" for="AlertUserId"><?=__("Cantidad")?></label>
				   <div class="col-sm-10">
				     <?=$this->request->data['AlertDetail'][$i]['qty']?> <?=__('units')?>
				   </div>
				</div>
				<div class="form-group">
				   <label class="col-sm-2 control-label" for="AlertUserId"><?=__("DECLARACIÓN U.S")?></label>
				   <div class="col-sm-10"><?php echo $this->Number->format($this->request->data['AlertDetail'][$i]['declaration_amt'], array(
	                                    'places' => 2,
	                                    'before' => '$ ',
	                                    'escape' => false,
	                                    'decimals' => '.',
	                                    'thousands' => ','
	                                ));  ?>
				   </div>
				</div>
				<div class="form-group">
				   <label class="col-sm-2 control-label" for="AlertDetailDeclarationRecAmt"><?=__('Declaración Recomendado')?></label>
				   <div class="col-sm-10"><input type="text" id="AlertDetailDeclarationRecAmt" value="<?=$this->request->data['AlertDetail'][$i]['declaration_rec_amt']?>" maxlength="255" required="required" class="form-control parsley-validated" name="data[AlertDetail][<?=$i?>][declaration_rec_amt]"></div>
				</div>
				<div class="form-group">
				   <label class="col-sm-2 control-label" for="AlertDetailWeight"><?=__('Weight (lbs)')?></label>
				   <div class="col-sm-10"><input type="text" id="AlertDetailWeight" value="<?=$this->request->data['AlertDetail'][$i]['weight']?>" maxlength="255" required="required" class="form-control parsley-validated" name="data[AlertDetail][<?=$i?>][weight]"></div>
				</div>
				<div class="form-group">
				   <label class="col-sm-2 control-label" for="AlertDetailAdminNote<?=$i?>"><?=__('Notas')?></label>
				   <div class="col-sm-10"><textarea id="AlertDetailAdminNote<?=$i?>" rows="6" cols="30" class="form-control parsley-validated" name="data[AlertDetail][<?=$i?>][admin_note]"><?=$this->request->data['AlertDetail'][$i]['admin_note']?></textarea></div>
				</div>
				<div class="form-group">
				   <label class="col-sm-2 control-label" for="AlertStatus"><?=__("Status")?></label>
				   <div class="col-sm-10">
					<div class="radio">
					   	<?php if( $this->request->data['AlertDetail'][$i]['status'] == '0' ){ ?>
					   		<label> <input class="icheck" type="radio" name="AlertDetail[<?=$i?>][status]" value="0" checked="checked"> <?=__('Pendiente')?></label>
					   		&nbsp;&nbsp;&nbsp;
					   		<label> <input class="icheck" type="radio" name="AlertDetail[<?=$i?>][status]" value="1"> <?=__('Recibido')?></label>
					   	<?php } else{ ?>
					   		<label> <input class="icheck" type="radio" name="AlertDetail[<?=$i?>][status]" value="0"> <?=__('Pendiente')?></label>
					   		&nbsp;&nbsp;&nbsp;
					   		<label> <input class="icheck" type="radio" name="AlertDetail[<?=$i?>][status]" value="1" checked="checked"> <?=__('Recibido')?></label>
					  	<?php } ?>
				  	</div>
				   </div>
				</div>
				<hr>
				<?php
				}
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
						?>
				  </div>
				</div>
			</div>
			<?php echo $this->Form->end(); ?>
	     </div>
	  </div>
	</div>
	<div class="panel panel-default">
	  <div class="panel-heading">
	     <h4 class="panel-title">
	        <a class="collapsed" data-toggle="collapse" data-parent="#accordion4" href="#ac4-3">
	        <i class="fa fa-angle-right"></i> <?=__('Update Declaración Amount & Tax')?>
	        </a>
	     </h4>
	  </div>
	  <div id="ac4-3" class="panel-collapse collapse">
	     <div class="panel-body">
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
					echo $this->Form->create('Alert', $inputDefaults);
					echo $this->Form->input('id');
					?>
					<div class="form-group">
					   <label class="col-sm-2 control-label" for="AlertUserId"><?=__('Peso Total:')?></label>
					   <div class="col-sm-10">
					     <?=$consignment_total_weight?>
					   </div>
					</div>
					<?php echo $this->Form->input('price_per_lb', array('class' => 'form-control parsley-validated', 'required' => 'required' )); ?>
					<div class="form-group">
					   <label class="col-sm-2 control-label" for="AlertUserId"><?=__('Total Flete:')?></label>
					   <div class="col-sm-10">
					   	<?php $consignment_total_fee = $consignment_total_weight * $price_per_lb; ?>
					    <?=$this->Number->format($consignment_total_fee, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>
					   </div>
					</div>
					<div class="form-group">
					   <label class="col-sm-2 control-label" for="AlertUserId"><?=__('Declaration Recomendado:')?></label>
					   <div class="col-sm-10">
					     <?=$this->Number->format($consignment_total_declaration_rec_amt, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>
					   </div>
					</div>
					<div class="form-group">
					   <label class="col-sm-2 control-label" for="AlertUserId"><?=__('Declaration Del Cliente:')?></label>
					   <div class="col-sm-10">
					     <?
					     	if($declaration_amt_client != ""){
						     	echo $this->Number->format($declaration_amt_client, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));
	                        }
                        ?>
					   </div>
					</div>
					<?php echo $this->Form->input('tax', array('class' => 'form-control parsley-validated', 'required' => 'required' )); ?>
					<div class="form-group">
					   <label class="col-sm-2 control-label" for="AlertUserId"><?=__('Impuesto Total:')?></label>
					   <div class="col-sm-10">
					     <?php
		                  $tax_total = '';
		                  if($declaration_amt_client != ""){
		                  	$tax_total = ($declaration_amt_client * $tax)/100;
		                  	$insurance = ( ($declaration_amt_client + $tax_total) /100 ) * 5;
		                  } else{
		                  	$tax_total = ($consignment_total_declaration_rec_amt * $tax)/100;
		                  	$insurance = ( ($consignment_total_declaration_rec_amt + $tax_total) /100 ) * 5;
		                  }
		                  ?>
		                  <?=$this->Number->format($tax_total, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>
					   </div>
					</div>
					<div class="form-group">
					   <label class="col-sm-2 control-label" for="AlertUserId"><?=__('Seguro:')?></label>
					   <div class="col-sm-10">
					     <?=$this->Number->format($insurance, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>
					   </div>
					</div>
					<div class="form-group">
					   <label class="col-sm-2 control-label" for="AlertUserId"><?=__('TOTAL (usd):')?></label>
					   <div class="col-sm-10">
					     <?php
		                  $total_shipping_cost = $consignment_total_fee + $insurance + $tax_total;
		                  ?>
		                  <?=$this->Number->format($total_shipping_cost, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>
					   </div>
					</div>
					<div class="form-group">
					   <label class="col-sm-2 control-label" for="AlertUserId"><?=__('TRM (Peso):')?></label>
					   <div class="col-sm-10">
					     <?=$this->Number->format($currency['Currency']['amount'], array(
                                    'places' => 2,
                                    'before' => 'COL$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>
					   </div>
					</div>
					<div class="form-group">
					   <label class="col-sm-2 control-label" for="AlertUserId"><?=__('TOTAL (Colombia Peso):')?></label>
					   <div class="col-sm-10">
					     <?php
		                  $total_shipping_cost_peso = $total_shipping_cost * $currency['Currency']['amount'];
		                  ?>
		                  <?=$this->Number->format($total_shipping_cost_peso, array(
                                    'places' => 2,
                                    'before' => 'COL$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>
					   </div>
					</div>
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
						?>
				  </div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
	     </div>
	  </div>
	</div>
	<?php //} ?>
</div>
<script>
	// Default
	$('#consolidacion_comment').hide();
  	$('#pago_pendiente_comment').hide();
  	$('#despachado_comment').hide();
  	$('#entregado_a_la_transportadora_comment').hide();
  	$('#entregado_comment').hide();
  	$('#icargobox_tracking_no').hide();
  	$('#national_tracking_no').hide();
<?php
if( $this->request->data['Alert']['status'] == 2){
?>
	$('#consolidacion_comment').show();
  	$('#pago_pendiente_comment').hide();
  	$('#despachado_comment').hide();
  	$('#entregado_a_la_transportadora_comment').hide();
  	$('#entregado_comment').hide();
  	$('#icargobox_tracking_no').show();
  	$('#national_tracking_no').show();
<?php
}
?>
<?php
if( $this->request->data['Alert']['status'] == 3){
?>
	$('#consolidacion_comment').hide();
  	$('#pago_pendiente_comment').show();
  	$('#despachado_comment').hide();
  	$('#entregado_a_la_transportadora_comment').hide();
  	$('#entregado_comment').hide();
  	$('#icargobox_tracking_no').hide();
  	$('#national_tracking_no').hide();
<?php
}
?>
<?php
if( $this->request->data['Alert']['status'] == 4){
?>
	$('#consolidacion_comment').hide();
  	$('#pago_pendiente_comment').hide();
  	$('#despachado_comment').show();
  	$('#entregado_a_la_transportadora_comment').hide();
  	$('#entregado_comment').hide();
  	$('#icargobox_tracking_no').hide();
  	$('#national_tracking_no').hide();
<?php
}
?>
<?php
if( $this->request->data['Alert']['status'] == 5){
?>
	$('#consolidacion_comment').hide();
  	$('#pago_pendiente_comment').hide();
  	$('#despachado_comment').hide();
  	$('#entregado_a_la_transportadora_comment').show();
  	$('#entregado_comment').hide();
  	$('#icargobox_tracking_no').hide();
  	$('#national_tracking_no').hide();
<?php
}
?>
<?php
if( $this->request->data['Alert']['status'] == 6){
?>
  	$('#consolidacion_comment').hide();
  	$('#pago_pendiente_comment').hide();
  	$('#despachado_comment').hide();
  	$('#entregado_a_la_transportadora_comment').hide();
  	$('#entregado_comment').show();
  	$('#icargobox_tracking_no').hide();
  	$('#national_tracking_no').hide();
<?php
}
?>
    $('#AlertStatus').on('change', function() {
	  // Pendiente
	  if( this.value == 0 ){
	  	$('#consolidacion_comment').hide();
	  	$('#pago_pendiente_comment').hide();
	  	$('#despachado_comment').hide();
	  	$('#entregado_a_la_transportadora_comment').hide();
	  	$('#entregado_comment').hide();
	  	$('#icargobox_tracking_no').hide();
	  	$('#national_tracking_no').hide();
	  }
	  // Recibido
	  if( this.value == 1 ){
	  	$('#consolidacion_comment').hide();
	  	$('#pago_pendiente_comment').hide();
	  	$('#despachado_comment').hide();
	  	$('#entregado_a_la_transportadora_comment').hide();
	  	$('#entregado_comment').hide();
	  	$('#icargobox_tracking_no').hide();
	  	$('#national_tracking_no').hide();
	  }
	  // Consolidation
	  if( this.value == 2 ){
	  	$('#consolidacion_comment').show();
	  	$('#pago_pendiente_comment').hide();
	  	$('#despachado_comment').hide();
	  	$('#entregado_a_la_transportadora_comment').hide();
	  	$('#entregado_comment').hide();
	  	$('#icargobox_tracking_no').show();
	  	$('#national_tracking_no').show();
	  }
	  // Pago Pendiente
	  if( this.value == 3 ){
	  	$('#consolidacion_comment').hide();
	  	$('#pago_pendiente_comment').show();
	  	$('#despachado_comment').hide();
	  	$('#entregado_a_la_transportadora_comment').hide();
	  	$('#entregado_comment').hide();
	  	$('#icargobox_tracking_no').hide();
	  	$('#national_tracking_no').hide();
	  }
	  // Despachado
	  if( this.value == 4 ){
	  	$('#consolidacion_comment').hide();
	  	$('#pago_pendiente_comment').hide();
	  	$('#despachado_comment').show();
	  	$('#entregado_a_la_transportadora_comment').hide();
	  	$('#entregado_comment').hide();
	  	$('#icargobox_tracking_no').hide();
	  	$('#national_tracking_no').hide();
	  }
	  // Entregado a la Transportadora
	  if( this.value == 5 ){
	  	$('#consolidacion_comment').hide();
	  	$('#pago_pendiente_comment').hide();
	  	$('#despachado_comment').hide();
	  	$('#entregado_a_la_transportadora_comment').show();
	  	$('#entregado_comment').hide();
	  	$('#icargobox_tracking_no').hide();
	  	$('#national_tracking_no').hide();
	  }
	  // Entregado
	  if( this.value == 6 ){
	  	$('#consolidacion_comment').hide();
	  	$('#pago_pendiente_comment').hide();
	  	$('#despachado_comment').hide();
	  	$('#entregado_a_la_transportadora_comment').hide();
	  	$('#entregado_comment').show();
	  	$('#icargobox_tracking_no').hide();
	  	$('#national_tracking_no').hide();
	  }
	});
</script>
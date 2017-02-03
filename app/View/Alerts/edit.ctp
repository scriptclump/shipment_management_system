<?php
$consignment_total_weight = '';
if( $alert['Alert']['price_per_lb'] != NULL){
	$price_per_lb = $alert['Alert']['price_per_lb'];
} else{
	$price_per_lb = '';
}
if( $alert['Alert']['declaration_amt_client'] != NULL){
	$declaration_amt_client = $alert['Alert']['declaration_amt_client'];
} else{
	$declaration_amt_client = '';
}
if( $alert['Alert']['tax'] != NULL){
	$tax = $alert['Alert']['tax'];
} else{
	$tax = '';
}
$consignment_total_fee                 = '';
$consignment_total_declaration_rec_amt = '';
?>
<div class="row">
	<div class="inner_content_container">
		<?php echo $this->element('left_sidebar'); ?>
		<div class="inner_content_right">
		<?php echo $this->Session->flash(); ?>
		<?php if( count($alert) > 0 && count($alert['AlertDetail']) > 0 ){ ?>
		   <div class="order_table_content_area">
		      <div class="order_table_content_box">
		         <div class="right_top_title">
		            <h3><?=__("Pedidos Pendientes");?></h3>
		         </div>
		         <div class="right_btn">
		            <a class="btn green" href="<?=BASE_URL?>alerts/shipping/<?=$alert['Alert']['id']?>"><?=__("ENVIOS Y PAGOS")?></a>
		            <?php if( count($alert['Communication']) > 0 ){ ?>
						<a class="btn blue" href="<?=BASE_URL?>alerts/communications/<?=$alert['Alert']['id']?>"><?=__("Centro de mensajes <sup>".$alert['Communication'][0]['Communication'][0]['unread']."</sup> ")?></a>
		        	<?php } else{ ?>
						<a class="btn blue" href="<?=BASE_URL?>alerts/communications/<?=$alert['Alert']['id']?>"><?=__("Centro de mensajes")?></a>
		        	<?php } ?>
		            <a class="btn red" href="<?=BASE_URL?>alerts/add"><?=__("nuevo ALERTA")?></a>
		         </div>
		         <div class="the_order_table">
		            <table width="100%" border="0" cellpadding="0" cellspacing="0">
		               <tr class="head_tr">
		                  <td class="fecha_width"><?=__("Fecha")?></td>
		                  <td class="left_align_tab_head descrip_width"><?=__("Descripción")?></td>
		                  <td class="declaration_width"><?=__("Declaración")?></td>
		                  <td class="notas_width"><?=__("Notas")?></td>
		                  <td class="estado_width"><?=__("Estado")?></td>
		                  <td class="delete_width">&nbsp;</td>
		               </tr>
		               <?php
	               			if( count($alert['AlertDetail']) > 0 ) {
	               				$rowspan = count($alert['AlertDetail']);
	               			} else{
	               				$rowspan = 1;
	               			}
	               			$counter = 1;
	               			if( $counter == 1 ){
				                ?>
								<tr class="info_tab">
									<td class="fecha_tab" rowspan="<?=$rowspan?>">
									 <?php echo $this->Time->format($alert['Alert']['created'], '%m/%d/%Y');?>
									 <span class="order_time"><?php echo $this->Time->format($alert['Alert']['created'], '%H:%M:%p');?> PM</span>
									</td>
									<td class="descrip_tion_tab left_align_tab_head"><?=$alert['AlertDetail'][0]['body']?></td>
									<td class="for_declaration"><?php echo $this->Number->format($alert['AlertDetail'][0]['declaration_amt'], array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                )); ?></td>
									<td class="notas" rowspan="<?=$rowspan?>"><?=$alert['Alert']['note']?></td>
									<td class="estado"><?php if( $alert['AlertDetail'][0]['status'] == '0' ){
										echo __("Pendiente");
									} else{
										echo __("Recibido");
									}
									 ?></td>
									<td><?php
                                       echo $this->Form->postLink(
                                       	$this->Html->image('/front_end/images/cancel.png', array('alt' => '')),
                                       	array('controller' => 'AlertDetails', 'action' => 'delete', $alert['AlertDetail'][0]['id']),
                                       	array('escape'=>false),
                                       	__('Are you sure you want to delete ?')
                                       	);
                                       ?></td>
								</tr>
					<?php   }
							for( $i=0; $i < count($alert['AlertDetail']); $i++ ){
								if($i != 0){
					?>
							<tr class="info_tab">
								<td class="descrip_tion_tab left_align_tab_head"><?=$alert['AlertDetail'][$i]['body']?></td>
								<td class="for_declaration"><?php echo $this->Number->format($alert['AlertDetail'][$i]['declaration_amt'], array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                )); ?></td>
								<td class="estado actiuve_padinate"><?php if( $alert['AlertDetail'][$i]['status'] == '0' ){
										echo __("Pendiente");
									} else{
										echo __("Recibido");
									}
									?></td>
								<td><?php
                                       echo $this->Form->postLink(
                                       	$this->Html->image('/front_end/images/cancel.png', array('alt' => '')),
                                       	array('controller' => 'AlertDetails', 'action' => 'delete', $alert['AlertDetail'][$i]['id']),
                                       	array('escape'=>false),
                                       	__('Are you sure you want to delete ?')
                                       	);
                                       ?></td>
							</tr>
					<?php
								}
							}
		              	?>
		               <tr class="info_tab separation_row">
		                  <td colspan="6"></td>
		               </tr>
		            </table>
		         </div>
		      </div>
		      <?php
		      	$received_items = 0;
				for( $i = 0; $i <count($alert['AlertDetail']); $i++ ){
					if( $alert['AlertDetail'][$i]['status'] == 1 ){
						$received_items++;
					}
				}
				if( $received_items > 0 ){
		      ?>
		      <div class="order_table_content_box">
		         <h3><?=__("Pedidos Recibidos")?></h3>
		         <div class="the_order_table">
		            <table width="100%" border="0" cellpadding="0" cellspacing="0">
		               <tr class="head_tr">
		                  <td class="fecha_width"><?=__("Fecha<br />Recibido")?></td>
		                  <td class="left_align_tab_head descrip_width"><?=__("Descripción")?></td>
		                  <td class="declaration_width">Declaración<br /><?=__("Recomendado")?></td>
		                  <td class="notas_width"><?=__("Cantidad")?></td>
		                  <td class="estado_width"><?=__("Peso (lbs)")?></td>
		               </tr>
		               <?php
		                for( $j=0; $j<count($alert['AlertDetail']); $j++ ){
		               		if( $alert['AlertDetail'][$j]['status'] == 1 ){
		               			// Performing the calculation for the below task.
								$consignment_total_weight              = (int)$consignment_total_weight + (int)$alert['AlertDetail'][$j]['weight'];
								$consignment_total_declaration_rec_amt = $consignment_total_declaration_rec_amt + $alert['AlertDetail'][$j]['declaration_rec_amt'];
		               ?>
		               <tr class="info_tab">
		                  <td class="fecha_tab auto_fecha"><?php echo $this->Time->format($alert['AlertDetail'][$j]['modified'], '%m/%d/%Y');?></td>
		                  <td class="descrip_tion_tab left_align_tab_head"><?=$alert['AlertDetail'][$j]['body']?></td>
		                  <td class="for_declaration"><?php
		                  echo $this->Number->format($alert['AlertDetail'][$j]['declaration_rec_amt'], array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                )); ?>
                           </td>
		                  <td class="notas"><?=$alert['AlertDetail'][$j]['qty']?></td>
		                  <td class="estado"><?=$alert['AlertDetail'][$j]['weight']?></td>
		               </tr>
		               <tr class="info_tab">
		                  <td class="fecha_tab auto_fecha"><?=__("Notas")?>:</td>
		                  <td class="notas_field" colspan="3"><input type="text" name="" value="<?=$alert['AlertDetail'][$j]['admin_note']?>" readonly /></td>
		                  <td class="estado">
							<?php
							// if( $alert['AlertDetail'][$j]['id'] == 1 ){
							// 	echo $this->Form->postLink('despatched',
	      //                      	array('controller' => 'AlertDetails', 'action' => 'edit', $alert['AlertDetail'][$j]['id']),
	      //                      	array('escape' => false, 'class' => 'dispatcher_button' ),
	      //                      	__('Are you sure you want to despatch this item ?')
	      //                      	);
							// } else{
								echo $this->Form->postLink('Despachar',
	                           	array('controller' => 'AlertDetails', 'action' => 'edit', $alert['AlertDetail'][$j]['id']),
	                           	array('escape' => false, 'class' => 'dispatcher_button' ),
	                           	__('Are you sure you want to despatch this item ?')
	                           	);
							// }
	                        ?></td>
		               </tr>
		               <tr class="info_tab separation_row">
		                  <td colspan="5"></td>
		               </tr>
		               <?php
		               		}
		           		}
		           		?>
		            </table>
		         </div>
		      </div>
		      <div class="order_table_content_box">
		         <div class="order_box_content"><?=__("El peso mínimo es de 10 libras y máximo es de 110 libras. Si sus órdenes pesan menos de 10 libras , se le cobrará por 10 libras")?></div>
		         <div class="order_box_form">
		            <div class="form_section">
		               <div class="order_box_form_row clearfix">
		                  <label><?=__("Peso Total")?>:</label>
		                  <input type="text" value="<?=$consignment_total_weight?>" readonly />
		               </div>
		               <div class="order_box_form_row clearfix">
		                  <label><?=__("Precio por Lb")?>:</label>
		                  <input type="text" value="<?php if ($price_per_lb != ""){ echo $this->Number->format($price_per_lb, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));
                            }?>" readonly />
		               </div>
		               <div class="order_box_form_row clearfix">
		                  <label><?=__("Total Flete")?>:</label>
		                  <?php $consignment_total_fee = $consignment_total_weight * $price_per_lb; ?>
		                  <input type="text" value="<?=$this->Number->format($consignment_total_fee, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>" readonly />
		               </div>
		               <div class="order_box_form_row clearfix">
		                  <label><?=__("Declaration Recomendado")?>:</label>
		                  <input type="text" value="<?php
			                if($consignment_total_declaration_rec_amt != ""){
			                  	echo $this->Number->format($consignment_total_declaration_rec_amt, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));
                            }    ?>" readonly />
		               </div>
		               <?php
					      $inputDefaults = array(
					        'class' => 'form-horizontal',
					        'inputDefaults' => array(
					          'label' => false,
					          'div' => false,
					          'error' => array(
					          'attributes' => array('wrap' => 'span', 'class' => 'help-inline')
					          )
					        ),
					        'url' => array('controller' => 'alerts', 'action' => 'edit')
					      );
					      echo $this->Form->create('Alert', $inputDefaults);
					    ?>
					    <input type="hidden" name="data[Alert][id]" value="<?=$alert['Alert']['id']?>" />
			               <div class="order_box_form_row clearfix">
			                  <label><?=__("Declaration Del Cliente")?>:<br /><?=__("(In Dollor $ )")?></label>
			                  <input type="text" name="data[Alert][declaration_amt_client]" value="<?php
			                  if($declaration_amt_client != ""){
			                  	 echo $this->Number->format($declaration_amt_client, array(
	                                    'places' => 2,
	                                    'before' => '',
	                                    'escape' => false,
	                                    'decimals' => '.',
	                                    'thousands' => ','
	                                ));
	                            } ?>" />
			               </div>
			               <div class="order_box_form_row clearfix">
			                  <label>&nbsp;</label>
			                  <input type="submit" value="<?=__("EDITAR")?>" />
			               </div>
		               <?php echo $this->Form->end(); ?>
		            </div>
		            <div class="form_section">
		               <div class="order_box_form_row clearfix">
		                  <label><?=__("Impuesto")?>:</label>
		                  <input type="text" value="<?php
		                   if($tax != ""){
		                  	echo $this->Number->format($tax, array(
                                    'places' => 2,
                                    'before' => '',
                                    'after' => ' %',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));
							}
                            ?>" readonly />
		               </div>
		               <div class="order_box_form_row clearfix">
		                  <label><?=__("Impuesto Total")?>:</label>
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
		                  <input type="text" value="<?=$this->Number->format($tax_total, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>" readonly />
		               </div>
		               <div class="order_box_form_row imp_form_row clearfix normal_select">
		                  <label><?=__("Seguro")?>:</label>
		                  <input type="text" value="<?=$this->Number->format($insurance, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>" readonly />
		               </div>
		               <div class="form_note"><?=__("($5.00 por cada $100.00)")?></div>
		            </div>
		            <div class="form_section form_section_type_two">
		               <div class="order_box_form_row clearfix">
		                  <label><?=__("TOTAL (usd)")?>:</label>
		                  <?php
		                  $total_shipping_cost = $consignment_total_fee + $insurance + $tax_total;
		                  ?>
		                  <input type="text" value="<?=$this->Number->format($total_shipping_cost, array(
                                    'places' => 2,
                                    'before' => '$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>" readonly />
		               </div>
		               <div class="order_box_form_row clearfix">
		                  <label><?=__("TRM (Peso)")?>:</label>
		                  <input type="text" value="<?=$this->Number->format($currency['Currency']['amount'], array(
                                    'places' => 2,
                                    'before' => 'COL$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>" readonly />
		               </div>
		               <div class="order_box_form_row clearfix">
		                  <label><?=__("TOTAL (Colombia Peso)")?>:</label>
		                   <?php
		                  $total_shipping_cost_peso = $total_shipping_cost * $currency['Currency']['amount'];
		                  ?>
		                  <input type="text" value="<?=$this->Number->format($total_shipping_cost_peso, array(
                                    'places' => 2,
                                    'before' => 'COL$ ',
                                    'escape' => false,
                                    'decimals' => '.',
                                    'thousands' => ','
                                ));?>" readonly />
		               </div>
		            </div>
		         </div>
		      </div>
		      <?php
		  		}
		  	  ?>
		   </div>
		<?php } else{
			echo "
			<h1>".__('Alerts')."</h1>
			<p>".__('No record found..')."</p>";
		} ?>
		</div>
	</div>
</div>
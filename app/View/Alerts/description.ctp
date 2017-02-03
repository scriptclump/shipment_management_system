<div class="row">
	<div class="inner_content_container">
		<?php echo $this->element('left_sidebar'); ?>
		<div class="inner_content_right">
		<?php echo $this->Session->flash(); ?>
		    <div class="order_table_content_area">
		      <div class="order_table_content_box">
		         <div class="right_top_title">
		            <h3>
			            <?php echo __($status_str); ?>
		        	</h3>
		         </div>
		         <div class="right_btn custom">
		            <a class="btn blue" href="<?=BASE_URL?>alerts/description/pendiente"><?=__("MIS PEDIDOS PENDIENTES")?></a>
		            <a class="btn yellow" href="<?=BASE_URL?>alerts/description/recibidos"><?=__("MIS PEDIDOS RECIBIDOS")?></a>
		          <!--   <a class="btn green" href="<?=BASE_URL?>alerts/add">MIS ENVIOS Y PAGOS</a>
		            <a class="btn blue" href="<?=BASE_URL?>alerts/add"><?=__("CENTRO DE MENSAJES")?></a> -->
		            <a class="btn red" href="<?=BASE_URL?>alerts/add"><?=__("NUEVO ALERTA")?></a>
		         </div>
		         <div class="the_order_table">
		         	<?php if( count($alerts) > 0 ){ ?>
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
			               		$counter = 0;
			               		foreach ($alerts as $alert):
			               			if( count($alert['AlertDetail']) > 0 ) {
			               				$rowspan = count($alert['AlertDetail']);
			               			} else{
			               				$rowspan = 1;
			               			}
			               			$counter++;
			               			if( $counter == 1 && ( count($alert['AlertDetail']) > 0 ) ){
						                ?>
										<tr class="info_tab">
											<td class="fecha_tab" rowspan="<?=$rowspan?>">
											 <?php echo $this->Time->format($alert['Alert']['created'], '%m/%d/%Y');?>
											 <span class="order_time"><?php echo $this->Time->format($alert['Alert']['created'], '%H:%M:%p');?></span>
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
											<td class="estado" rowspan="<?=$rowspan?>">
											<?php
											if( $alert['Alert']['status'] == '1' ){
												echo __("Recibido");
											} else if( $alert['Alert']['status'] == '2' ){
												echo __("Consolidation");
											} else if( $alert['Alert']['status'] == '3' ){
												echo __("Pago Pendiente");
											} else if( $alert['Alert']['status'] == '4' ){
												echo __("Despachado");
											} else if( $alert['Alert']['status'] == '5' ){
												echo __("Entregado a la Transportadora");
											} else if( $alert['Alert']['status'] == '6' ){
												echo __("Entregado");
											} else{
												echo __("Pendiente");
											}
											?></td>
											<td rowspan="<?=$rowspan?>"><strong><a href="<?=BASE_URL?>alerts/edit/<?=$alert['Alert']['id']?>"><?=__('Vista')?></a></strong>
											<?php
											if( $alert['Alert']['status'] == 0 || $alert['Alert']['status'] == '' ){
												echo '<br /><br />';
												echo $this->Form->postLink(
			                                       	$this->Html->image('/front_end/images/cancel.png', array('alt' => '')),
			                                       	array('action' => 'delete', $alert['Alert']['id']),
			                                       	array('escape'=>false),
			                                       	__('Are you sure you want to delete this?')
			                                       	);
											}
	                                       ?>
											</td>
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
									</tr>
							<?php
										}
									}
									$counter = 0;
			              		endforeach;
			              	?>
			               <tr class="info_tab separation_row">
			                  <td colspan="6"></td>
			               </tr>
			            </table>
			        <?php } else{
						echo "<br />
						<h1>Alerts</h1>
						<p>No record found..</p>";
					} ?>
		         </div>
		      </div>
		    </div>

			<!-- <p>
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
			</div>-->
		</div>
	</div>
</div>
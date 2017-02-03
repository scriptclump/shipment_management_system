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

$received_items = 0;
for( $i = 0; $i <count($alert['AlertDetail']); $i++ ){
	if( $alert['AlertDetail'][$i]['status'] == 1 ){
		$received_items++;
	}
}
if( $received_items > 0 ){
    for( $j=0; $j<count($alert['AlertDetail']); $j++ ){
   		if( $alert['AlertDetail'][$j]['status'] == 1 ){
   			// Performing the calculation for the below task.
			$consignment_total_weight              = (int)$consignment_total_weight + (int)$alert['AlertDetail'][$j]['weight'];
			$consignment_total_declaration_rec_amt = $consignment_total_declaration_rec_amt + $alert['AlertDetail'][$j]['declaration_rec_amt'];
   		}
	}
	$tax_total = '';
	if($declaration_amt_client != ""){
		$tax_total = ($declaration_amt_client * $tax)/100;
		$insurance = ( ($declaration_amt_client + $tax_total) /100 ) * 5;
	} else{
		$tax_total = ($consignment_total_declaration_rec_amt * $tax)/100;
		$insurance = ( ($consignment_total_declaration_rec_amt + $tax_total) /100 ) * 5;
	}
	$total_shipping_cost = $consignment_total_fee + $insurance + $tax_total;
	$total_shipping_cost_peso = $total_shipping_cost * $currency['Currency']['amount'];
}
pr($alert);
?>
<div class="row">
	<div class="inner_content_container">
		<?php echo $this->element('left_sidebar'); ?>
		<div class="inner_content_right">
			<div class="content_right_top">
		        <div class="right_top_title"><h3>&nbsp;</h3></div>
		        <div class="right_btn">
		            <a class="btn green" href="#"><?=__("ENVIOS Y PAGOS")?></a>
		            <a class="btn blue" href="<?=BASE_URL?>alerts/shipping/<?=$alert['Alert']['id']?>"><?=__("Centro de mensajes")?></a>
		            <a class="btn red" href="<?=BASE_URL?>alerts/add"><?=__("nuevo ALERTA")?></a>
		        </div>
		    </div>
		    <div class="shipment_row">
		    	<div class="shipment_box">
		        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		              <tr class="top_row">
		                <td colspan="4">Tracking /Guia iCargoBox: <input name="" type="text" value="" readonly /></td>
		                <td colspan="3">Tracking /Guia National: <input name="" type="text" value="" readonly /></td>
		              </tr>
		              <tr class="head_row">
		                <td>Fecha</td>
		                <td>Peso (Lbs)</td>
		                <td>Costo por<br/>Libra</td>
		                <td>Declaracion<br/>Total USD</td>
		                <td>Impuesto Total</td>
		                <td>Seguro</td>
		                <td>Status</td>
		              </tr>
		              <tr>
		                <td>6/2/2014</td>
		                <td>10.5</td>
		                <td>$1.59</td>
		                <td>$100.00</td>
		                <td>$28.00</td>
		                <td>$100.00</td>
		                <td>Consolidation /<br/>Consolidacion</td>
		              </tr>
		              <tr class="head_row">
		                <td>Cargos Extras</td>
		                <td colspan="2">Desc. Cargos Extras</td>
		                <td>Total US $</td>
		                <td>Cambio (TRM)</td>
		                <td colspan="2">Total A Pagar en Pesos</td>
		              </tr>
		              <tr>
		                <td>$6.00</td>
		                <td colspan="2">Caja Grande</td>
		                <td>$49.70</td>
		                <td>$1933</td>
		                <td colspan="2" class="total">$96,070.10</td>
		              </tr>
		            </table>
		        </div>
		        <div class="shipment_middle">
		            <a href="#" class="btn disable">PAGAR / ALERTA DE PAGO</a>
		        </div>
		        <a href="javascript:void(0);" class="add_link click_btn">Contenidos</a>
		        <div class="description_box expand">
		        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		              <thead>
		              <tr>
		                <td width="80%">Descripción</td>
		                <td width="20%" align="center">Cantidad</td>
		              </tr>
		              </thead>
		              <tr>
		                <td>Apple IPAD</td>
		                <td align="center">1</td>
		              </tr>
		              <tr>
		                <td>Pair of Nikes Shoes - White Size 10</td>
		                <td align="center">1</td>
		              </tr>
		              <tr>
		                <td>Polo Shirts - Red / White</td>
		                <td align="center">2</td>
		              </tr>
		            </table>
		        </div>
		  	</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $(".expand").hide();
  $(".click_btn").click(function()
  {
    $(this).next(".expand").slideToggle(500);
  });
});
</script>
<div class="content_wrap">
  <div class="row">
    <?php
      echo $this->Session->flash();
      $inputDefaults = array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
          'label' => false,
          'div' => false,
          'error' => array(
          'attributes' => array('wrap' => 'span', 'class' => 'help-inline')
          )
        ),
        'url' => array('controller' => 'alerts', 'action' => 'add')
      );
      echo $this->Form->create('Alert', $inputDefaults);
    ?>
    <div class="inner_content_container">
    <div class="alert_box_example"><img alt="" src="<?=$this->webroot?>/front_end/images/example.png"></div>
    <div class="alert_box">
    <div class="alert_table">
    <table cellspacing="0" cellpadding="5" border="0" width="100%">
        <tbody><tr>
          <td align="center" width="5%">NÚM</td>
          <td align="center" width="58%">DescripciÓn</td>
          <td align="center" width="14%">Cantidad</td>
          <td width="2%">&nbsp;</td>
          <td align="center" width="18%">DECLARACIÓN U.S $</td>
          <td width="3%">&nbsp;</td>
        </tr>
        </tbody><tbody id="row_wrapper">
          <tr>
            <td><div class="num"><span>1</span></div></td>
            <td><input type="text" name="AlertDetail[0][body]" id="AlertDetailbody0" /></td>
            <td class="text_center"><input type="text" name="AlertDetail[0][qty]" id="AlertDetailqty0" /></td>
            <td>$</td>
            <td class="text_price"><input type="text" name="AlertDetail[0][declaration_amt]" id="AlertDetaildeclaration_amt0" /></td>
            <td><a href="#"><img width="12" height="13" alt="" src="<?php echo $this->webroot; ?>/front_end/images/cancel.png"></a></td>
          </tr>
          <tr>
            <td><div class="num"><span>2</span></div></td>
            <td><input type="text" name="AlertDetail[1][body]" id="AlertDetailbody1" /></td>
            <td class="text_center"><input type="text" name="AlertDetail[1][qty]" id="AlertDetailqty1" /></td>
            <td>$</td>
            <td class="text_price"><input type="text" name="AlertDetail[1][declaration_amt]" id="AlertDetaildeclaration_amt1" /></td>
            <td><a href="#"><img width="12" height="13" alt="" src="<?php echo $this->webroot; ?>/front_end/images/cancel.png"></a></td>
          </tr>
          <tr>
            <td><div class="num"><span>3</span></div></td>
            <td><input type="text" name="AlertDetail[2][body]" id="AlertDetailbody2" /></td>
            <td class="text_center"><input type="text" name="AlertDetail[2][qty]" id="AlertDetailqty2" /></td>
            <td>$</td>
            <td class="text_price"><input type="text" name="AlertDetail[2][declaration_amt]" id="AlertDetaildeclaration_amt2" /></td>
            <td><a href="#"><img width="12" height="13" alt="" src="<?php echo $this->webroot; ?>/front_end/images/cancel.png"></a></td>
          </tr>
          <tr>
            <td><div class="num"><span>4</span></div></td>
            <td><input type="text" name="AlertDetail[3][body]" id="AlertDetailbody3" /></td>
            <td class="text_center"><input type="text" name="AlertDetail[3][qty]" id="AlertDetailqty3" /></td>
            <td>$</td>
            <td class="text_price"><input type="text" name="AlertDetail[3][declaration_amt]" id="AlertDetaildeclaration_amt3" /></td>
            <td><a href="#"><img width="12" height="13" alt="" src="<?php echo $this->webroot; ?>/front_end/images/cancel.png"></a></td>
          </tr>
          <tr>
            <td><div class="num"><span>5</span></div></td>
            <td><input type="text" name="AlertDetail[4][body]" id="AlertDetailbody4" /></td>
            <td class="text_center"><input type="text" name="AlertDetail[4][qty]" id="AlertDetailqty4" /></td>
            <td>$</td>
            <td class="text_price"><input type="text" name="AlertDetail[4][declaration_amt]" id="AlertDetaildeclaration_amt4" /></td>
            <td><a href="#"><img width="12" height="13" alt="" src="<?php echo $this->webroot; ?>/front_end/images/cancel.png"></a></td>
          </tr>
        </tbody>
      </table>
    <a class="add_link" id="add_row" href="javascript:void(0);">Añadir Más</a>
    </div>
    <div class="alert_bottom">
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tbody><tr>
          <td width="52%">¿Tiene alguna instrucción especial para sus órdenes?</td>
          <td width="48%"><?php echo $this->Form->input('note', array('type' => 'textarea' )); ?></td>
        </tr>
        <tr>
          <td><a class="btn grey" href="<?=BASE_URL?>users/my_account">regresar</a></td>
          <td><input type="submit" value="COMPLETAR" name=""></td>
        </tr>
      </tbody></table>
    </div>
    </div>
    </div>
    <?php echo $this->Form->end(); ?>
  </div>
</div>
<script>
$(document).ready(function(){
	var index = 5;
  var item_id = 4;
	$("#add_row").click(function(){
    	index++;
      item_id++;
		$("#row_wrapper").append('<tr><td><div class="num"><span>'+ index +'</span></div></td><td><input type="text" name="AlertDetail['+ item_id +'][body]" id="AlertDetailbody'+ item_id +'" /></td><td class="text_center"><input type="text" name="AlertDetail['+ item_id +'][qty]" id="qty'+ item_id +'" /></td><td>$</td><td class="text_price"><input type="text" name="AlertDetail['+ item_id +'][declaration_amt]" id="AlertDetaildeclaration_amt'+ item_id +'" /></td><td><a href="javascript:void(0);" class="cancel_row"><img src="<?php echo $this->webroot; ?>/front_end/images/cancel.png" width="12" height="13" alt=""></a></td></tr>');
    $("#row_wrapper").on('click','.cancel_row',function(){
        $(this).parent().parent().remove();
        // alert(index);
        // index = index - 1;
    });
	});
});
</script>
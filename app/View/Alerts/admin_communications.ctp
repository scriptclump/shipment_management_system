<div class="page-head">
  <ol class="breadcrumb">
    <li><i class="fa fa-bars"></i>&nbsp;<a href="/cakephp/icargobox/admin/alerts">List Alerts</a></li>
    <li><i class="fa fa-pencil-square-o"></i>&nbsp;<a href="/cakephp/icargobox/admin/cities/edit/1">Edit Alert</a> </li>
  </ol>
</div>
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
      'url' => array('controller' => 'Communications', 'action' => 'add')
    );
    echo $this->Form->create('Communication', $inputDefaults);
    echo $this->Form->hidden('from_id', array('value' => 2));
    echo $this->Form->hidden('to_id', array('value' => $this->params['pass'][1]));
    echo $this->Form->hidden('alert_id', array('value' => $this->params['pass'][0]));
    echo $this->Form->input('message', array('id' => 'message', 'label' => array('class' => 'col-sm-2 control-label', 'text' => 'Message')) );
    ?>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
      <?php
    echo $this->Form->button('Post Message', array(
        'type' => 'submit',
        'class' => 'btn btn-primary',
        'data-dismiss'  => 'modal'
    ));
    // echo $this->Form->button('Reset', array(
    //     'type' => 'reset',
    //     'class' => 'btn btn-default',
    //     'data-dismiss'  => 'modal'
    // ));
    ?>
  </div>
</div>
<ul class="cbp_tmtimeline">
  <?php
  for($i=0; $i<count($data); $i++){
    $row_class = 'user';
    if( $data[$i]['Communication']['from_id'] == 2 ){
      $row_class = "admin";
    }
  ?>
    <li class="<?=$row_class?>">
        <time datetime="2013-04-10 18:30" class="cbp_tmtime"><span><?php echo $this->Time->format($data[$i]['Communication']['created'], '%d-%m-%Y', '')?></span> <span><?php echo $this->Time->format($data[$i]['Communication']['created'], '%H:%M', '')?></span></time>
        <div class="cbp_tmicon cbp_tmicon-phone <?=$row_class?>"></div>
        <div class="cbp_tmlabel">
          <h2><?=$data[$i]['Profile']['fname']?>&nbsp;<?=$data[$i]['Profile']['lname']?>
            <?php if($data[$i]['Communication']['from_id'] != 2) {?>
              <small style="color:#FFFFFF;">( <?=__('Cassillero #')?> <?=$data[$i]['Communication']['from_id']?> )</small>
            <?php } ?>
          </h2>
          <p><?=nl2br($data[$i]['Communication']['message'])?>
          <?php if($data[$i]['Communication']['from_id'] != 2 && $data[$i]['Communication']['ip_address'] != "") {?>
          <br /><br />Sent from IP Address: <?=$data[$i]['Communication']['ip_address']?> </p>
          <?php } ?>
        </div>
    </li>
  <?php
  }
  ?>
      </ul>



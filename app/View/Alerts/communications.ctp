<div class="row">
  <div class="inner_content_container">
    <h1>Mensajes</h1>
    <?php echo $this->Session->flash(); ?>
      <div class="chat_box">
          <div class="chat_box_content">
                 <?php
                  for($i=0; $i<count($data); $i++){
                    $row_class = 'user';
                    if( $data[$i]['Communication']['from_id'] == 2 ){
                      $row_class = "admin";
                    }
                  ?>
                  <div class="<?=$row_class?>_row">
                    <div class="<?=$row_class?>"><?=nl2br($this->Text->autoLink($data[$i]['Communication']['message'], array('target '=> '_blank')))?></div>
                    <p>Sent on <?php echo $this->Time->format($data[$i]['Communication']['created'], '%d-%m-%Y %H:%M', '')?></p>
                  </div>
                <?php
                  }
                ?>
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
    echo $this->Form->hidden('from_id', array('value' => $_SESSION['Auth']['User']['id'] ));
    echo $this->Form->hidden('alert_id', array('value' => $this->params['pass'][0]));
    ?>
            <div class="chat_box_bottom">
              <?php echo $this->Form->input('message', array('id' => 'message', 'label' => array('class' => 'col-sm-2 control-label', 'text' => '', 'placeholder' => 'Enter your comment here...')) ); ?>
                 <?php
                  echo $this->Form->button('Send', array(
                      'type' => 'submit'
                  ));
                  ?>
            </div>
      </div>
    </div>
</div>
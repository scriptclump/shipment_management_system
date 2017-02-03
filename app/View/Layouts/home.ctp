<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'iCargoBox');
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
<meta charset="utf-8" />
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Welcome to iCargoBox</title>

<?php
echo $this->Html->meta('icon');
echo $this->fetch('meta');
if( isset($meta_key) ){
    echo $this->Html->meta( 'keywords', $meta_key);
} else {
    echo $this->Html->meta( 'keywords', 'Welcome to ICargoBox.');
}
if( isset($meta_desc) ){
    echo $this->Html->meta( 'description', $meta_desc);
} else{
    echo $this->Html->meta( 'description', 'Welcome to ICargoBox.');
}

echo $this->Html->css(
    array(
        '/front_end/css/style',
        '/front_end/css/font-awesome',
        '/front_end/css/jquery.bxslider',
        '/front_end/css/jquery.fancybox',
        '/front_end/jquery_validate/css/screen'
        )
    );
echo $this->Html->script(
    array(
        '/front_end/js/jquery-2.1.1.min',
        '/front_end/js/jquery.bxslider',
        '/front_end/js/selectivizr',
        '/front_end/js/jquery.fancybox',
        '/front_end/js/theme-functions',
        '/front_end/jquery_validate/jquery.validate.min',
        '/front_end/jquery_validate/localization/messages_es'
        )
    );
?>
<script type="text/javascript">
/*=========== fancyBox ===============*/
$(document).ready(function() {
    $('.fancybox').fancybox();
});
</script>
<!-- IE Fix for HTML5 Tags -->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- css3-mediaqueries.js for IE8 or older -->
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
</head>

<body>
<?php echo $this->element('header'); ?>
<?php echo $this->element('banner'); ?>
<!-- content start here -->
<div class="content_wrap">
    <div class="row">
        <div class="content_container">
            <div class="content_left">
                <?php $testimonials = $this->requestAction('testimonials/display/');
                    if ( isset($testimonials) && ( count($testimonials) > 0 ) ) : ?>
                        <div class="testimonials_box">
                            <ul class="testimonials_slider">
                                <?php foreach($testimonials as $testimonial): ?>
                                    <li><?php echo $testimonial['Testimonial']['body']; ?><span class="ddd"></span></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                <?php endif; ?>
                <?php $recomended_stores = $this->requestAction('RecomendedStores/display/');
                 if ( isset($recomended_stores) && ( count($recomended_stores) > 0 ) ) : ?>
                        <div class="carousel_area">
                            <h3>Tiendas Recomendadas</h3>
                            <div class="carousel_box">
                                <ul class="carousel_slider">
                                    <?php $i=0;
                                    foreach($recomended_stores as $recomended_store): ?>
                                        <li><?php if($recomended_stores[$i]['RecomendedStore']['store_img'] != "") { ?>
                                                <a href="<?=$recomended_stores[$i]['RecomendedStore']['store_url']?>" target="_blank">
                                                <?php echo $this->Html->image('/'.$recomended_stores[$i]['RecomendedStore']['store_img'], array('alt' => h($recomended_stores[$i]['RecomendedStore']['title'])  )); ?>
                                                </a>
                                               <?php
                                               } else {
                                                   echo 'No Image';
                                               } ?></li>
                                    <?php $i++; endforeach; ?>
                                </ul>
                            </div>
                        </div>
                <?php endif;
                    ?>
                <div class="main_content">
                    <?php
                    echo $this->Session->flash();
                    echo $this->fetch('content'); ?>
                </div>
            </div>
           <?php echo $this->element('right_sidebar'); ?>
        </div>
    </div>
</div>
<!-- content end here -->
<?php echo $this->element('footer'); ?>

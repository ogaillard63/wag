<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 17:16:52
         compiled from "C:\xampp\htdocs\wag\out\ads_manager\tpl\main.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2391754d397744b8056-54949005%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b49b9481b65df364fcb35b3bb8da5a8f5dae11c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out\\ads_manager\\tpl\\main.tpl.html',
      1 => 1419107443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2391754d397744b8056-54949005',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tpl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d3977458af90_03079712',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d3977458af90_03079712')) {function content_54d3977458af90_03079712($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config(((string)$_SESSION['filePathLang']), $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WebApp Generator</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Fonts from Font Awsome -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/font-awesome-4.2.0/css/font-awesome.min.css">
    <!-- CSS Animate -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/css/animate.css">
    <!-- Custom styles for this theme -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/css/main.css">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/js/html5shiv.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/js/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
    <!--Global JS-->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/js/jquery-1.10.2.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/plugins/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/js/application.js"><?php echo '</script'; ?>
>
    </head>
    <body class="animated fadeIn">
    <section id="container">
	<?php echo $_smarty_tpl->getSubTemplate ("header.tpl.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <!--sidebar start-->
		<?php echo $_smarty_tpl->getSubTemplate ("sidebar_left.tpl.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

         <!--sidebar end-->
         <!--main content start-->
         <section class="main-content-wrapper">
            <section id="main-content">
            <?php echo $_smarty_tpl->getSubTemplate ("breadcrumbs.tpl.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
   
            <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['content']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            </section>
         </section>
         <!--main content end-->
         <!--sidebar right start-->
		<?php echo $_smarty_tpl->getSubTemplate ("sidebar_right.tpl.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <!--sidebar right end-->
    </section>
    </body>
</html><?php }} ?>

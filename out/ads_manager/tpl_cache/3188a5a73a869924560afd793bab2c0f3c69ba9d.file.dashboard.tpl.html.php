<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 15:27:05
         compiled from "C:\xampp\htdocs\wag\out2\tpl\misc\dashboard.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:669354d37db9920672-10562329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3188a5a73a869924560afd793bab2c0f3c69ba9d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out2\\tpl\\misc\\dashboard.tpl.html',
      1 => 1419107443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '669354d37db9920672-10562329',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tpl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d37db9933ef2_13244625',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d37db9933ef2_13244625')) {function content_54d37db9933ef2_13244625($_smarty_tpl) {?><div class="row">
	<div class="col-md-4 col-sm-8">
		<div class="dashboard-tile detail tile-turquoise">
			<div class="content">
				<h1 class="text-left timer" data-from="0" data-to="180" data-speed="2500">+ 3 380,72 €</h1>
				<p>Revenus du mois</p>
			</div>
			<div class="icon"><i class="fa fa-users"></i>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-8">
		<div class="dashboard-tile detail tile-red">
			<div class="content">
				<h1 class="text-left timer" data-to="105" data-speed="2500">- 2 305,25 €</h1>
				<p>Dépenses du mois</p>
			</div>
			<div class="icon"><i class="fa fa-bar-chart-o"></i>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-sm-4">
		<div class="dashboard-tile detail tile-purple">
			<div class="content">
				<h1 class="text-left timer" data-from="0" data-to="56" data-speed="2500">56</h1>
				<p>Opérations non catégorisées</p>
			</div>
			<div class="icon"><i class="fa fa-envelope"></i>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-sm-4">
		<div class="dashboard-tile detail tile-blue">
			<div class="content">
				<h1 class="text-left timer" data-from="0" data-to="38" data-speed="2500">38</h1>
				<p>Opérations non pointées</p>
			</div>
			<div class="icon"><i class="fa fa fa-envelope"></i>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Evolution du solde</h3>
				<div class="actions pull-right">
					<i class="fa fa-chevron-down"></i>
					<i class="fa fa-times"></i>
				</div>
			</div>
			<div class="panel-body">
				<div id="sales-chart" style="height: 450px; padding: 0px; position: relative;">
					<canvas class="flot-base" width="472" height="250" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 472px; height: 250px;"></canvas>
					<div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
					<div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"></div>
					<div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"></div>
					</div>
					<canvas class="flot-overlay" width="472" height="250" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 472px; height: 250px;"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
 <!-- FlotCharts  -->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/plugins/flot/js/jquery.flot.min.js"><?php echo '</script'; ?>
>
<!--<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.resize.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.canvas.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.image.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.categories.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.crosshair.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.errorbars.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.fillbetween.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.navigate.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.pie.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.selection.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.stack.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.symbol.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.threshold.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.colorhelpers.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/plugins/flot/js/jquery.flot.time.min.js"><?php echo '</script'; ?>
>-->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/plugins/flot/js/jquery.flot.example.js"><?php echo '</script'; ?>
><?php }} ?>

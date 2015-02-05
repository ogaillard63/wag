<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 16:37:08
         compiled from "C:\xampp\htdocs\wag\out\ads_manager\tpl\liens\edit.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2467154d38e24b88d23-19261155%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8acc01d0005cef941e314d72c80b435c7e5b350' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out\\ads_manager\\tpl\\liens\\edit.tpl.html',
      1 => 1423150365,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2467154d38e24b88d23-19261155',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lien' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d38e24c771e3_27497682',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d38e24c771e3_27497682')) {function content_54d38e24c771e3_27497682($_smarty_tpl) {?><div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo ucfirst($_smarty_tpl->getConfigVariable('modification'));?>
 <?php echo $_smarty_tpl->getConfigVariable('of');?>
 <?php echo $_smarty_tpl->getConfigVariable('liens');?>
</h3>
				<div class="actions pull-right">
					<i class="fa fa-chevron-down"></i>
					<i class="fa fa-times"></i>
				</div>
			</div>
			<div class="panel-body">
				<form role="form" name="form_param" method="post" action="liens.php">
					<input name="id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['lien']->value->id;?>
" />
					<input name="action" type="hidden" value="save" />
								 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('rub_id');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('rub_id'));?>
</label>
						<input class="form-control" type="text" name="rub_id" value="<?php echo $_smarty_tpl->tpl_vars['lien']->value->rub_id;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('titre');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('titre'));?>
</label>
						<input class="form-control" type="text" name="titre" value="<?php echo $_smarty_tpl->tpl_vars['lien']->value->titre;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('url');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('url'));?>
</label>
						<input class="form-control" type="text" name="url" value="<?php echo $_smarty_tpl->tpl_vars['lien']->value->url;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('descriptif');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('descriptif'));?>
</label>
						<input class="form-control" type="text" name="descriptif" value="<?php echo $_smarty_tpl->tpl_vars['lien']->value->descriptif;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('etat');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('etat'));?>
</label>
						<input class="form-control" type="text" name="etat" value="<?php echo $_smarty_tpl->tpl_vars['lien']->value->etat;?>
" />
					</div>
			<div align="right">
				<button type="cancel" class="btn btn-default"><?php echo ucfirst($_smarty_tpl->getConfigVariable('cancel'));?>
</button>
				<button type="submit" class="btn btn-primary"><?php echo ucfirst($_smarty_tpl->getConfigVariable('save'));?>
</button>
			</div>
		</form>
	</div>
</div>
</div>
</div><?php }} ?>

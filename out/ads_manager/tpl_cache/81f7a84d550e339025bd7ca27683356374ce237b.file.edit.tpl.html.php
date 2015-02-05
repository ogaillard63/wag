<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 17:15:57
         compiled from "C:\xampp\htdocs\wag\out\ads_manager\tpl\articles\edit.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2103354d3973d1cd516-99397554%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81f7a84d550e339025bd7ca27683356374ce237b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out\\ads_manager\\tpl\\articles\\edit.tpl.html',
      1 => 1423152955,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2103354d3973d1cd516-99397554',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'article' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d3973d2ea7d3_43953855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d3973d2ea7d3_43953855')) {function content_54d3973d2ea7d3_43953855($_smarty_tpl) {?><div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php if ($_smarty_tpl->tpl_vars['article']->value->id>0) {
echo ucfirst($_smarty_tpl->getConfigVariable('edit_a_article'));
} else {
echo ucfirst($_smarty_tpl->getConfigVariable('add_a_article'));
}?></h3>
				<div class="actions pull-right">
					<i class="fa fa-chevron-down"></i>
					<i class="fa fa-times"></i>
				</div>
			</div>
			<div class="panel-body">
				<form role="form" name="form_param" method="post" action="articles.php">
					<input name="id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['article']->value->id;?>
" />
					<input name="action" type="hidden" value="save" />
								 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('creation');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('creation'));?>
</label>
						<input class="form-control" type="text" name="creation" value="<?php echo $_smarty_tpl->tpl_vars['article']->value->creation;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('publication');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('publication'));?>
</label>
						<input class="form-control" type="text" name="publication" value="<?php echo $_smarty_tpl->tpl_vars['article']->value->publication;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('titre');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('titre'));?>
</label>
						<input class="form-control" type="text" name="titre" value="<?php echo $_smarty_tpl->tpl_vars['article']->value->titre;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('lien');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('lien'));?>
</label>
						<input class="form-control" type="text" name="lien" value="<?php echo $_smarty_tpl->tpl_vars['article']->value->lien;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('texte');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('texte'));?>
</label>
						<input class="form-control" type="text" name="texte" value="<?php echo $_smarty_tpl->tpl_vars['article']->value->texte;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('flux_id');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('flux_id'));?>
</label>
						<input class="form-control" type="text" name="flux_id" value="<?php echo $_smarty_tpl->tpl_vars['article']->value->flux_id;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('vus');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('vus'));?>
</label>
						<input class="form-control" type="text" name="vus" value="<?php echo $_smarty_tpl->tpl_vars['article']->value->vus;?>
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

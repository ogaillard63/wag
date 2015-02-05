<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 15:49:44
         compiled from "C:\xampp\htdocs\wag\out\ads_manager\tpl\annonces\edit.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:526154d38308502262-90293597%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6ce3b1a43c5d19882a92bf5e76610daeae1ed1d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out\\ads_manager\\tpl\\annonces\\edit.tpl.html',
      1 => 1423147080,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '526154d38308502262-90293597',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'annonce' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d383087cd090_88687851',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d383087cd090_88687851')) {function content_54d383087cd090_88687851($_smarty_tpl) {?><div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo ucfirst($_smarty_tpl->getConfigVariable('modification'));?>
 <?php echo $_smarty_tpl->getConfigVariable('of');?>
 <?php echo $_smarty_tpl->getConfigVariable('annonces');?>
</h3>
				<div class="actions pull-right">
					<i class="fa fa-chevron-down"></i>
					<i class="fa fa-times"></i>
				</div>
			</div>
			<div class="panel-body">
				<form role="form" name="form_param" method="post" action="annonces.php">
					<input name="id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->id;?>
" />
					<input name="action" type="hidden" value="save" />
								 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('clef');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('clef'));?>
</label>
						<input class="form-control" type="text" name="clef" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->clef;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('creation');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('creation'));?>
</label>
						<input class="form-control" type="text" name="creation" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->creation;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('designation');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('designation'));?>
</label>
						<input class="form-control" type="text" name="designation" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->designation;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('designation_url');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('designation_url'));?>
</label>
						<input class="form-control" type="text" name="designation_url" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->designation_url;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('description');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('description'));?>
</label>
						<input class="form-control" type="text" name="description" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->description;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('datasheet');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('datasheet'));?>
</label>
						<input class="form-control" type="text" name="datasheet" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->datasheet;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('stock');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('stock'));?>
</label>
						<input class="form-control" type="text" name="stock" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->stock;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('frais');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('frais'));?>
</label>
						<input class="form-control" type="text" name="frais" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->frais;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('paiement');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('paiement'));?>
</label>
						<input class="form-control" type="text" name="paiement" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->paiement;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('photo');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('photo'));?>
</label>
						<input class="form-control" type="text" name="photo" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->photo;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('prix');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('prix'));?>
</label>
						<input class="form-control" type="text" name="prix" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->prix;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('vendeur');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('vendeur'));?>
</label>
						<input class="form-control" type="text" name="vendeur" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->vendeur;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('vendeur_id');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('vendeur_id'));?>
</label>
						<input class="form-control" type="text" name="vendeur_id" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->vendeur_id;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('telephone');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('telephone'));?>
</label>
						<input class="form-control" type="text" name="telephone" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->telephone;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('tel_cache');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('tel_cache'));?>
</label>
						<input class="form-control" type="text" name="tel_cache" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->tel_cache;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('email');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('email'));?>
</label>
						<input class="form-control" type="text" name="email" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->email;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('mdp');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('mdp'));?>
</label>
						<input class="form-control" type="text" name="mdp" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->mdp;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('signal');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('signal'));?>
</label>
						<input class="form-control" type="text" name="signal" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->signal;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('flag_top');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('flag_top'));?>
</label>
						<input class="form-control" type="text" name="flag_top" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->flag_top;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('rubrique_id');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('rubrique_id'));?>
</label>
						<input class="form-control" type="text" name="rubrique_id" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->rubrique_id;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('nb_clic');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('nb_clic'));?>
</label>
						<input class="form-control" type="text" name="nb_clic" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->nb_clic;?>
" />
					</div>
		 <div class="form-group">
						<label for="<?php echo $_smarty_tpl->getConfigVariable('etat');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('etat'));?>
</label>
						<input class="form-control" type="text" name="etat" value="<?php echo $_smarty_tpl->tpl_vars['annonce']->value->etat;?>
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

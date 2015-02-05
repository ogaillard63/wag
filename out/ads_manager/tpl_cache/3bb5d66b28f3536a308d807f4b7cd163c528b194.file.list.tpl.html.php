<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 16:35:30
         compiled from "C:\xampp\htdocs\wag\out\ads_manager\tpl\annonces\list.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:915354d38dc2596d65-79687267%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3bb5d66b28f3536a308d807f4b7cd163c528b194' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out\\ads_manager\\tpl\\annonces\\list.tpl.html',
      1 => 1423147729,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '915354d38dc2596d65-79687267',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'annonces' => 0,
    'annonce' => 0,
    'btn_nav' => 0,
    'btn' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d38dc27f83f0_23442330',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d38dc27f83f0_23442330')) {function content_54d38dc27f83f0_23442330($_smarty_tpl) {?><div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo ucfirst($_smarty_tpl->getConfigVariable('list'));?>
 <?php echo $_smarty_tpl->getConfigVariable('of_');?>
 <?php echo $_smarty_tpl->getConfigVariable('annonces');?>
</h3>
				<div class="actions pull-right">
					<i class="fa fa-chevron-down"></i>
					<i class="fa fa-times"></i>
				</div>
			</div>
			<div class="panel-body">
				<?php if (!empty($_smarty_tpl->tpl_vars['annonces']->value)) {?><table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('creation'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('designation'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('prix'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('vendeur'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('vendeur_id'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('signal'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('flag_top'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('rubrique_id'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('etat'));?>
</th>
						<th colspan="2"><?php echo ucfirst($_smarty_tpl->getConfigVariable('actions'));?>
</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['annonce'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['annonce']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['annonces']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['annonce']->key => $_smarty_tpl->tpl_vars['annonce']->value) {
$_smarty_tpl->tpl_vars['annonce']->_loop = true;
?>
					<tr>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['annonce']->value->creation;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['annonce']->value->designation;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['annonce']->value->prix;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['annonce']->value->vendeur;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['annonce']->value->vendeur_id;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['annonce']->value->signal;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['annonce']->value->flag_top;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['annonce']->value->rubrique_id;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['annonce']->value->etat;?>
</td>
						<td width="1%" align="center" nowrap="nowrap"><a class="btn btn-sm btn-success" href="annonces.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['annonce']->value->id;?>
" title="<?php echo ucfirst($_smarty_tpl->getConfigVariable('edit'));?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('annonce');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('edit'));?>
</a></td>
						<td width="1%" align="center" nowrap="nowrap"><a class="btn btn-sm btn-danger" href="annonces.php?action=delete&id=<?php echo $_smarty_tpl->tpl_vars['annonce']->value->id;?>
" title="<?php echo ucfirst($_smarty_tpl->getConfigVariable('delete'));?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('annonce');?>
"onclick="return confirm('<?php echo ucfirst($_smarty_tpl->getConfigVariable('do_you_really_want_to'));?>
 <?php echo $_smarty_tpl->getConfigVariable('delete');?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('annonce');?>
 ?')"><?php echo ucfirst($_smarty_tpl->getConfigVariable('delete'));?>
</a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<ul class="pagination pull-left">
				<?php if (!empty($_smarty_tpl->tpl_vars['btn_nav']->value)) {?> <?php  $_smarty_tpl->tpl_vars['btn'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['btn']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['btn_nav']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['btn']->key => $_smarty_tpl->tpl_vars['btn']->value) {
$_smarty_tpl->tpl_vars['btn']->_loop = true;
?>
				<li<?php if ($_smarty_tpl->tpl_vars['btn']->value['active']) {?> class="active" <?php }?>><a href="annonces.php?<?php echo $_smarty_tpl->tpl_vars['btn']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['btn']->value['label'];?>
</a>
					</li>
					<?php }
}?>
			</ul>
			<?php } else { ?><h4><?php echo $_smarty_tpl->getConfigVariable('empty_list');?>
</h4><?php }?>
			<div align="right">
				<a href="annonces.php?action=add" class="btn btn-primary"><?php echo ucfirst($_smarty_tpl->getConfigVariable('add'));?>
 <?php echo $_smarty_tpl->getConfigVariable('a');?>
 <?php echo $_smarty_tpl->getConfigVariable('annonce');?>
</a>
			</div>
		</div>
	</div>
</div>
</div><?php }} ?>

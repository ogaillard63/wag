<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 16:41:39
         compiled from "C:\xampp\htdocs\wag\out\ads_manager\tpl\taches\list.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1156254d38f33ecadb9-56861848%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e08ddd7ee89dab33e0135a2b91a93b9da1ab7c0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out\\ads_manager\\tpl\\taches\\list.tpl.html',
      1 => 1423150896,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1156254d38f33ecadb9-56861848',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'taches' => 0,
    'tache' => 0,
    'btn_nav' => 0,
    'btn' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d38f340ec180_30238563',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d38f340ec180_30238563')) {function content_54d38f340ec180_30238563($_smarty_tpl) {?><div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo ucfirst($_smarty_tpl->getConfigVariable('list'));?>
 <?php echo $_smarty_tpl->getConfigVariable('of_');?>
 <?php echo $_smarty_tpl->getConfigVariable('taches');?>
</h3>
				<div class="actions pull-right">
					<i class="fa fa-chevron-down"></i>
					<i class="fa fa-times"></i>
				</div>
			</div>
			<div class="panel-body">
				<?php if (!empty($_smarty_tpl->tpl_vars['taches']->value)) {?><table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('jour'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('tache'));?>
</th>
						<th colspan="2"><?php echo ucfirst($_smarty_tpl->getConfigVariable('actions'));?>
</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['tache'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tache']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['taches']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tache']->key => $_smarty_tpl->tpl_vars['tache']->value) {
$_smarty_tpl->tpl_vars['tache']->_loop = true;
?>
					<tr>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['tache']->value->jour;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['tache']->value->tache;?>
</td>
						<td width="1%" align="center" nowrap="nowrap"><a class="btn btn-sm btn-success" href="taches.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['tache']->value->id;?>
" title="<?php echo ucfirst($_smarty_tpl->getConfigVariable('edit'));?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('tache');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('edit'));?>
</a></td>
						<td width="1%" align="center" nowrap="nowrap"><a class="btn btn-sm btn-danger" href="taches.php?action=delete&id=<?php echo $_smarty_tpl->tpl_vars['tache']->value->id;?>
" title="<?php echo ucfirst($_smarty_tpl->getConfigVariable('delete'));?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('tache');?>
"onclick="return confirm('<?php echo ucfirst($_smarty_tpl->getConfigVariable('do_you_really_want_to'));?>
 <?php echo $_smarty_tpl->getConfigVariable('delete');?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('tache');?>
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
				<li<?php if ($_smarty_tpl->tpl_vars['btn']->value['active']) {?> class="active" <?php }?>><a href="taches.php?<?php echo $_smarty_tpl->tpl_vars['btn']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['btn']->value['label'];?>
</a>
					</li>
					<?php }
}?>
			</ul>
			<?php } else { ?><h4><?php echo $_smarty_tpl->getConfigVariable('empty_list');?>
</h4><?php }?>
			<div align="right">
				<a href="taches.php?action=add" class="btn btn-primary"><?php echo ucfirst($_smarty_tpl->getConfigVariable('add'));?>
 <?php echo $_smarty_tpl->getConfigVariable('a');?>
 <?php echo $_smarty_tpl->getConfigVariable('tache');?>
</a>
			</div>
		</div>
	</div>
</div>
</div><?php }} ?>

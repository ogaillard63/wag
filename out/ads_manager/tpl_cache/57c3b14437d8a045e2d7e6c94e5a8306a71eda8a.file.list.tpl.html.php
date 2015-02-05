<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 15:27:07
         compiled from "C:\xampp\htdocs\wag\out2\tpl\accounts\list.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:755954d37dbb8e6408-38861193%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57c3b14437d8a045e2d7e6c94e5a8306a71eda8a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out2\\tpl\\accounts\\list.tpl.html',
      1 => 1419107443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '755954d37dbb8e6408-38861193',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'accounts' => 0,
    'account' => 0,
    'btn_infos' => 0,
    'btn' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d37dbbad65f7_19179174',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d37dbbad65f7_19179174')) {function content_54d37dbbad65f7_19179174($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include 'C:\\xampp\\htdocs\\wag\\vendor\\smarty\\plugins\\function.cycle.php';
?><div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo ucfirst($_smarty_tpl->getConfigVariable('list'));?>
 <?php echo $_smarty_tpl->getConfigVariable('of_');?>
 <?php echo $_smarty_tpl->getConfigVariable('accounts');?>
</h3>
				<div class="actions pull-right">
					<i class="fa fa-chevron-down"></i>
					<i class="fa fa-times"></i>
				</div>
			</div>
			<div class="panel-body">
				<?php if (!empty($_smarty_tpl->tpl_vars['accounts']->value)) {?><table class="table table-hover table-striped">
					<thead>
						<tr>
							<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('bank'));?>
</th>
							<!--<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('user_id'));?>
</th>-->
							<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('name'));?>
</th>
							<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('account_number'));?>
</th>
							<!--<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('sort'));?>
</th>-->
							<!--<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('state'));?>
</th>-->
							<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('initial_balance'));?>
</th>
							<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('current_balance'));?>
</th>
							<th colspan="2"><?php echo ucfirst($_smarty_tpl->getConfigVariable('actions'));?>
</th>
						</tr>
					</thead>
					<tbody>
						<?php  $_smarty_tpl->tpl_vars['account'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['account']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['accounts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['account']->key => $_smarty_tpl->tpl_vars['account']->value) {
$_smarty_tpl->tpl_vars['account']->_loop = true;
?>
						<tr class="<?php echo smarty_function_cycle(array('values'=>"odd,even"),$_smarty_tpl);?>
">
							<td align="left"><?php echo $_smarty_tpl->tpl_vars['account']->value->bank->name;?>
</td>
							<!--<td align="left"><?php echo $_smarty_tpl->tpl_vars['account']->value->user_id;?>
</td>-->
							<td align="left"><?php echo $_smarty_tpl->tpl_vars['account']->value->name;?>
</td>
							<td align="right"><?php echo $_smarty_tpl->tpl_vars['account']->value->account_number;?>
</td>
							<!--<td align="left"><?php echo $_smarty_tpl->tpl_vars['account']->value->sort;?>
</td>-->
							<!--<td align="left"><?php echo $_smarty_tpl->tpl_vars['account']->value->state;?>
</td>-->
							<td align="right"><strong><?php echo $_smarty_tpl->tpl_vars['account']->value->initial_balance;?>
 &euro;</strong></td>
							<td align="right"><strong><?php echo $_smarty_tpl->tpl_vars['account']->value->current_balance;?>
 &euro;</strong></td>
							<td width="1%" align="center" nowrap="nowrap"><a class="btn btn-sm btn-success" href="accounts.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['account']->value->id;?>
" title="<?php echo ucfirst($_smarty_tpl->getConfigVariable('edit'));?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('account');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('edit'));?>
</a></td>
							<td width="1%" align="center" nowrap="nowrap"><a class="btn btn-sm btn-danger" href="accounts.php?action=delete&id=<?php echo $_smarty_tpl->tpl_vars['account']->value->id;?>
" title="<?php echo ucfirst($_smarty_tpl->getConfigVariable('delete'));?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('account');?>
"onclick="return confirm('<?php echo ucfirst($_smarty_tpl->getConfigVariable('do_you_really_want_to'));?>
 <?php echo $_smarty_tpl->getConfigVariable('delete');?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('account');?>
 ?')"><?php echo ucfirst($_smarty_tpl->getConfigVariable('delete'));?>
</a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<ul class="pagination pull-left">
					<?php if (!empty($_smarty_tpl->tpl_vars['btn_infos']->value)) {?> <?php  $_smarty_tpl->tpl_vars['btn'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['btn']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['btn_infos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['btn']->key => $_smarty_tpl->tpl_vars['btn']->value) {
$_smarty_tpl->tpl_vars['btn']->_loop = true;
?>
					<li<?php if ($_smarty_tpl->tpl_vars['btn']->value['active']) {?> class="active" <?php }?>><a href="accounts.php?<?php echo $_smarty_tpl->tpl_vars['btn']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['btn']->value['label'];?>
</a>
						</li>
						<?php }
}?>
				</ul>
				<?php } else { ?><h4><?php echo $_smarty_tpl->getConfigVariable('empty_list');?>
</h4><?php }?>
				<div align="right">
					<a href="accounts.php?action=add" class="btn btn-primary"><?php echo ucfirst($_smarty_tpl->getConfigVariable('add'));?>
 <?php echo $_smarty_tpl->getConfigVariable('a');?>
 <?php echo $_smarty_tpl->getConfigVariable('account');?>
</a>
				</div>
			</div>
		</div>
	</div>
</div><?php }} ?>

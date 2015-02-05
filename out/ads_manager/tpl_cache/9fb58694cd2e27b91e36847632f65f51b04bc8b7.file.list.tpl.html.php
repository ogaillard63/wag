<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 17:16:52
         compiled from "C:\xampp\htdocs\wag\out\ads_manager\tpl\liens\list.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2544954d39774773481-76884572%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9fb58694cd2e27b91e36847632f65f51b04bc8b7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out\\ads_manager\\tpl\\liens\\list.tpl.html',
      1 => 1423152982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2544954d39774773481-76884572',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'liens' => 0,
    'lien' => 0,
    'btn_nav' => 0,
    'btn' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d3977490d769_73265947',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d3977490d769_73265947')) {function content_54d3977490d769_73265947($_smarty_tpl) {?><div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo ucfirst($_smarty_tpl->getConfigVariable('list_of_liens'));?>
</h3>
				<div class="actions pull-right">
					<i class="fa fa-chevron-down"></i>
					<i class="fa fa-times"></i>
				</div>
			</div>
			<div class="panel-body">
				<?php if (!empty($_smarty_tpl->tpl_vars['liens']->value)) {?><table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('rub_id'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('titre'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('url'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('descriptif'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('etat'));?>
</th>
						<th colspan="2"><?php echo ucfirst($_smarty_tpl->getConfigVariable('actions'));?>
</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['lien'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lien']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['liens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lien']->key => $_smarty_tpl->tpl_vars['lien']->value) {
$_smarty_tpl->tpl_vars['lien']->_loop = true;
?>
					<tr>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['lien']->value->rub_id;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['lien']->value->titre;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['lien']->value->url;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['lien']->value->descriptif;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['lien']->value->etat;?>
</td>
						<td width="1%" align="center" nowrap="nowrap"><a class="btn btn-sm btn-success" href="liens.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['lien']->value->id;?>
" title="<?php echo ucfirst($_smarty_tpl->getConfigVariable('edit'));?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('lien');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('edit'));?>
</a></td>
						<td width="1%" align="center" nowrap="nowrap"><a class="btn btn-sm btn-danger" href="liens.php?action=delete&id=<?php echo $_smarty_tpl->tpl_vars['lien']->value->id;?>
" title="<?php echo ucfirst($_smarty_tpl->getConfigVariable('delete'));?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('lien');?>
"onclick="return confirm('<?php echo ucfirst($_smarty_tpl->getConfigVariable('do_you_really_want_to'));?>
 <?php echo $_smarty_tpl->getConfigVariable('delete');?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('lien');?>
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
				<li<?php if ($_smarty_tpl->tpl_vars['btn']->value['active']) {?> class="active" <?php }?>><a href="liens.php?<?php echo $_smarty_tpl->tpl_vars['btn']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['btn']->value['label'];?>
</a></li>
					<?php }
}?>
			</ul>
			<?php } else { ?><h4><?php echo $_smarty_tpl->getConfigVariable('no_lien');?>
</h4><?php }?>
			<div align="right">
				<a href="liens.php?action=add" class="btn btn-primary"><?php echo ucfirst($_smarty_tpl->getConfigVariable('add_a_lien'));?>
</a>
			</div>
		</div>
	</div>
</div>
</div><?php }} ?>

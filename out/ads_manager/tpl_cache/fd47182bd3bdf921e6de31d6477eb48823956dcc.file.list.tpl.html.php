<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 17:16:02
         compiled from "C:\xampp\htdocs\wag\out\ads_manager\tpl\articles\list.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1963754d3974216cc52-94369776%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd47182bd3bdf921e6de31d6477eb48823956dcc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out\\ads_manager\\tpl\\articles\\list.tpl.html',
      1 => 1423152955,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1963754d3974216cc52-94369776',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'articles' => 0,
    'article' => 0,
    'btn_nav' => 0,
    'btn' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d39742355140_08626712',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d39742355140_08626712')) {function content_54d39742355140_08626712($_smarty_tpl) {?><div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo ucfirst($_smarty_tpl->getConfigVariable('list_of_articles'));?>
</h3>
				<div class="actions pull-right">
					<i class="fa fa-chevron-down"></i>
					<i class="fa fa-times"></i>
				</div>
			</div>
			<div class="panel-body">
				<?php if (!empty($_smarty_tpl->tpl_vars['articles']->value)) {?><table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('creation'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('publication'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('titre'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('lien'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('texte'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('flux_id'));?>
</th>
						<th><?php echo ucfirst($_smarty_tpl->getConfigVariable('vus'));?>
</th>
						<th colspan="2"><?php echo ucfirst($_smarty_tpl->getConfigVariable('actions'));?>
</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['articles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value) {
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
					<tr>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['article']->value->creation;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['article']->value->publication;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['article']->value->titre;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['article']->value->lien;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['article']->value->texte;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['article']->value->flux_id;?>
</td>
						<td align="left"><?php echo $_smarty_tpl->tpl_vars['article']->value->vus;?>
</td>
						<td width="1%" align="center" nowrap="nowrap"><a class="btn btn-sm btn-success" href="articles.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['article']->value->id;?>
" title="<?php echo ucfirst($_smarty_tpl->getConfigVariable('edit'));?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('article');?>
"><?php echo ucfirst($_smarty_tpl->getConfigVariable('edit'));?>
</a></td>
						<td width="1%" align="center" nowrap="nowrap"><a class="btn btn-sm btn-danger" href="articles.php?action=delete&id=<?php echo $_smarty_tpl->tpl_vars['article']->value->id;?>
" title="<?php echo ucfirst($_smarty_tpl->getConfigVariable('delete'));?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('article');?>
"onclick="return confirm('<?php echo ucfirst($_smarty_tpl->getConfigVariable('do_you_really_want_to'));?>
 <?php echo $_smarty_tpl->getConfigVariable('delete');?>
 <?php echo $_smarty_tpl->getConfigVariable('this');?>
 <?php echo $_smarty_tpl->getConfigVariable('article');?>
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
				<li<?php if ($_smarty_tpl->tpl_vars['btn']->value['active']) {?> class="active" <?php }?>><a href="articles.php?<?php echo $_smarty_tpl->tpl_vars['btn']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['btn']->value['label'];?>
</a></li>
					<?php }
}?>
			</ul>
			<?php } else { ?><h4><?php echo $_smarty_tpl->getConfigVariable('no_article');?>
</h4><?php }?>
			<div align="right">
				<a href="articles.php?action=add" class="btn btn-primary"><?php echo ucfirst($_smarty_tpl->getConfigVariable('add_a_article'));?>
</a>
			</div>
		</div>
	</div>
</div>
</div><?php }} ?>

<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 17:16:52
         compiled from "C:\xampp\htdocs\wag\out\ads_manager\tpl\sidebar_left.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:3128354d397746e2be6-21090434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b3e9f95f8f15a85295972b29d37162c348df745' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out\\ads_manager\\tpl\\sidebar_left.tpl.html',
      1 => 1423151054,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3128354d397746e2be6-21090434',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tpl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d39774738af8_57555353',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d39774738af8_57555353')) {function content_54d39774738af8_57555353($_smarty_tpl) {?><aside class="sidebar">
    <div id="leftside-navigation" class="nano">
        <ul class="nano-content">
        <!--<li class="user-panel">
            <div class="thumb"><img src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/img/avatar2.gif" alt="" class="img-circle"></div>
            <div class="info">
                <p>John Doe</p>
                <ul class="list-inline list-unstyled">
                    <li><a href="#" ><i class="fa fa-user"></i></a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    <li><a href="#" ><i class="fa fa-cog"></i></a></li>
                    <li><a href="#" ><i class="fa fa-sign-out"></i></a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </li>-->
            <li>
                <a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="annonces.php"><i class="fa fa-table"></i><span><?php echo ucfirst($_smarty_tpl->getConfigVariable('annonces'));?>
</span></a>
            </li>
            <li>
                <a href="articles.php"><i class="fa fa-table"></i><span><?php echo ucfirst($_smarty_tpl->getConfigVariable('articles'));?>
</span></a>
            </li>           <li>
                <a href="liens.php"><i class="fa fa-table"></i><span><?php echo ucfirst($_smarty_tpl->getConfigVariable('liens'));?>
</span></a>
            </li>           <!-- <li class="sub-menu active">
                <a href="javascript:void(0);"><i class="fa fa-gear"></i><span>Configuration</span><i class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    <li class="active"><a href="banks.php"><i class="arrow fa fa-angle-right"></i><?php echo ucfirst($_smarty_tpl->getConfigVariable('banks'));?>
</a></li>
                    <li><a href="accounts.php"><i class="arrow fa fa-angle-right"></i><?php echo ucfirst($_smarty_tpl->getConfigVariable('accounts'));?>
</a></li>
                    <li><a href="categories.php"><i class="arrow fa fa-angle-right"></i><?php echo ucfirst($_smarty_tpl->getConfigVariable('categories'));?>
</a></li>
                </ul>
            </li>-->
        </ul>
    </div>
</aside><?php }} ?>

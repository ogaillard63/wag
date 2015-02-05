<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 15:27:07
         compiled from "C:\xampp\htdocs\wag\out2\tpl\sidebar_left.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1321754d37dbb874f65-80130652%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e01aa3f2f35b2962d7909ddaff63b749383426d6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out2\\tpl\\sidebar_left.tpl.html',
      1 => 1419107443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1321754d37dbb874f65-80130652',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tpl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d37dbb8af8f0_89221973',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d37dbb8af8f0_89221973')) {function content_54d37dbb8af8f0_89221973($_smarty_tpl) {?>        <aside class="sidebar">
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
            <a href="transactions.php"><i class="fa fa-table"></i><span><?php echo ucfirst($_smarty_tpl->getConfigVariable('transactions'));?>
</span></a>
        </li>
         <li class="sub-menu active">
            <a href="javascript:void(0);"><i class="fa fa-gear"></i><span>Configuration</span><i class="arrow fa fa-angle-right pull-right"></i></a>
            <ul>
                <li class="active"><a href="banks.php"><i class="arrow fa fa-angle-right"></i><?php echo ucfirst($_smarty_tpl->getConfigVariable('banks'));?>
</a></li>
                <li><a href="accounts.php"><i class="arrow fa fa-angle-right"></i><?php echo ucfirst($_smarty_tpl->getConfigVariable('accounts'));?>
</a></li>
                <li><a href="categories.php"><i class="arrow fa fa-angle-right"></i><?php echo ucfirst($_smarty_tpl->getConfigVariable('categories'));?>
</a></li>
            </ul>
        </li>
    </ul>
</div>

        </aside><?php }} ?>

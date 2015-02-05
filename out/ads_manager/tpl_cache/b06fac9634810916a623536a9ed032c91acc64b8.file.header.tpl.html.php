<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 17:16:52
         compiled from "C:\xampp\htdocs\wag\out\ads_manager\tpl\header.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1168254d39774690b48-72456004%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b06fac9634810916a623536a9ed032c91acc64b8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\wag\\out\\ads_manager\\tpl\\header.tpl.html',
      1 => 1419107443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1168254d39774690b48-72456004',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tpl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d397746c7658_49197754',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d397746c7658_49197754')) {function content_54d397746c7658_49197754($_smarty_tpl) {?><header id="header">
	<!--logo start-->
	<div class="brand">
		<a href="index.html" class="logo"></a>
	</div>
	<!--logo end-->
	<div class="toggle-navigation toggle-left">
		<button type="button" class="btn btn-default" id="toggle-left" data-toggle="tooltip" data-placement="right" title="Toggle Navigation">
			<i class="fa fa-bars"></i>
		</button>
	</div>
	<div class="user-nav">
		<ul>
			<!--<li class="dropdown messages">
				<span class="badge badge-danager animated bounceIn" id="new-messages">5</span>
				<button type="button" class="btn btn-default dropdown-toggle options" id="toggle-mail" data-toggle="dropdown">
					<i class="fa fa-envelope"></i>
				</button>
				<ul class="dropdown-menu alert animated fadeInDown">
					<li>
						<h1>You have <strong>5</strong> new messages</h1>
					</li>
					<li>
						<a href="#">
							<div class="profile-photo">
								<img src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/img/avatar.gif" alt="" class="img-circle">
							</div>
							<div class="message-info">
								<span class="sender">James Bond</span>
								<span class="time">30 mins</span>
								<div class="message-content">Lorem ipsum dolor sit amet, elit rutrum felis sed erat augue fusce...</div>
							</div>
						</a>
					</li>

					<li>
						<a href="#">
							<div class="profile-photo">
								<img src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/img/avatar1.gif" alt="" class="img-circle">
							</div>
							<div class="message-info">
								<span class="sender">Jeffrey Ashby</span>
								<span class="time">2 hour</span>
								<div class="message-content">hendrerit pellentesque, iure tincidunt, faucibus vitae dolor aliquam...</div>
							</div>
						</a>
					</li>

					<li>
						<a href="#">
							<div class="profile-photo">
								<img src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/img/avatar2.gif" alt="" class="img-circle">
							</div>
							<div class="message-info">
								<span class="sender">John Douey</span>
								<span class="time">3 hours</span>
								<div class="message-content">Penatibus suspendisse sit pellentesque eu accumsan condimentum nec...</div>
							</div>
						</a>
					</li>

					<li>
						<a href="#">
							<div class="profile-photo">
								<img src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/img/avatar3.gif" alt="" class="img-circle">
							</div>
							<div class="message-info">
								<span class="sender">Ellen Baker</span>
								<span class="time">7 hours</span>
								<div class="message-content">Sem dapibus in, orci bibendum faucibus tellus, justo arcu...</div>
							</div>
						</a>
					</li>
					<li>
						<a href="#">
							<div class="profile-photo">
								<img src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/img/avatar4.gif" alt="" class="img-circle">
							</div>
							<div class="message-info">
								<span class="sender">Ivan Bella</span>
								<span class="time">6 hours</span>
								<div class="message-content">Curabitur metus faucibus sapien elit, ante molestie sapien...</div>
							</div>
						</a>
					</li>
					<li><a href="#">Check all messages <i class="fa fa-angle-right"></i></a>
					</li>
				</ul>

			</li>-->
			<li class="profile-photo">
				<img src="<?php echo $_smarty_tpl->tpl_vars['tpl']->value;?>
/assets/img/avatar.png" alt="" class="img-circle">
			</li>
			<li class="dropdown settings">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					John Doe <i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu animated fadeInDown">
					<li>
						<a href="#"><i class="fa fa-user"></i> Profile</a>
					</li>
					<!--<li>
						<a href="#"><i class="fa fa-calendar"></i> Calendar</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge badge-danager" id="user-inbox">5</span></a>
					</li>-->
					<li>
						<a href="#"><i class="fa fa-power-off"></i> Logout</a>
					</li>
				</ul>
			</li>
			<li>
				<!--<div class="toggle-navigation toggle-right">
					<button type="button" class="btn btn-default" id="toggle-right">
						<i class="fa fa-comment"></i>
					</button>                       
				</div>-->
			</li>
		</ul>
	</div>
</header>
<?php }} ?>

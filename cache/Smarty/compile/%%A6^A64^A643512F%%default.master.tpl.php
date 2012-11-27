<?php /* Smarty version 2.6.25, created on 2012-04-28 12:26:40
         compiled from /homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'asset', '/homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl', 4, false),array('function', 'discussions_link', '/homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl', 10, false),array('function', 'profile_link', '/homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl', 11, false),array('function', 'inbox_link', '/homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl', 12, false),array('function', 'custom_menu', '/homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl', 13, false),array('function', 'event', '/homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl', 14, false),array('function', 'link', '/homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl', 16, false),array('function', 'nomobile_link', '/homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl', 31, false),array('function', 'dashboard_link', '/homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl', 32, false),array('function', 'signinout_link', '/homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl', 33, false),array('function', 'vanillaurl', '/homepages/6/d368326081/htdocs/bears/themes/mobile/views/default.master.tpl', 36, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
  <?php echo smarty_function_asset(array('name' => 'Head'), $this);?>

</head>
<body id="<?php echo $this->_tpl_vars['BodyID']; ?>
" class="<?php echo $this->_tpl_vars['BodyClass']; ?>
">
  <div id="Frame">
	 <div class="Banner">
		<ul>
		  <?php echo smarty_function_discussions_link(array(), $this);?>

		  <?php echo smarty_function_profile_link(array(), $this);?>

		  <?php echo smarty_function_inbox_link(array(), $this);?>

		  <?php echo smarty_function_custom_menu(array(), $this);?>

		  <?php echo smarty_function_event(array('name' => 'BeforeSignInLink'), $this);?>

		  <?php if (! $this->_tpl_vars['User']['SignedIn']): ?>
			 <li class="SignInItem"><?php echo smarty_function_link(array('path' => 'signin','class' => 'SignIn'), $this);?>
</li>
		  <?php endif; ?>
		</ul>
	 </div>
	 <div id="Body">
		<div id="Content">
		  <?php echo smarty_function_asset(array('name' => 'Content'), $this);?>

		</div>
	 </div>
	 <div id="Foot">
		<div class="FootMenu">
		  <!--
		  <span>Mobile</span>
		  <span><a href="#">Desktop</a></span>
		  -->
        <?php echo smarty_function_nomobile_link(array('wrap' => 'span'), $this);?>

		  <?php echo smarty_function_dashboard_link(array('wrap' => 'span'), $this);?>

		  <?php echo smarty_function_signinout_link(array('wrap' => 'span'), $this);?>

		</div>
		<div>
		  <a href="<?php echo smarty_function_vanillaurl(array(), $this);?>
"><span>Powered by Vanilla</span></a>
		</div>
		<?php echo smarty_function_asset(array('name' => 'Foot'), $this);?>

	 </div>
  </div>
<?php echo smarty_function_event(array('name' => 'AfterBody'), $this);?>

</body>
</html>
<?php
/* Smarty version 4.5.5, created on 2026-05-08 05:12:03
  from 'C:\xampp\htdocs\ojs\lib\pkp\templates\frontend\components\breadcrumbs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69fd00230314a7_13418524',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9dd3eb8606f4aa38423a852483cc5c64820ae88' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ojs\\lib\\pkp\\templates\\frontend\\components\\breadcrumbs.tpl',
      1 => 1778161106,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69fd00230314a7_13418524 (Smarty_Internal_Template $_smarty_tpl) {
?>
<nav class="cmp_breadcrumbs" role="navigation">
	<ol>
		<li>
			<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>"index",'router'=>PKP\core\PKPApplication::ROUTE_PAGE),$_smarty_tpl ) );?>
">
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.homepageNavigationLabel"),$_smarty_tpl ) );?>

			</a>
			<span class="separator"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"navigation.breadcrumbSeparator"),$_smarty_tpl ) );?>
</span>
		</li>
		<li class="current">
			<span aria-current="page">
				<?php if ($_smarty_tpl->tpl_vars['currentTitleKey']->value) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>$_smarty_tpl->tpl_vars['currentTitleKey']->value),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['currentTitle']->value ));?>

				<?php }?>
			</span>
		</li>
	</ol>
</nav>

<?php }
}

<?php
/* Smarty version 4.5.5, created on 2026-05-08 05:13:30
  from 'C:\xampp\htdocs\ojs\lib\pkp\templates\common\urlInEl.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69fd007a52ef56_79275125',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d4f0c7aea00196670d743e33863fd72e72f34af' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ojs\\lib\\pkp\\templates\\common\\urlInEl.tpl',
      1 => 1778161105,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69fd007a52ef56_79275125 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['inVueEl']->value) {?>
<component is="script">
<?php } else {
echo '<script'; ?>
>
<?php }?>
	// Initialize JS handler.
	$(function() {
		$('div#<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['inElElId']->value,'javascript' ));?>
')
			.last()
			.pkpHandler(
				'$.pkp.controllers.UrlInDivHandler',
				{
					sourceUrl: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['inElUrl']->value ));?>
,
					refreshOn: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['refreshOn']->value ));?>

				}
			);
	});
<?php if ($_smarty_tpl->tpl_vars['inVueEl']->value) {?>
</component>
<?php } else {
echo '</script'; ?>
>
<?php }?>

<<?php echo $_smarty_tpl->tpl_vars['inEl']->value;?>
 id="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['inElElId']->value ));?>
"<?php if ($_smarty_tpl->tpl_vars['inElClass']->value) {?> class="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['inElClass']->value ));?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['inElPlaceholder']->value;?>
</<?php echo $_smarty_tpl->tpl_vars['inEl']->value;?>
>
<?php }
}

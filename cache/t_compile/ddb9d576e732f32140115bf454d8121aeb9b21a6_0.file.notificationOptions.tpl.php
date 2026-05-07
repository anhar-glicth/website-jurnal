<?php
/* Smarty version 4.5.5, created on 2026-05-08 05:13:30
  from 'C:\xampp\htdocs\ojs\lib\pkp\templates\controllers\notification\notificationOptions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69fd007a049a85_38117525',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ddb9d576e732f32140115bf454d8121aeb9b21a6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ojs\\lib\\pkp\\templates\\controllers\\notification\\notificationOptions.tpl',
      1 => 1778161106,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69fd007a049a85_38117525 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['refreshOn']->value) {?>
	refreshOn: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['refreshOn']->value ));?>
,
<?php }?>
fetchNotificationUrl: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>PKP\core\PKPApplication::ROUTE_PAGE,'page'=>'notification','op'=>'fetchNotification','escape'=>false),$_smarty_tpl ) ) ));?>
,
hasSystemNotifications: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['hasSystemNotifications']->value ));?>

<?php if ($_smarty_tpl->tpl_vars['requestOptions']->value) {?>
	,
	requestOptions: {
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['requestOptions']->value, 'levelOptions', false, 'level', 'levels', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['levelOptions']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['level']->value => $_smarty_tpl->tpl_vars['levelOptions']->value) {
$_smarty_tpl->tpl_vars['levelOptions']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['total'];
?>
			<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['level']->value ));?>
: <?php if ($_smarty_tpl->tpl_vars['levelOptions']->value) {?> {
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['levelOptions']->value, 'typeOptions', false, 'type', 'types', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['typeOptions']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['type']->value => $_smarty_tpl->tpl_vars['typeOptions']->value) {
$_smarty_tpl->tpl_vars['typeOptions']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['total'];
?>
					<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['type']->value ));?>
: <?php if ($_smarty_tpl->tpl_vars['typeOptions']->value) {?> {
						assocType: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['typeOptions']->value[0] ));?>
,
						assocId: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'json_encode' ][ 0 ], array( $_smarty_tpl->tpl_vars['typeOptions']->value[1] ));?>

					}<?php } else { ?>0<?php }
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_types']->value['last'] : null)) {?>,<?php }?>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			}<?php } else { ?>0<?php }
if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_levels']->value['last'] : null)) {?>,<?php }?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	}
<?php }
}
}

<?php
/* Smarty version 4.5.5, created on 2026-05-08 05:13:30
  from 'C:\xampp\htdocs\ojs\lib\pkp\templates\common\loadingContainer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69fd007a3e7946_16090864',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eb04fa2d94100316ce680795ec0982597eddf1e1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ojs\\lib\\pkp\\templates\\common\\loadingContainer.tpl',
      1 => 1778161105,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69fd007a3e7946_16090864 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="pkp_loading">
	<span class="pkp_spinner"></span>
	<span class="message"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"common.loading"),$_smarty_tpl ) );?>
</span>
</div>
<?php }
}

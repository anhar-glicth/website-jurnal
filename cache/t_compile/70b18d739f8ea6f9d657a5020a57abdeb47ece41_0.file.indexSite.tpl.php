<?php
/* Smarty version 4.5.5, created on 2026-05-08 05:11:15
  from 'C:\xampp\htdocs\ojs\templates\frontend\pages\indexSite.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69fcfff392af16_18763786',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70b18d739f8ea6f9d657a5020a57abdeb47ece41' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ojs\\templates\\frontend\\pages\\indexSite.tpl',
      1 => 1778159405,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'tpl:frontend/components/header.tpl' => 1,
    'tpl:frontend/components/highlights.tpl' => 1,
    'tpl:frontend/objects/announcements_list.tpl' => 1,
    'tpl:frontend/components/footer.tpl' => 1,
  ),
),false)) {
function content_69fcfff392af16_18763786 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("tpl:frontend/components/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="page_index_site">

	<?php if ($_smarty_tpl->tpl_vars['highlights']->value->count()) {?>
		<?php $_smarty_tpl->_subTemplateRender("tpl:frontend/components/highlights.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('highlights'=>$_smarty_tpl->tpl_vars['highlights']->value), 0, false);
?>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['about']->value) {?>
		<div class="about_site">
			<?php echo $_smarty_tpl->tpl_vars['about']->value;?>

		</div>
	<?php }?>

	<?php $_smarty_tpl->_subTemplateRender("tpl:frontend/objects/announcements_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('numAnnouncements'=>$_smarty_tpl->tpl_vars['numAnnouncementsHomepage']->value), 0, false);
?>

	<div class="journals">
		<h2>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"context.contexts"),$_smarty_tpl ) );?>

		</h2>
		<?php if (!call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'count' ][ 0 ], array( $_smarty_tpl->tpl_vars['journals']->value ))) {?>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"site.noJournals"),$_smarty_tpl ) );?>

		<?php } else { ?>
			<ul>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['journals']->value, 'journal');
$_smarty_tpl->tpl_vars['journal']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['journal']->value) {
$_smarty_tpl->tpl_vars['journal']->do_else = false;
?>
					<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', "url", null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('journal'=>$_smarty_tpl->tpl_vars['journal']->value->getPath()),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
					<?php $_smarty_tpl->_assignInScope('thumb', $_smarty_tpl->tpl_vars['journal']->value->getLocalizedData('journalThumbnail'));?>
					<?php $_smarty_tpl->_assignInScope('description', $_smarty_tpl->tpl_vars['journal']->value->getLocalizedDescription());?>
					<li<?php if ($_smarty_tpl->tpl_vars['thumb']->value) {?> class="has_thumb"<?php }?>>
						<?php if ($_smarty_tpl->tpl_vars['thumb']->value) {?>
							<div class="thumb">
								<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">
									<img src="<?php echo $_smarty_tpl->tpl_vars['journalFilesPath']->value;
echo $_smarty_tpl->tpl_vars['journal']->value->getId();?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['thumb']->value['uploadName'],"url" ));?>
"<?php if ($_smarty_tpl->tpl_vars['thumb']->value['altText']) {?> alt="<?php echo (($tmp = call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['thumb']->value['altText'] )) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"<?php }?>>
								</a>
							</div>
						<?php }?>

						<div class="body">
							<h3>
								<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" rel="bookmark">
									<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['journal']->value->getLocalizedName() ));?>

								</a>
							</h3>
							<?php if ($_smarty_tpl->tpl_vars['description']->value) {?>
								<div class="description">
									<?php echo $_smarty_tpl->tpl_vars['description']->value;?>

								</div>
							<?php }?>
							<ul class="links">
								<li class="view">
									<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"site.journalView"),$_smarty_tpl ) );?>

									</a>
								</li>
								<li class="current">
									<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('journal'=>$_smarty_tpl->tpl_vars['journal']->value->getPath(),'page'=>"issue",'op'=>"current"),$_smarty_tpl ) );?>
">
										<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"site.journalCurrent"),$_smarty_tpl ) );?>

									</a>
								</li>
							</ul>
						</div>
					</li>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ul>
		<?php }?>
	</div>

</div><!-- .page -->

<?php $_smarty_tpl->_subTemplateRender("tpl:frontend/components/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}

<?php
/* Smarty version 4.5.5, created on 2026-05-08 05:12:03
  from 'C:\xampp\htdocs\ojs\lib\pkp\templates\frontend\objects\announcements_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_69fd0023083cd6_10104259',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c80ee33071f01e4cfcf1ae9db53f9ca1debc08ea' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ojs\\lib\\pkp\\templates\\frontend\\objects\\announcements_list.tpl',
      1 => 1778161106,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'tpl:frontend/objects/announcement_summary.tpl' => 1,
  ),
),false)) {
function content_69fd0023083cd6_10104259 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['numAnnouncements']->value && call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'count' ][ 0 ], array( $_smarty_tpl->tpl_vars['announcements']->value ))) {?>
    <section class="cmp_announcements highlight_first">
        <a id="homepageAnnouncements"></a>
        <h2>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('key'=>"announcement.announcements"),$_smarty_tpl ) );?>

        </h2>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['announcements']->value, 'announcement', false, NULL, 'announcements', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['announcement']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['announcement']->value) {
$_smarty_tpl->tpl_vars['announcement']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_announcements']->value['iteration']++;
?>
            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_announcements']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_announcements']->value['iteration'] : null) > $_smarty_tpl->tpl_vars['numAnnouncements']->value) {?>
                <?php break 1;?>
            <?php }?>
            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_announcements']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_announcements']->value['iteration'] : null) == 1) {?>
                <?php $_smarty_tpl->_subTemplateRender("tpl:frontend/objects/announcement_summary.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('heading'=>"h3"), 0, true);
?>
                <div class="more">
            <?php } else { ?>
                <article class="obj_announcement_summary">
                    <h4>
                        <a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('router'=>PKP\core\PKPApplication::ROUTE_PAGE,'page'=>"announcement",'op'=>"view",'path'=>$_smarty_tpl->tpl_vars['announcement']->value->id),$_smarty_tpl ) );?>
">
                            <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['announcement']->value->getLocalizedData('title') ));?>

                        </a>
                    </h4>
                    <div class="date">
                        <?php echo $_smarty_tpl->tpl_vars['announcement']->value->datePosted->format($_smarty_tpl->tpl_vars['dateFormatShort']->value);?>

                    </div>
                </article>
            <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div><!-- .more -->
    </section>
<?php }
}
}

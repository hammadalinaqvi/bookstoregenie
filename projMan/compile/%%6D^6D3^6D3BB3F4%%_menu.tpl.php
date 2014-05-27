<?php /* Smarty version 2.6.16, created on 2012-07-06 11:50:36
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_menu.tpl', 7, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_menu.tpl', 7, false),)), $this); ?>
<div id="menu">
<?php if ($this->_tpl_vars['_menu'] && is_foreachable ( $this->_tpl_vars['_menu']->groups )):  $_from = $this->_tpl_vars['_menu']->groups; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_menu_group_name'] => $this->_tpl_vars['_menu_group']):
?>
  <ul class="group" id="menu_group_<?php echo $this->_tpl_vars['_menu_group_name']; ?>
">
  <?php $_from = $this->_tpl_vars['_menu_group']->items; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['_menu_items'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['_menu_items']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['_menu_item']):
        $this->_foreach['_menu_items']['iteration']++;
?>
    <?php if ($this->_foreach['_menu_items']['iteration'] == 1): ?>
      <li class="item<?php if (smarty_modifier_count($this->_tpl_vars['_menu_group']->items) == 1): ?> single<?php else: ?> first<?php endif;  if ($this->_tpl_vars['wireframe']->current_menu_item == $this->_tpl_vars['_menu_item']->name): ?> active<?php endif; ?>" id="menu_item_<?php echo ((is_array($_tmp=$this->_tpl_vars['_menu_item']->name)) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"><?php echo $this->_tpl_vars['_menu_item']->render(); ?>
</li>
    <?php elseif ($this->_foreach['_menu_items']['iteration'] == count ( $this->_tpl_vars['_menu_group']->items )): ?>
      <li class="item <?php if ($this->_tpl_vars['wireframe']->current_menu_item == $this->_tpl_vars['_menu_item']->name): ?> active<?php endif; ?> last" id="menu_item_<?php echo ((is_array($_tmp=$this->_tpl_vars['_menu_item']->name)) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"><?php echo $this->_tpl_vars['_menu_item']->render(); ?>
</li>
    <?php else: ?>
      <li class="item middle<?php if ($this->_tpl_vars['wireframe']->current_menu_item == $this->_tpl_vars['_menu_item']->name): ?> active<?php endif; ?>" id="menu_item_<?php echo ((is_array($_tmp=$this->_tpl_vars['_menu_item']->name)) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"><?php echo $this->_tpl_vars['_menu_item']->render(); ?>
</li>
    <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
  </ul>
<?php endforeach; endif; unset($_from);  endif; ?>
</div>
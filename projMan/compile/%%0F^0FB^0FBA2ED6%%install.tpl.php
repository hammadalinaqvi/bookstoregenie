<?php /* Smarty version 2.6.16, created on 2012-07-11 11:31:34
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/install.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/install.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/install.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/install.tpl', 6, false),array('block', 'button', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/install.tpl', 19, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/install.tpl', 13, false),array('modifier', 'clickable', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/install.tpl', 13, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Install Module<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Install<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="install_module">
<?php if ($this->_tpl_vars['can_be_installed']): ?>
  <p><?php $this->_tag_stack[] = array('lang', array('name' => $this->_tpl_vars['active_module']->getDisplayName())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All checks passed. :name module <strong>can be installed</strong><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</p>
<?php else: ?>
  <p><?php $this->_tag_stack[] = array('lang', array('name' => $this->_tpl_vars['active_module']->getDisplayName())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>We are sorry, but <strong>:name module can't be installed</strong> because:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>
  <?php if (is_foreachable ( $this->_tpl_vars['installation_check_log'] )): ?>
  <ol>
  <?php $_from = $this->_tpl_vars['installation_check_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['log_message']):
?>
    <li><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['log_message'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('clickable', true, $_tmp) : smarty_modifier_clickable($_tmp)); ?>
</li>
  <?php endforeach; endif; unset($_from); ?>
  </ol>
  <?php endif;  if ($this->_tpl_vars['can_be_installed']): ?>
  <div id="install_module_button">
    <?php $this->_tag_stack[] = array('button', array('href' => $this->_tpl_vars['active_module']->getInstallUrl(),'method' => 'post','confirm' => 'Are you sure that you want to install this module?')); $_block_repeat=true;smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array('name' => $this->_tpl_vars['active_module']->getDisplayName())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Install :name Module<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </div>
<?php else: ?>
  <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please fix the errors listed above to be able to install this module<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</p>
<?php endif; ?>
</div>
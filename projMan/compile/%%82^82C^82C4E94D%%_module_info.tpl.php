<?php /* Smarty version 2.6.16, created on 2012-07-11 11:31:38
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/_module_info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'humanize', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/_module_info.tpl', 3, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/_module_info.tpl', 6, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/_module_info.tpl', 5, false),)), $this); ?>
<div class="icon"><img src="<?php echo $this->_tpl_vars['active_module']->getIconUrl(); ?>
" alt="" /></div>
<div class="meta">
  <h2><?php echo ((is_array($_tmp=$this->_tpl_vars['active_module']->getName())) ? $this->_run_mod_handler('humanize', true, $_tmp) : smarty_modifier_humanize($_tmp)); ?>
</h2>
  <dl>
    <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_module']->getDisplayName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
, v<?php echo $this->_tpl_vars['active_module']->getVersion(); ?>
</dd>
    
    <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_module']->getDescription())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
  </dl>
</div>
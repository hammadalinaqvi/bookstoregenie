<?php /* Smarty version 2.6.16, created on 2012-07-09 12:42:09
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/_object_quick_options.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_object_quick_options.tpl', 3, false),array('block', 'link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_object_quick_options.tpl', 3, false),)), $this); ?>
<ul class="object_options">
<?php $_from = $this->_tpl_vars['_quick_options']->data; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_quick_option_name'] => $this->_tpl_vars['_quick_option']):
?>
  <li <?php if (isset ( $this->_tpl_vars['_quick_option']['class'] )): ?>class="<?php echo ((is_array($_tmp=$this->_tpl_vars['_quick_option']['class'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"<?php endif; ?> id="object_quick_option_<?php echo $this->_tpl_vars['_quick_option_name']; ?>
"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['_quick_option']['url'],'method' => $this->_tpl_vars['_quick_option']['method'],'confirm' => $this->_tpl_vars['_quick_option']['confirm'],'not_lang' => true)); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span><?php echo ((is_array($_tmp=$this->_tpl_vars['_quick_option']['text'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
<?php endforeach; endif; unset($_from); ?>
</ul>
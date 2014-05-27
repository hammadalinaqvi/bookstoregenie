<?php /* Smarty version 2.6.16, created on 2012-07-09 20:32:01
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/_paginator.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/_paginator.tpl', 4, false),)), $this); ?>
<?php if ($this->_tpl_vars['_mobile_access_paginator']->getLastPage() > 1): ?>
  <div class="paginator">
    <?php if (! $this->_tpl_vars['_mobile_access_paginator']->isFirst()): ?>
      <a href="<?php echo $this->_tpl_vars['_mobile_access_paginator_prev_url']; ?>
" class="paginator_button previous"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Previous<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a>
    <?php endif; ?>
    <span class="paginator_status">
      <?php $this->_tag_stack[] = array('lang', array('current' => $this->_tpl_vars['_mobile_access_paginator']->getCurrentPage(),'last' => $this->_tpl_vars['_mobile_access_paginator']->getLastPage())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page :current of :last<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </span>
    <?php if (! $this->_tpl_vars['_mobile_access_paginator']->isLast()): ?>
      <a href="<?php echo $this->_tpl_vars['_mobile_access_paginator_next_url']; ?>
" class="paginator_button next"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a>
    <?php endif; ?>
  </div>
<?php endif; ?>
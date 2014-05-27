<?php /* Smarty version 2.6.16, created on 2012-07-09 20:32:01
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'mobile_access_get_view_url', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/index.tpl', 5, false),array('function', 'mobile_access_paginator', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/index.tpl', 14, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/index.tpl', 8, false),array('modifier', 'excerpt', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/index.tpl', 8, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/index.tpl', 19, false),)), $this); ?>
<?php if (is_foreachable ( $this->_tpl_vars['companies'] )): ?>
  <ul class="list_with_icons">
  <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['company']):
?>
    <li class="obj_link <?php if ($this->_tpl_vars['owner_company']->getId() == $this->_tpl_vars['company']->getId()): ?>owner_company<?php endif; ?>">
      <a href="<?php echo smarty_function_mobile_access_get_view_url(array('object' => $this->_tpl_vars['company']), $this);?>
">
        <span class="main_line">
          <img src="<?php echo $this->_tpl_vars['company']->getLogoUrl(true); ?>
" alt="logo" class="icon" />
          <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('excerpt', true, $_tmp, 22) : smarty_modifier_excerpt($_tmp, 22)); ?>

        </span>
      </a>
    </li>
  <?php endforeach; endif; unset($_from); ?>
  </ul>
  <?php echo smarty_function_mobile_access_paginator(array('paginator' => $this->_tpl_vars['pagination'],'url' => $this->_tpl_vars['pagination_url']), $this);?>

<?php else: ?>
  <div class="wrapper">
    <div class="box">
      <ul class="menu">
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No Companies<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      </ul>
    </div>
  </div>
<?php endif; ?>
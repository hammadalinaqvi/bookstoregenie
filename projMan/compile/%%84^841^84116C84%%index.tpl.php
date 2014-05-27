<?php /* Smarty version 2.6.16, created on 2012-07-09 20:32:09
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_projects/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_projects/index.tpl', 4, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_projects/index.tpl', 8, false),array('modifier', 'excerpt', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_projects/index.tpl', 27, false),array('function', 'mobile_access_get_view_url', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_projects/index.tpl', 24, false),array('function', 'mobile_access_paginator', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_projects/index.tpl', 33, false),)), $this); ?>
<div class="listing_options">
  <form action="<?php echo $this->_tpl_vars['paginator_url']; ?>
" method="GET" class="center">
    <select name="group_id">
      <option value=""><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Any Groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
      <?php if (is_foreachable ( $this->_tpl_vars['groups'] )): ?>
      <?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
        <?php if ($this->_tpl_vars['selected_group_id'] == $this->_tpl_vars['group']->getId()): ?>
        <option value="<?php echo $this->_tpl_vars['group']->getId(); ?>
" selected="selected"><?php echo ((is_array($_tmp=$this->_tpl_vars['group']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</option>
        <?php else: ?>
        <option value="<?php echo $this->_tpl_vars['group']->getId(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['group']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</option>
        <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
      <?php endif; ?>
    </select>
    <button type="submit"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Filter<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></button>
  </form>

</div>

<?php if (is_foreachable ( $this->_tpl_vars['projects'] )): ?>
  <ul class="list_with_icons">
  <?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project']):
?>
    <li class="obj_link">
      <a href="<?php echo smarty_function_mobile_access_get_view_url(array('object' => $this->_tpl_vars['project']), $this);?>
">
        <span class="main_line">
          <img src="<?php echo $this->_tpl_vars['project']->getIconUrl(true); ?>
" alt="logo" class="icon" />
          <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('excerpt', true, $_tmp, 18) : smarty_modifier_excerpt($_tmp, 18)); ?>

        </span>
      </a>
    </li>
  <?php endforeach; endif; unset($_from); ?>
  </ul>
  <?php echo smarty_function_mobile_access_paginator(array('paginator' => $this->_tpl_vars['pagination'],'url' => $this->_tpl_vars['paginator_url'],'url_param_group_id' => $this->_tpl_vars['selected_group_id']), $this);?>

<?php else: ?>
  <div class="wrapper">
    <div class="box">
      <ul class="menu">
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      </ul>
    </div>
  </div>
<?php endif; ?>
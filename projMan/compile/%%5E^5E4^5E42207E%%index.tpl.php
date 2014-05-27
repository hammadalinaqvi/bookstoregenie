<?php /* Smarty version 2.6.16, created on 2012-07-09 20:31:23
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access/index.tpl', 2, false),array('function', 'assemble', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access/index.tpl', 5, false),array('function', 'mobile_access_get_view_url', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access/index.tpl', 19, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access/index.tpl', 19, false),)), $this); ?>
<div class="wrapper">
  <h2 class="label"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Shortcuts<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
  <div class="box">
    <ul class="menu main_menu">
      <li class="icon_home"><a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access'), $this);?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Home<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
      <li class="icon_assignments"><a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access_assignments'), $this);?>
" class=""><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
      <li class="icon_starred"><a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access_starred'), $this);?>
" class=""><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Starred<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
      <li class="icon_people"><a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access_people'), $this);?>
" class=""><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>People<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
      <li class="icon_projects"><a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access_projects'), $this);?>
" class=""><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
    </ul>
  </div>
  
  
  <?php if (is_foreachable ( $this->_tpl_vars['pinned_projects'] )): ?>
  <h2 class="label"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Favorite Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
  <div class="box">
    <ul class="menu main_menu">
    <?php $_from = $this->_tpl_vars['pinned_projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pinned_project']):
?>
      <li style="background-image: url(<?php echo $this->_tpl_vars['pinned_project']->getIconUrl(); ?>
)"><a href="<?php echo smarty_function_mobile_access_get_view_url(array('object' => $this->_tpl_vars['pinned_project']), $this);?>
" ><span><?php echo ((is_array($_tmp=$this->_tpl_vars['pinned_project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span></a></li>
    <?php endforeach; endif; unset($_from); ?>
    </ul>
  </div>
  <?php endif; ?>
</div>
<?php /* Smarty version 2.6.16, created on 2012-07-11 11:28:14
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/roles_admin/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/roles_admin/index.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/roles_admin/index.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/roles_admin/index.tpl', 7, false),array('block', 'link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/roles_admin/index.tpl', 15, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/roles_admin/index.tpl', 12, false),array('function', 'image_url', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/roles_admin/index.tpl', 15, false),array('function', 'empty_slate', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/roles_admin/index.tpl', 48, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/roles_admin/index.tpl', 14, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Roles Management<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All roles<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="roles_administration">
  <div id="system_roles">
    <div class="col_wide">
      <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>System Roles<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
      <div class="section_container">
      <?php if (is_foreachable ( $this->_tpl_vars['system_roles'] )): ?>
        <table class="common_table">
        <?php $_from = $this->_tpl_vars['system_roles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['role']):
?>
          <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
            <td class="checkbox"><input type="checkbox" class="auto input_checkbox" set_as_default_url="<?php echo $this->_tpl_vars['role']->getSetAsDefaultUrl(); ?>
" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Default Role?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" <?php if ($this->_tpl_vars['default_role_id'] == $this->_tpl_vars['role']->getId()): ?>checked="checked"<?php endif; ?> /></td>
            <td class="name"><a href="<?php echo $this->_tpl_vars['role']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['role']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></td>
            <td class="options"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['role']->getEditUrl())); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  if ($this->_tpl_vars['role']->canDelete()): ?> <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['role']->getDeleteUrl(),'method' => 'post','confirm' => 'Are you sure that you want to delete selected role?')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif; ?></td>
          </tr>
       <?php endforeach; endif; unset($_from); ?>
        </table>
      <?php else: ?>
      <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no system roles defined<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
      <?php endif; ?>
      </div>
    </div>
  </div>
  
  <div class="col_wide2">
    <div id="projects_roles">
      <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project Roles<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
      <div class="section_container">
      <?php if (is_foreachable ( $this->_tpl_vars['project_roles'] )): ?>
        <table class="common_table">
        <?php $_from = $this->_tpl_vars['project_roles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['role']):
?>
          <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
            <td class="name"><a href="<?php echo $this->_tpl_vars['role']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['role']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></td>
            <td class="options"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['role']->getEditUrl())); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  if ($this->_tpl_vars['role']->canDelete()): ?> <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['role']->getDeleteUrl(),'method' => 'post','confirm' => 'Are you sure that you want to delete selected role?')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif; ?></td>
          </tr>
        <?php endforeach; endif; unset($_from); ?>
        </table>
      <?php else: ?>
        <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no project roles defined<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
      <?php endif; ?>
      </div>
    </div>
  </div>
    
  <div class="clear"></div>
  
  <?php echo smarty_function_empty_slate(array('name' => 'roles','module' => 'system'), $this);?>

</div>
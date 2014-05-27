<?php /* Smarty version 2.6.16, created on 2012-07-11 11:33:24
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/documents/views/documents_module_admin/module.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/documents/views/documents_module_admin/module.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/documents/views/documents_module_admin/module.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/documents/views/documents_module_admin/module.tpl', 7, false),array('function', 'include_template', '/home/books1/public_html/projMan/activecollab/application/modules/documents/views/documents_module_admin/module.tpl', 5, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/documents/views/documents_module_admin/module.tpl', 16, false),array('function', 'role_permission_value', '/home/books1/public_html/projMan/activecollab/application/modules/documents/views/documents_module_admin/module.tpl', 18, false),array('function', 'empty_slate', '/home/books1/public_html/projMan/activecollab/application/modules/documents/views/documents_module_admin/module.tpl', 25, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/documents/views/documents_module_admin/module.tpl', 17, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Documents Module<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="documents_module" class="module_admin_details">
  <?php echo smarty_function_include_template(array('name' => '_module_info','controller' => 'modules_admin','module' => 'system'), $this);?>

  
  <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Permissions<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
  <div class="section_container">
    <table class="module_role_permissions">
      <tr>
        <th class="role_name"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Role<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="permission"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Can access docs?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="permission"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Can add docs?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      </tr>
    <?php $_from = $this->_tpl_vars['roles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['role']):
?>
      <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
        <td class="role_name"><a href="<?php echo $this->_tpl_vars['role']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['role']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></td>
        <td class="permission"><?php echo smarty_function_role_permission_value(array('role' => $this->_tpl_vars['role'],'permission' => 'can_use_documents'), $this);?>
</td>
        <td class="permission"><?php echo smarty_function_role_permission_value(array('role' => $this->_tpl_vars['role'],'permission' => 'can_add_documents'), $this);?>
</td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
  </div>
  
  <?php echo smarty_function_empty_slate(array('name' => 'documents','module' => 'documents'), $this);?>

</div>
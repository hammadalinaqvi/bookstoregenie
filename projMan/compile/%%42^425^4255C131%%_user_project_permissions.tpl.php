<?php /* Smarty version 2.6.16, created on 2012-07-09 12:42:27
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/_user_project_permissions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_user_project_permissions.tpl', 5, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_user_project_permissions.tpl', 11, false),array('block', 'assign_var', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_user_project_permissions.tpl', 14, false),array('function', 'select_project_permissions', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_user_project_permissions.tpl', 15, false),)), $this); ?>
<table class="select_user_project_permissions" id="<?php echo $this->_tpl_vars['_select_user_project_permissions_id']; ?>
">
<?php $_from = $this->_tpl_vars['_select_user_project_permissions_roles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_role']):
?>
  <tr>
    <td class="radio"><input type="radio" name="<?php echo $this->_tpl_vars['_select_user_project_permissions_name']; ?>
[<?php echo $this->_tpl_vars['_select_user_project_permissions_role_id_field']; ?>
]" value="<?php echo $this->_tpl_vars['_role']->getId(); ?>
" id="select_user_permission_role_<?php echo $this->_tpl_vars['_role']->getId(); ?>
" class="inline input_radio" <?php if ($this->_tpl_vars['_select_user_project_permissions_role_id'] == $this->_tpl_vars['_role']->getId()): ?>checked="checked"<?php endif; ?> /></td>
    <td class="label"><label for="select_user_permission_role_<?php echo $this->_tpl_vars['_role']->getId(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['_role']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</label></td>
  </tr>
<?php endforeach; endif; unset($_from); ?>
  <tr>
    <td class="radio"><input type="radio" name="<?php echo $this->_tpl_vars['_select_user_project_permissions_name']; ?>
[<?php echo $this->_tpl_vars['_select_user_project_permissions_role_id_field']; ?>
]" value="0" id="select_user_permission_role_0" class="inline input_radio" <?php if ($this->_tpl_vars['_select_user_project_permissions_role_id'] == 0): ?>checked="checked"<?php endif; ?> /></td>
    <td class="label">
      <label for="select_user_permission_role_0"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Custom Permissions ...<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
      
      <div class="custom_permissions" <?php if ($this->_tpl_vars['_select_user_project_permissions_role_id'] > 0): ?>style="display: none"<?php endif; ?>>
        <?php $this->_tag_stack[] = array('assign_var', array('name' => 'select_project_permissions_name')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['_select_user_project_permissions_name']; ?>
[<?php echo $this->_tpl_vars['_select_user_project_permissions_permissions_field']; ?>
]<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php echo smarty_function_select_project_permissions(array('name' => $this->_tpl_vars['select_project_permissions_name'],'value' => $this->_tpl_vars['_select_user_project_permissions_permissions']), $this);?>

      </div>
    </td>
  </tr>
</table>
<script type="text/javascript">
  App.widgets.SelectUserProjectPermissions.init('<?php echo $this->_tpl_vars['_select_user_project_permissions_id']; ?>
');
</script>
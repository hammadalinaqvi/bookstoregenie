<?php /* Smarty version 2.6.16, created on 2012-07-09 14:14:10
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/_select_users.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_select_users.tpl', 3, false),array('function', 'var_export', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_select_users.tpl', 11, false),)), $this); ?>
<div class="select_users_widget" id="<?php echo $this->_tpl_vars['_select_users_id']; ?>
">
  <div class="select_users_widget_users">
    <p class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No users selected<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  </div>
  <a href="#" class="assignees_button"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Change<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
</div>
<script type="text/javascript">
  App.widgets.SelectUsers.init('<?php echo $this->_tpl_vars['_select_users_id']; ?>
', '<?php echo $this->_tpl_vars['_select_users_name']; ?>
', <?php echo $this->_tpl_vars['_select_users_company_id']; ?>
, <?php echo $this->_tpl_vars['_select_users_project_id']; ?>
, <?php echo $this->_tpl_vars['_select_users_exclude_ids']; ?>
);
<?php if (is_foreachable ( $this->_tpl_vars['_select_users_users'] )):  $_from = $this->_tpl_vars['_select_users_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_select_users_user']):
?>
  App.widgets.SelectUsers.add_user('<?php echo $this->_tpl_vars['_select_users_id']; ?>
', '<?php echo $this->_tpl_vars['_select_users_name']; ?>
', <?php echo $this->_tpl_vars['_select_users_user']->getId(); ?>
, <?php echo smarty_function_var_export(array('var' => $this->_tpl_vars['_select_users_user']->getDisplayName()), $this);?>
);
<?php endforeach; endif; unset($_from);  endif; ?>
</script>
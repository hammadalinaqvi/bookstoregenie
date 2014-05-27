<?php /* Smarty version 2.6.16, created on 2012-07-06 11:56:14
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/project_groups/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_groups/index.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_groups/index.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_groups/index.tpl', 13, false),array('function', 'include_template', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_groups/index.tpl', 9, false),array('function', 'assemble', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_groups/index.tpl', 17, false),array('function', 'image_url', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_groups/index.tpl', 18, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project Groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project Groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="manage_project_groups_list" class="manage_project_groups <?php if ($this->_tpl_vars['request']->isAsyncCall()): ?>async<?php endif; ?>">
  <div class="manage_project_groups_table_wrapper">
    <table class="common_table">
  <?php if (is_foreachable ( $this->_tpl_vars['project_groups'] )): ?>
    <?php $_from = $this->_tpl_vars['project_groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project_group']):
?>
      <?php echo smarty_function_include_template(array('name' => '_project_group_row','controller' => 'project_groups','module' => 'system'), $this);?>

    <?php endforeach; endif; unset($_from); ?>
  <?php endif; ?>
    </table>
    <p id="manage_project_groups_empty_list" class="empty_page" <?php if (is_foreachable ( $this->_tpl_vars['project_groups'] )): ?>style="display: none"<?php endif; ?>><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no project groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  </div>
  
  <?php if ($this->_tpl_vars['can_add_project_group']): ?>
  <form action="<?php echo smarty_function_assemble(array('route' => 'project_groups_add'), $this);?>
" method="post" class="add_project_group_form">
    <input type="text" /> <img src="<?php echo smarty_function_image_url(array('name' => 'plus-small.gif'), $this);?>
" alt="" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Project Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" />
  </form>
  <?php endif; ?>
</div>

<script type="text/javascript">
  App.system.ManageProjectGroups.init_page('manage_project_groups_list');
</script>
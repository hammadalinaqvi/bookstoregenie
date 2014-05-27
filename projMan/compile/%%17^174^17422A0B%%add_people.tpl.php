<?php /* Smarty version 2.6.16, created on 2012-07-09 14:14:10
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/add_people.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/add_people.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/add_people.tpl', 2, false),array('block', 'form', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/add_people.tpl', 5, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/add_people.tpl', 6, false),array('block', 'wrap', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/add_people.tpl', 8, false),array('block', 'wrap_buttons', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/add_people.tpl', 24, false),array('block', 'submit', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/add_people.tpl', 25, false),array('function', 'select_users', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/add_people.tpl', 10, false),array('function', 'select_user_project_permissions', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/add_people.tpl', 20, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="add_people">
  <?php $this->_tag_stack[] = array('form', array('action' => $this->_tpl_vars['active_project']->getAddPeopleUrl(),'method' => 'post')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select Users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
    <div class="section_container">
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'users','class' => 'select_users_add_permissions')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <?php if ($this->_tpl_vars['logged_user']->isOwner() || $this->_tpl_vars['logged_user']->isAdministrator() || $this->_tpl_vars['logged_user']->isProjectManager()): ?>
        <?php echo smarty_function_select_users(array('name' => 'users','exclude' => $this->_tpl_vars['exclude_users']), $this);?>

      <?php else: ?>
        <?php echo smarty_function_select_users(array('name' => 'users','company' => $this->_tpl_vars['logged_user']->getCompany(),'exclude' => $this->_tpl_vars['exclude_users']), $this);?>

      <?php endif; ?>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <div class="clear"></div>
    </div>
    <div id="select_permissions">
      <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set Permissions<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
      <div class="section_container">
        <?php echo smarty_function_select_user_project_permissions(array('name' => 'project_permissions'), $this);?>

      </div>
    </div>
  
    <?php $this->_tag_stack[] = array('wrap_buttons', array()); $_block_repeat=true;smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <?php $this->_tag_stack[] = array('submit', array()); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>
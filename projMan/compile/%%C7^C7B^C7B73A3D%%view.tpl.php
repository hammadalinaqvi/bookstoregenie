<?php /* Smarty version 2.6.16, created on 2012-07-09 12:44:54
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/users/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/view.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/view.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/view.tpl', 19, false),array('function', 'page_object', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/view.tpl', 3, false),array('function', 'object_quick_options', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/view.tpl', 5, false),array('function', 'role_name', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/view.tpl', 33, false),array('function', 'user_time', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/view.tpl', 66, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/view.tpl', 20, false),array('modifier', 'ago', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/view.tpl', 62, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array('not_lang' => true)); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['active_user']->getDisplayName();  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Profile<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  echo smarty_function_page_object(array('object' => $this->_tpl_vars['active_user']), $this);?>


<?php echo smarty_function_object_quick_options(array('object' => $this->_tpl_vars['active_user'],'user' => $this->_tpl_vars['logged_user']), $this);?>

<div class="user main_object" id="user_details">
  <div class="body">
    <?php if ($this->_tpl_vars['active_user']->canEdit($this->_tpl_vars['logged_user'])): ?>
    <a href="<?php echo $this->_tpl_vars['active_user']->getEditAvatarUrl(); ?>
" id="select_user_icon">
      <img src="<?php echo $this->_tpl_vars['active_user']->getAvatarUrl(true); ?>
" alt="" class="properties_icon" />
    </a>
    <script type="text/javascript">
      App.widgets.IconPicker.init('edit_icon','select_user_icon', App.lang('Change Avatar'));
    </script>
    <?php else: ?>
      <img src="<?php echo $this->_tpl_vars['active_user']->getAvatarUrl(true); ?>
" alt="" class="properties_icon" />    
    <?php endif; ?>
    <dl class="properties">
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_user']->getDisplayName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
    
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd>
      <?php if ($this->_tpl_vars['active_user']->getConfigValue('title')): ?>
        <?php $this->_tag_stack[] = array('lang', array('title' => $this->_tpl_vars['active_user']->getConfigValue('title'),'company_url' => $this->_tpl_vars['active_company']->getViewUrl(),'company_name' => $this->_tpl_vars['active_company']->getName())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>:title in <a href=":company_url">:company_name</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php else: ?>
        <a href="<?php echo $this->_tpl_vars['active_company']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['active_company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a>
      <?php endif; ?>
      </dd>
      
    <?php if ($this->_tpl_vars['logged_user']->isPeopleManager()): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Role<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_role_name(array('role' => $this->_tpl_vars['active_user']->getRole(),'user' => $this->_tpl_vars['logged_user']), $this);?>
</dd>
    <?php endif; ?>
    </dl>
    
    <div class="body content">
      <div id="user_details_contact" class="user_details_body_block">
        <dl class="details_list">
          <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
          <dd><a href="mailto:<?php echo $this->_tpl_vars['active_user']->getEmail(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['active_user']->getEmail())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></dd>
        
        <?php if ($this->_tpl_vars['active_user']->getConfigValue('phone_work')): ?>
          <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Work #<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
          <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_user']->getConfigValue('phone_work'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['active_user']->getConfigValue('phone_mobile')): ?>
          <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mobile #<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
          <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_user']->getConfigValue('phone_mobile'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['active_user']->getConfigValue('im_type') && $this->_tpl_vars['active_user']->getConfigValue('im_value')): ?>
          <dt><?php echo ((is_array($_tmp=$this->_tpl_vars['active_user']->getConfigValue('im_type'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dt>
          <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_user']->getConfigValue('im_value'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
        <?php endif; ?>
        </dl>
      </div>
      
      <div id="user_details_time" class="user_details_body_block">
        <dl class="details_list">
        <?php if ($this->_tpl_vars['active_user']->getId() != $this->_tpl_vars['logged_user']->getId()): ?>
          <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last visit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
          <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_user']->getLastActivityOn())) ? $this->_run_mod_handler('ago', true, $_tmp) : smarty_modifier_ago($_tmp)); ?>
</dd>
        <?php endif; ?>
        
          <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Local time<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
          <dd><?php echo smarty_function_user_time(array('user' => $this->_tpl_vars['active_user'],'datetime' => $this->_tpl_vars['request_time']), $this);?>
</dd>
        </dl>
      </div>
    </div>
  </div>
</div>
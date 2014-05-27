<?php /* Smarty version 2.6.16, created on 2012-07-06 11:50:36
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/empty_slates/dashboard.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/empty_slates/dashboard.tpl', 3, false),array('block', 'link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/empty_slates/dashboard.tpl', 8, false),array('function', 'image_url', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/empty_slates/dashboard.tpl', 7, false),)), $this); ?>
<div id="empty_slate_system_dashboard" class="empty_slate with_sidebar">
  <div class="empty_slate_content">
    <p class="empty_slate_section_intro"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>It appears that this is the first time you are using this activeCollab setup. For any new installation we recommend that you configure the following<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
    
    <ul class="icon_list">
      <li>
        <img src="<?php echo smarty_function_image_url(array('name' => "admin/roles.gif"), $this);?>
" class="icon_list_icon" alt="" />
        <?php $this->_tag_stack[] = array('link', array('href' => '?route=admin_roles','class' => 'icon_list_link')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Roles and Permissions<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <span class="icon_list_description"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>By using roles and permissions, you have the ability to control who has access to which sections and features of your activeCollab installation<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</span>
      </li>
      <li>
        <img src="<?php echo smarty_function_image_url(array('name' => "settings/date_time.gif",'module' => 'system'), $this);?>
" class="icon_list_icon" alt="" />
        <?php $this->_tag_stack[] = array('link', array('href' => '?route=admin_settings_date_time','class' => 'icon_list_link')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Default Timezone and Date Formats<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <span class="icon_list_description"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set up default date and time settings such as default timezone, date and time formats, first day of the week and more. Users will be able to override default settings from their profile pages, but it is important to have the defaults set correctly<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</span>
      </li>
      <li>
        <img src="<?php echo smarty_function_image_url(array('name' => "settings/mailing.gif",'module' => 'system'), $this);?>
" class="icon_list_icon" alt="" />
        <?php $this->_tag_stack[] = array('link', array('href' => '?route=admin_settings_mailing','class' => 'icon_list_link')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mailing Settings<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <span class="icon_list_description"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set up email server and parameters for outgoing emails. You can test if mailing settings are good by using Test Mailing Settings tool. We made default email templates universal, but you might want to make them a bit more personalized for your users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</span>
      </li>
    </ul>
    
    <p class="empty_slate_section_intro"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Now that you are done with system configuration, you might want to extend the system and translate the interface<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
    
    <ul class="icon_list">
      <li>
        <img src="<?php echo smarty_function_image_url(array('name' => "admin/modules.gif"), $this);?>
" class="icon_list_icon" alt="" />
        <span class="icon_list_description"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>One of the great activeCollab features is that it is completely extensible. Check out which extensions for activeCollab are available in Downloads section of activeCollab website<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</span>
      </li>
      <li>
        <img src="<?php echo smarty_function_image_url(array('name' => "admin/languages.gif"), $this);?>
" class="icon_list_icon" alt="" />
        <span class="icon_list_description"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Translate the entire interface to the language that you or your users speak. You can translate the interface in multiple languages and let users to choose the one they prefer from their profile page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</span>
      </li>
    </ul>
    
    <p class="empty_slate_section_intro"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>When the system is properly configured and you have all of the features in place, you can create projects and invite people to work on them<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
    
    <ul class="icon_list">
      <li>
        <img src="<?php echo smarty_function_image_url(array('name' => "admin/people.gif"), $this);?>
" class="icon_list_icon" alt="" />
        <?php $this->_tag_stack[] = array('link', array('href' => '?route=people','class' => 'icon_list_link')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Bring People on Board<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <span class="icon_list_description"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Create accounts for your company, clients, contractors and everyone else you are working with at the People section. Use roles to define which sections and features of activeCollab users can access and how they can use them<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</span>
      </li>
      <li>
        <img src="<?php echo smarty_function_image_url(array('name' => "admin/projects.gif"), $this);?>
" class="icon_list_icon" alt="" />
        <?php $this->_tag_stack[] = array('link', array('href' => '?route=projects','class' => 'icon_list_link')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Start Adding Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <span class="icon_list_description"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Define project groups and create new projects in Projects section<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</span>
      </li>
    </ul>
  </div>
  <div class="empty_slate_sidebar">
    <img src="<?php echo smarty_function_image_url(array('name' => "welcome-sidebar-image.jpg"), $this);?>
" alt="" />
  </div>
  
  <p class="empty_slate_footer"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><b>Thank you for purchasing activeCollab!</b> We hope that you will enjoy using it as much as we enjoyed developing it<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</p>
</div>
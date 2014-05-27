<?php /* Smarty version 2.6.16, created on 2012-07-09 12:42:27
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 2, false),array('block', 'form', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 5, false),array('block', 'wrap', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 7, false),array('block', 'label', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 8, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 29, false),array('block', 'textarea_field', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 94, false),array('block', 'wrap_buttons', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 112, false),array('block', 'submit', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 113, false),array('function', 'text_field', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 9, false),array('function', 'role_name', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 18, false),array('function', 'select_role', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 21, false),array('function', 'password_field', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 73, false),array('function', 'select_user_project_permissions', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/users/add.tpl', 106, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New User<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New User<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="new_user">
  <?php $this->_tag_stack[] = array('form', array('action' => $this->_tpl_vars['active_company']->getAddUserUrl(),'method' => 'post')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <div class="col">
    <?php $this->_tag_stack[] = array('wrap', array('field' => 'email')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <?php $this->_tag_stack[] = array('label', array('for' => 'userEmail','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php echo smarty_function_text_field(array('name' => "user[email]",'value' => $this->_tpl_vars['user_data']['email'],'id' => 'userEmail','class' => 'required validate_email'), $this);?>

    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
    
    <?php if ($this->_tpl_vars['active_user']->canChangeRole($this->_tpl_vars['logged_user'])): ?>
      <div class="col">
        <?php $this->_tag_stack[] = array('wrap', array('field' => 'role_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <?php $this->_tag_stack[] = array('label', array('for' => 'userRole','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Role<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <?php if ($this->_tpl_vars['only_administrator']): ?>
            <?php echo smarty_function_role_name(array('role' => $this->_tpl_vars['active_user']->getRole()), $this);?>

            <input type="hidden" name="user[role_id]" value="<?php echo $this->_tpl_vars['user_data']['role_id']; ?>
" />
          <?php else: ?>
            <?php echo smarty_function_select_role(array('name' => "user[role_id]",'active_user' => $this->_tpl_vars['active_user'],'value' => $this->_tpl_vars['user_data']['role_id'],'id' => 'userRole','class' => 'required'), $this);?>

          <?php endif; ?>
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </div>
    <?php endif; ?>
    
    <div class="clear"></div>
    
    <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The following properties are optional. You can set them now, or at any point in the future<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
    
    <div id="additional_steps">
    
      <!-- Profile -->
      <div class="additional_step" id="additional_step_profile_details">
        <div class="head">
          <input type="checkbox" name="user[profile_details]" <?php if ($this->_tpl_vars['user_data']['profile_details']): ?>checked="checked"<?php endif; ?> value="1" class="auto input_checkbox" id="userFormProfileDetails" /> <?php $this->_tag_stack[] = array('label', array('for' => 'userFormProfileDetails','class' => 'inline')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set user details, such as first and last name and company title<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div>
        <div class="body">
          <div class="col">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'first_name')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'userFirstName')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>First Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_text_field(array('name' => "user[first_name]",'value' => $this->_tpl_vars['user_data']['first_name'],'id' => 'userFirstName'), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </div>
          
          <div class="col">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'last_name')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'userLastName')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_text_field(array('name' => "user[last_name]",'value' => $this->_tpl_vars['user_data']['last_name'],'id' => 'userLastName'), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </div>
          <div class="clear"></div>
          
          <div class="col">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'title')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'userTitle')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_text_field(array('name' => 'user[title]','value' => $this->_tpl_vars['user_data']['title'],'id' => 'userTitle'), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    
      <!-- Specify password -->
      <div class="additional_step" id="additional_step_password">
        <div class="head">
          <input type="checkbox" name="user[specify_password]" <?php if ($this->_tpl_vars['user_data']['specify_password']): ?>checked="checked"<?php endif; ?> value="1" class="auto input_checkbox" id="userFormSetPassword" /> <?php $this->_tag_stack[] = array('label', array('for' => 'userFormSetPassword','class' => 'inline')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Specify the account password. If not entered, then the system will a generate random password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div>
        <div class="body">
          <div class="col">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'password')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'userPassword')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Password<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_password_field(array('name' => 'user[password]','value' => $this->_tpl_vars['user_data']['password'],'id' => 'userPassword'), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </div>
          
          <div class="col">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'password_a')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'userPasswordA')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Retype<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_password_field(array('name' => 'user[password_a]','value' => $this->_tpl_vars['user_data']['password_a'],'id' => 'userPasswordA'), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      
      <!-- Send welcome message -->
      <div class="additional_step" id="additional_step_welcome_message">
        <div class="head">
          <input type="checkbox" name="user[send_welcome_message]" <?php if ($this->_tpl_vars['user_data']['send_welcome_message']): ?>checked="checked"<?php endif; ?> value="1" class="auto input_checkbox" id="userFormSendWelcomeMessage" /> <?php $this->_tag_stack[] = array('label', array('for' => 'userFormSendWelcomeMessage','class' => 'inline')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Send welcome email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div>
        <div class="body">
          <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Personalize welcome message<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
          <?php $this->_tag_stack[] = array('textarea_field', array('name' => "user[welcome_message]",'id' => 'userWelcomeMessage')); $_block_repeat=true;smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['user_data']['welcome_message'];  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_textarea_field($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div>
      </div>
      
      <?php if ($this->_tpl_vars['logged_user']->isPeopleManager()): ?>
      <!-- Set auto-assign settings -->
      <div class="additional_step" id="additional_step_auto_assign">
        <div class="head">
          <input type="checkbox" name="user[auto_assign]" <?php if ($this->_tpl_vars['user_data']['auto_assign']): ?>checked="checked"<?php endif; ?> value="1" class="auto input_checkbox" id="userFormAutoAssign" /> <?php $this->_tag_stack[] = array('label', array('for' => 'userFormAutoAssign','class' => 'inline')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set this user to be automatically added to new projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div>
        <div class="body">
          <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Set a role or custom permissions to be used when user is automatically added to the project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
          <?php echo smarty_function_select_user_project_permissions(array('name' => 'user','role_id' => $this->_tpl_vars['user_data']['auto_assign_role_id'],'permissions' => $this->_tpl_vars['user_data']['auto_assign_permissions'],'role_id_field' => 'auto_assign_role_id','permissions_field' => 'auto_assign_permissions'), $this);?>

        </div>
      </div>
      <?php endif; ?>
    </div>
  
    <?php $this->_tag_stack[] = array('wrap_buttons', array()); $_block_repeat=true;smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <?php $this->_tag_stack[] = array('submit', array()); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>
<?php /* Smarty version 2.6.16, created on 2012-07-10 02:08:17
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/quick_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/quick_add.tpl', 3, false),array('block', 'form', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/quick_add.tpl', 6, false),array('block', 'wrap', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/quick_add.tpl', 10, false),array('block', 'label', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/quick_add.tpl', 11, false),array('block', 'submit', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/quick_add.tpl', 44, false),array('function', 'text_field', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/quick_add.tpl', 12, false),array('function', 'select_date', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/quick_add.tpl', 19, false),array('function', 'select_assignees_inline', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/quick_add.tpl', 37, false),)), $this); ?>
<div class="form_wrapper quick_add_milestone">
  <?php if (isset ( $this->_tpl_vars['active_milestone'] ) && $this->_tpl_vars['active_milestone']->isLoaded()): ?>
    <p class="flash" id="success"><span class="flash_inner"><?php $this->_tag_stack[] = array('lang', array('name' => $this->_tpl_vars['active_milestone']->getName(),'url' => $this->_tpl_vars['active_milestone']->getViewUrl())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Milestone <a href=":url">:name</a> has been created<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
  <?php endif; ?>
  
  <?php $this->_tag_stack[] = array('form', array('method' => 'post','id' => 'quick_add_milestone','action' => $this->_tpl_vars['quick_add_url'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <div class="height_limited_popup">
      <div class="quick_add_columns_container">
        <div class="quick_add_left_column"><div class="quick_add_left_column_inner">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'name','class' => 'first_quick_add_field')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'quick_add_milestone_name','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_text_field(array('name' => 'milestone[name]','value' => $this->_tpl_vars['milestone_data']['name'],'id' => 'quick_add_milestone_name','class' => 'required'), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'date_range')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <div class="col">
            <?php $this->_tag_stack[] = array('wrap', array('field' => 'start_on')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
              <?php $this->_tag_stack[] = array('label', array('for' => 'quick_add_milestone_start_on','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Start on<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              <?php echo smarty_function_select_date(array('name' => 'milestone[start_on]','value' => $this->_tpl_vars['milestone_data']['start_on'],'id' => 'quick_add_milestone_start_on','show_timezone' => false,'class' => 'required'), $this);?>

            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </div>
            
            <div class="col">
            <?php $this->_tag_stack[] = array('wrap', array('field' => 'due_on')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
              <?php $this->_tag_stack[] = array('label', array('for' => 'quick_add_milestone_due_on','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Due on<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
              <?php echo smarty_function_select_date(array('name' => 'milestone[due_on]','value' => $this->_tpl_vars['milestone_data']['due_on'],'id' => 'quick_add_milestone_due_on','show_timezone' => false,'class' => 'required'), $this);?>

            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </div>
            <div class="clear"></div>
          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      
        </div></div>
        
        <div class="quick_add_right_column"><div class="quick_add_right_column_inner">
          <?php $this->_tag_stack[] = array('wrap', array('field' => 'assignees')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <?php $this->_tag_stack[] = array('label', array('for' => 'ticketAssignees')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignees<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_select_assignees_inline(array('name' => 'milestone[assignees]','value' => $this->_tpl_vars['milestone_data']['assignees'],'object' => $this->_tpl_vars['active_milestone'],'project' => $this->_tpl_vars['active_project'],'choose_responsible' => true,'id' => 'select_asignees_popup','users_per_row' => 1), $this);?>

          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div></div>
      </div>
    </div>
      
    <div class="wizardbar">
      <?php $this->_tag_stack[] = array('submit', array('accesskey' => false,'class' => 'submit')); $_block_repeat=true;smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Submit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_submit($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><a href="#" class="wizzard_back"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
    </div>
    <input type="hidden" name="milestone[project_id]" value="<?php if ($this->_tpl_vars['project_id']):  echo $this->_tpl_vars['project_id'];  else:  echo $this->_tpl_vars['milestone_data']['project_id'];  endif; ?>" />
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<script type="text/javascript">
<?php echo '
  if (App.ModalDialog.isOpen) {
    App.ModalDialog.setWidth(700);
  } // if
'; ?>

</script>
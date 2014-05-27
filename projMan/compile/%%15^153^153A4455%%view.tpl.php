<?php /* Smarty version 2.6.16, created on 2012-07-10 02:11:04
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'page_object', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl', 1, false),array('function', 'object_quick_options', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl', 4, false),array('function', 'action_on_by', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl', 10, false),array('function', 'object_assignees', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl', 28, false),array('function', 'object_tags', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl', 33, false),array('function', 'list_objects', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl', 58, false),array('function', 'object_subscriptions', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl', 67, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl', 8, false),array('modifier', 'date', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl', 17, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/view.tpl', 24, false),)), $this); ?>
<?php echo smarty_function_page_object(array('object' => $this->_tpl_vars['active_milestone']), $this);?>

<?php $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php echo smarty_function_object_quick_options(array('object' => $this->_tpl_vars['active_milestone'],'user' => $this->_tpl_vars['logged_user']), $this);?>

<div class="milestone main_object" id="milestone<?php echo $this->_tpl_vars['active_milestone']->getId(); ?>
">
  <div class="body">
    <dl class="properties">
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
    <?php if ($this->_tpl_vars['active_milestone']->isCompleted()): ?>
      <dd><?php echo smarty_function_action_on_by(array('user' => $this->_tpl_vars['active_milestone']->getCompletedBy(),'datetime' => $this->_tpl_vars['active_milestone']->getCompletedOn(),'action' => 'Completed'), $this);?>
</dd>
    <?php else: ?>
      <dd><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Active<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dd>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['active_milestone']->isDayMilestone()): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Due On<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_milestone']->getDueOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
</dd>
    <?php else: ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>From / To<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_milestone']->getStartOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
 &mdash; <?php echo ((is_array($_tmp=$this->_tpl_vars['active_milestone']->getDueOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
</dd>
    <?php endif; ?>
      
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_milestone']->getFormattedPriority())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
      
    <?php if ($this->_tpl_vars['active_milestone']->hasAssignees(true)): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignees<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_object_assignees(array('object' => $this->_tpl_vars['active_milestone']), $this);?>
</dd>
    <?php endif; ?>
      
    <?php if ($this->_tpl_vars['active_milestone']->hasTags()): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tags<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo smarty_function_object_tags(array('object' => $this->_tpl_vars['active_milestone']), $this);?>
</dd>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['milestone_add_links_code']): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add to Milestone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo $this->_tpl_vars['milestone_add_links_code']; ?>
</dd>
    <?php endif; ?>
    </dl>
  </div>
  
  <?php if ($this->_tpl_vars['active_milestone']->getBody()): ?>
    <div class="body content"><?php echo $this->_tpl_vars['active_milestone']->getFormattedBody(); ?>
</div>
  <?php else: ?>
    <div class="body content details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No notes...<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
  <?php endif; ?>
   
  <div class="resources">
    <?php if ($this->_tpl_vars['total_objects'] && is_foreachable ( $this->_tpl_vars['milestone_objects'] )): ?>
      <?php $_from = $this->_tpl_vars['milestone_objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['section_name'] => $this->_tpl_vars['objects']):
?>
      <?php if (is_foreachable ( $this->_tpl_vars['objects'] )): ?>
        <div class="resource">
          <div class="head">
            <h2 class="section_name"><span class="section_name_span"><?php echo $this->_tpl_vars['section_name']; ?>
</span></h2>
          </div>
          <div class="body">
            <?php echo smarty_function_list_objects(array('objects' => $this->_tpl_vars['objects'],'show_checkboxes' => false,'show_header' => false), $this);?>

          </div>
        </div>
      <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
      <div class="body content details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No tasks in this milestone...<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
    <?php endif; ?>
   
    <?php echo smarty_function_object_subscriptions(array('object' => $this->_tpl_vars['active_milestone']), $this);?>

  </div>
  
</div>
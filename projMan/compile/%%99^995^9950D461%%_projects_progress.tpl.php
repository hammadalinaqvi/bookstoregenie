<?php /* Smarty version 2.6.16, created on 2012-07-09 14:15:09
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/project/_projects_progress.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/_projects_progress.tpl', 3, false),)), $this); ?>
<div class="project_progress">
<?php if ($this->_tpl_vars['_project_progress']->getTotalTasksCount()): ?>
  <div class="progress_wrapper" <?php if (! $this->_tpl_vars['_project_progress_info']): ?>title="<?php $this->_tag_stack[] = array('lang', array('completed' => $this->_tpl_vars['_project_progress']->getCompletedTaskCount(),'total' => $this->_tpl_vars['_project_progress']->getTotalTasksCount(),'percent' => $this->_tpl_vars['_project_progress']->getPercentsDone())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>:completed of :total tasks completed (:percent%)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"<?php endif; ?>>
    <div class="progress" style="width: <?php echo $this->_tpl_vars['_project_progress']->getPercentsDone(); ?>
%"><span><?php echo $this->_tpl_vars['_project_progress']->getPercentsDone(); ?>
%</span></div>
  </div>
  <?php if ($this->_tpl_vars['_project_progress_info']): ?>
  <p><?php $this->_tag_stack[] = array('lang', array('completed' => $this->_tpl_vars['_project_progress']->getCompletedTaskCount(),'total' => $this->_tpl_vars['_project_progress']->getTotalTasksCount(),'percent' => $this->_tpl_vars['_project_progress']->getPercentsDone())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><strong>:completed</strong> of <strong>:total</strong> tasks completed (<strong>:percent%</strong>)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php endif;  else: ?>
  <div class="progress_wrapper"></div>
  <?php if ($this->_tpl_vars['_project_progress_info']): ?>
  <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no tasks in this project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php endif;  endif; ?>
</div>
<?php /* Smarty version 2.6.16, created on 2012-07-10 02:11:03
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/_notification_details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_notification_details.tpl', 4, false),array('function', 'object_link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_notification_details.tpl', 6, false),array('function', 'project_link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_notification_details.tpl', 17, false),array('function', 'object_assignees', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_notification_details.tpl', 36, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_notification_details.tpl', 5, false),array('modifier', 'date', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_notification_details.tpl', 31, false),array('modifier', 'filesize', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_notification_details.tpl', 52, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/_notification_details.tpl', 10, false),)), $this); ?>
<?php if ($this->_tpl_vars['_object']): ?>
<div style="border: 1px solid #e8e8e8;">
  <table style="width: 100%; border-collapse: collapse">
    <tr style="background: <?php echo smarty_function_cycle(array('values' => '#e8e8e8,#fff','name' => '_object_details_bg'), $this);?>
">
      <td style="width: 150px; padding: 5px"><?php echo ((is_array($_tmp=$this->_tpl_vars['_object']->getVerboseType(false,$this->_tpl_vars['_language']))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</td>
      <td style="padding: 5px"><?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['_object']), $this);?>
</td>
    </tr>
  <?php if (instance_of ( $this->_tpl_vars['_object'] , 'Task' ) && instance_of ( $this->_tpl_vars['_object']->getParent() , 'ProjectObject' )): ?>
    <tr style="background: <?php echo smarty_function_cycle(array('values' => '#e8e8e8,#fff','name' => '_object_details_bg'), $this);?>
">
      <td style="width: 150px; padding: 5px"><?php $this->_tag_stack[] = array('lang', array('language' => $this->_tpl_vars['_language'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Parent<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <td style="padding: 5px"><?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['_object']->getParent()), $this);?>
</td>
    </tr>
  <?php endif; ?>
    <tr style="background: <?php echo smarty_function_cycle(array('values' => '#e8e8e8,#fff','name' => '_object_details_bg'), $this);?>
">
    <?php if ($this->_tpl_vars['_object']->getMilestoneId() && instance_of ( $this->_tpl_vars['_object']->getMilestone() , 'Milestone' )): ?>
      <td style="padding: 5px"><?php $this->_tag_stack[] = array('lang', array('language' => $this->_tpl_vars['_language'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project and Milestone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <td style="padding: 5px"><?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['_object']->getProject()), $this);?>
 &raquo; <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['_object']->getMilestone()), $this);?>
</td>
    <?php else: ?>
      <td style="padding: 5px"><?php $this->_tag_stack[] = array('lang', array('language' => $this->_tpl_vars['_language'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <td style="padding: 5px"><?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['_object']->getProject()), $this);?>
</td>
    <?php endif; ?>
    </tr>
  <?php if ($this->_tpl_vars['_object']->can_be_completed): ?>
    <tr style="background: <?php echo smarty_function_cycle(array('values' => '#e8e8e8,#fff','name' => '_object_details_bg'), $this);?>
">
      <td style="padding: 5px"><?php $this->_tag_stack[] = array('lang', array('language' => $this->_tpl_vars['_language'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <td style="padding: 5px"><?php echo $this->_tpl_vars['_object']->getFormattedPriority($this->_tpl_vars['_language']); ?>
</td>
    </tr>
    <?php if (instance_of ( $this->_tpl_vars['_object']->getDueOn() , 'DateValue' )): ?>
    <tr style="background: <?php echo smarty_function_cycle(array('values' => '#e8e8e8,#fff','name' => '_object_details_bg'), $this);?>
">
      <td style="padding: 5px"><?php $this->_tag_stack[] = array('lang', array('language' => $this->_tpl_vars['_language'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Due On<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <td style="padding: 5px"><?php echo ((is_array($_tmp=$this->_tpl_vars['_object']->getDueOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
</td>
    </tr>
    <?php endif; ?>
    <tr style="background: <?php echo smarty_function_cycle(array('values' => '#e8e8e8,#fff','name' => '_object_details_bg'), $this);?>
">
      <td style="padding: 5px"><?php $this->_tag_stack[] = array('lang', array('language' => $this->_tpl_vars['_language'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignees<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <td style="padding: 5px"><?php echo smarty_function_object_assignees(array('object' => $this->_tpl_vars['_object'],'language' => $this->_tpl_vars['_language']), $this);?>
</td>
    </tr>
  <?php endif; ?>
  </table>

<?php if (trim ( $this->_tpl_vars['_object']->getBody() )): ?>
  <div style="padding: 5px; border-top: 1px solid #e8e8e8">
    <p style="text-transform: uppercase"><?php $this->_tag_stack[] = array('lang', array('language' => $this->_tpl_vars['_language'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
    <?php echo $this->_tpl_vars['_object']->getFormattedBody(); ?>

  </div>
<?php endif; ?>

<?php if ($this->_tpl_vars['_object']->can_have_attachments && $this->_tpl_vars['_object']->hasAttachments()): ?>
  <p style="text-transform: uppercase"><?php $this->_tag_stack[] = array('lang', array('language' => $this->_tpl_vars['_language'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attachments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
  <ol style="padding: 0 0 0 20px">
  <?php $_from = $this->_tpl_vars['_object']->getAttachments(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attachment']):
?>
    <li><?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['attachment']), $this);?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['attachment']->getSize())) ? $this->_run_mod_handler('filesize', true, $_tmp) : smarty_modifier_filesize($_tmp)); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['attachment']->getMimeType())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
)</li>
  <?php endforeach; endif; unset($_from); ?>
  </ol>
<?php endif; ?>
</div>
<?php endif; ?>
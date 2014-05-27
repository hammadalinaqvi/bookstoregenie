<?php /* Smarty version 2.6.16, created on 2012-07-09 14:15:29
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 31, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 10, false),array('function', 'object_star', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 11, false),array('function', 'object_priority', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 12, false),array('function', 'object_assignees', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 16, false),array('function', 'due', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 26, false),array('function', 'assemble', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 31, false),array('function', 'empty_slate', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 34, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 14, false),array('modifier', 'date', '/home/books1/public_html/projMan/activecollab/application/modules/milestones/views/milestones/index.tpl', 21, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Active milestones<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Active<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="list_view" id="milestones">
  <div class="object_list">
  <?php if (is_foreachable ( $this->_tpl_vars['milestones'] )): ?>
    <table>
      <tbody>
      <?php $_from = $this->_tpl_vars['milestones']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['milestone']):
?>
        <tr class="<?php if ($this->_tpl_vars['milestone']->isLate()): ?>late<?php elseif ($this->_tpl_vars['milestone']->isUpcoming()): ?>upcoming<?php else: ?>today<?php endif; ?> <?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
          <td class="star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['milestone'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
          <td class="priority"><?php echo smarty_function_object_priority(array('object' => $this->_tpl_vars['milestone']), $this);?>
</td>
          <td class="name">
            <a href="<?php echo $this->_tpl_vars['milestone']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['milestone']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a>
            <?php if ($this->_tpl_vars['milestone']->hasAssignees(true)): ?>
            <span class="details block"><?php echo smarty_function_object_assignees(array('object' => $this->_tpl_vars['milestone']), $this);?>
</span>
            <?php endif; ?>
          </td>
          <td class="date">
          <?php if ($this->_tpl_vars['milestone']->isDayMilestone()): ?>
            <?php echo ((is_array($_tmp=$this->_tpl_vars['milestone']->getDueOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>

          <?php else: ?>
            <?php echo ((is_array($_tmp=$this->_tpl_vars['milestone']->getStartOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
 &mdash; <?php echo ((is_array($_tmp=$this->_tpl_vars['milestone']->getDueOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>

          <?php endif; ?>
          </td>
          <td class="due"><?php echo smarty_function_due(array('object' => $this->_tpl_vars['milestone']), $this);?>
</td>
        </tr>
      <?php endforeach; endif; unset($_from); ?>
      </tbody>
    </table>
    <p class="milestones_ical"><a href="<?php echo smarty_function_assemble(array('route' => 'project_ical_subscribe','project_id' => $this->_tpl_vars['active_project']->getId()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>iCalendar<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
  <?php else: ?>
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No active milestones here<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>. <?php $this->_tag_stack[] = array('lang', array('add_url' => $this->_tpl_vars['add_milestone_url'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Would you like to <a href=":add_url">create one</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>?</p>
    <?php echo smarty_function_empty_slate(array('name' => 'milestones','module' => 'milestones'), $this);?>

  <?php endif; ?>
  </div>
  
  <ul class="category_list">
    <li <?php if ($this->_tpl_vars['request']->getAction() != 'archive'): ?>class="selected"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['milestones_url']; ?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Active<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
    <li <?php if ($this->_tpl_vars['request']->getAction() == 'archive'): ?>class="selected"<?php endif; ?>><a href="<?php echo smarty_function_assemble(array('route' => 'project_milestones_archive','project_id' => $this->_tpl_vars['active_project']->getId()), $this);?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Completed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
  </ul>
  
  <div class="clear"></div>
</div>
<?php /* Smarty version 2.6.16, created on 2012-07-07 05:28:23
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 9, false),array('block', 'link', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 25, false),array('block', 'pagination', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 99, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 13, false),array('function', 'image_url', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 20, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 113, false),array('function', 'object_star', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 114, false),array('function', 'object_priority', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 116, false),array('function', 'object_link', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 118, false),array('function', 'object_assignees', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 119, false),array('function', 'due', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 119, false),array('function', 'project_link', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 121, false),array('function', 'object_subscription', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 123, false),array('function', 'object_time', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/assignments/index.tpl', 125, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array('not_lang' => true)); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['active_filter']->getName();  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['active_filter']->getName();  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="assignments">
  <div id="assignments_filter">
    <table class="filter">
      <tr>
        <td id="assignments_filter_select">
          <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Filter<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <select name="filter">
          <?php $_from = $this->_tpl_vars['grouped_filters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group_name'] => $this->_tpl_vars['filters']):
?>
            <optgroup label="<?php echo $this->_tpl_vars['group_name']; ?>
">
            <?php $_from = $this->_tpl_vars['filters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['filter']):
?>
              <option value="<?php echo $this->_tpl_vars['filter']->getUrl(); ?>
" <?php if ($this->_tpl_vars['active_filter']->getId() == $this->_tpl_vars['filter']->getId()): ?>class="current" selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['filter']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
            </optgroup>
          <?php endforeach; endif; unset($_from); ?>
          </select> 
        </td>
        <td id="assignments_filter_options">
          <span class="tooltip"></span> <a href="<?php echo $this->_tpl_vars['active_filter']->getUrl(); ?>
" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Toggle Filter Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" id="toggle_filter_details"><img src="<?php echo smarty_function_image_url(array('name' => 'info-gray.gif'), $this);?>
" alt="" /></a> 
        <?php if ($this->_tpl_vars['active_filter']->canEdit($this->_tpl_vars['logged_user'])): ?>
          <a href="<?php echo $this->_tpl_vars['active_filter']->getEditUrl(); ?>
" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update Filter<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><img src="<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
" alt="" /></a> 
        <?php endif; ?>
        <?php if ($this->_tpl_vars['active_filter']->canDelete($this->_tpl_vars['logged_user'])): ?>
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['active_filter']->getDeleteUrl(),'title' => 'Delete Filter','method' => 'post','confirm' => "Are you sure that you want to delete this filter?")); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php endif; ?>
        </td>
      </tr>
    </table>
  </div>
  
  <div id="assignments_filter_details" style="display: none">
    <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This filter displays<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
    <ul>
      <li>
      <?php if ($this->_tpl_vars['active_filter']->getUserFilter() == 'anybody'): ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks assigned to anyone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php elseif ($this->_tpl_vars['active_filter']->getUserFilter() == 'not_assigneed'): ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks not assigned to anyone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php elseif ($this->_tpl_vars['active_filter']->getUserFilter() == 'logged_user'): ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks assigned to person using this filter<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php elseif ($this->_tpl_vars['active_filter']->getUserFilter() == 'logged_user_responsible'): ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks person using this filter is responsible for<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php elseif ($this->_tpl_vars['active_filter']->getUserFilter() == 'company'): ?>
        <?php $this->_tag_stack[] = array('lang', array('company' => $this->_tpl_vars['active_filter']->getVerboseUserFilterData())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks assigned to members of :company company<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php else: ?>
        <?php $this->_tag_stack[] = array('lang', array('to' => $this->_tpl_vars['active_filter']->getVerboseUserFilterData())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks assigned to :to<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php endif; ?>
      </li>
      
      <?php if ($this->_tpl_vars['active_filter']->getDateFilter() == 'late'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks that are late<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      <?php elseif ($this->_tpl_vars['active_filter']->getDateFilter() == 'today'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks that are due today<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      <?php elseif ($this->_tpl_vars['active_filter']->getDateFilter() == 'tomorrow'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks that are due tomorrow<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      <?php elseif ($this->_tpl_vars['active_filter']->getDateFilter() == 'this_week'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks that are due this week<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      <?php elseif ($this->_tpl_vars['active_filter']->getDateFilter() == 'next_week'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks that are due next week<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      <?php elseif ($this->_tpl_vars['active_filter']->getDateFilter() == 'this_month'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks that are due this month<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      <?php elseif ($this->_tpl_vars['active_filter']->getDateFilter() == 'next_month'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks that are due next month<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      <?php elseif ($this->_tpl_vars['active_filter']->getDateFilter() == 'selected_date'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array('from' => $this->_tpl_vars['active_filter']->getDateFrom())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks that are due on :from<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      <?php elseif ($this->_tpl_vars['active_filter']->getDateFilter() == 'selected_range'): ?>
        <li><?php $this->_tag_stack[] = array('lang', array('from' => $this->_tpl_vars['active_filter']->getDateFrom(),'to' => $this->_tpl_vars['active_filter']->getDateTo())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks that are due between :from and :to<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      <?php endif; ?>
      
      <li>
      <?php if ($this->_tpl_vars['active_filter']->getProjectFilter() == 'active'): ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks from all active projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php else: ?>
        <?php $this->_tag_stack[] = array('lang', array('project' => $this->_tpl_vars['active_filter']->getVerboseProjectFilterData())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks from :project project(s)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php endif; ?>
      </li>
      
      <li>
      <?php if ($this->_tpl_vars['active_filter']->getStatusFilter() == 'active'): ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Only active tasks<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php elseif ($this->_tpl_vars['active_filter']->getStatusFilter() == 'completed'): ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Only completed tasks<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php else: ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Both active and completed tasks<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php endif; ?>
      </li>
    </ul>
    <?php if ($this->_tpl_vars['active_filter']->getObjectsPerPage()): ?>
      <p><?php $this->_tag_stack[] = array('lang', array('by' => $this->_tpl_vars['active_filter']->getVerboseOrderBy(),'count' => $this->_tpl_vars['active_filter']->getObjectsPerPage())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks are ordered by :by and system shows :count tasks per page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
    <?php else: ?>
      <p><?php $this->_tag_stack[] = array('lang', array('by' => $this->_tpl_vars['active_filter']->getVerboseOrderBy())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tasks are ordered by :by<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
    <?php endif; ?>
  </div>
  
  <div id="assignments_list">
  <?php if (is_foreachable ( $this->_tpl_vars['assignments'] )): ?>
    <?php if ($this->_tpl_vars['pagination'] && ( $this->_tpl_vars['pagination']->getLastPage() > 1 )): ?>
    <p class="pagination top"><span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['active_filter']->getUrl('-PAGE-');  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
    <?php endif; ?>
    <div class="clear"></div>
    
    <table class="assignments">
      <tr>
        <th class="star"></th>
        <th class="checkbox"></th>
        <th class="priority"></th>
        <th class="name"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="project"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="option"></th>
      </tr>
    <?php $_from = $this->_tpl_vars['assignments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['assignment']):
?>
      <tr class="assignment_row <?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
        <td class="star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['assignment'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
        <td class="checkbox"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['assignment']->getCompleteUrl(true),'class' => 'complete_assignment')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "icons/not-checked.gif"), $this);?>
" alt="toggle" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
        <td class="priority"><?php echo smarty_function_object_priority(array('object' => $this->_tpl_vars['assignment']), $this);?>
</td>
        <td class="name">
          <?php echo ((is_array($_tmp=$this->_tpl_vars['assignment']->getVerboseType())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
: <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['assignment']), $this);?>

          <span class="details block"><?php echo smarty_function_object_assignees(array('object' => $this->_tpl_vars['assignment']), $this); if ($this->_tpl_vars['assignment']->getDueOn()): ?> | <?php echo smarty_function_due(array('object' => $this->_tpl_vars['assignment']), $this);?>
.<?php endif; ?></span>
        </td>
        <td class="project"><?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['assignment']->getProject()), $this);?>
</td>
        <td class="options">
        <?php echo smarty_function_object_subscription(array('object' => $this->_tpl_vars['assignment'],'user' => $this->_tpl_vars['logged_user']), $this);?>
 
        <?php if (module_loaded ( 'timetracking' ) && timetracking_can_add_for ( $this->_tpl_vars['logged_user'] , $this->_tpl_vars['assignment'] )): ?>
          <?php echo smarty_function_object_time(array('object' => $this->_tpl_vars['assignment'],'show_time' => false), $this);?>
 
        <?php endif; ?>
        <?php if ($this->_tpl_vars['assignment']->canEdit($this->_tpl_vars['logged_user'])): ?>
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['assignment']->getEditUrl(),'title' => 'Edit...')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-edit.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
        <?php endif; ?>
        <?php if ($this->_tpl_vars['assignment']->canDelete($this->_tpl_vars['logged_user'])): ?>
          <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['assignment']->getTrashUrl(),'title' => 'Move to Trash','class' => 'remove_assignment')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src='<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
' alt='' /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
  <?php else: ?>
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no tasks that match selected filter rules<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php endif; ?>
  </div>
  
<?php if (( $this->_tpl_vars['pagination']->getLastPage() > 1 ) && ! $this->_tpl_vars['pagination']->isLast()): ?>
  <p class="next_page"><a href="<?php echo $this->_tpl_vars['active_filter']->getUrl($this->_tpl_vars['pagination']->getNextPage()); ?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
<?php endif; ?>
  <p class="assignments_filter_rss"><a href="<?php echo $this->_tpl_vars['active_filter']->getRssUrl($this->_tpl_vars['logged_user']); ?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Track using RSS<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
</div>
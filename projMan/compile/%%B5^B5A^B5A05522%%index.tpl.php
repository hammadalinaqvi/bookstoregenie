<?php /* Smarty version 2.6.16, created on 2012-07-09 14:15:09
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 9, false),array('block', 'assign_var', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 77, false),array('block', 'link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 81, false),array('function', 'page_object', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 3, false),array('function', 'project_progress', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 10, false),array('function', 'object_assignees', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 26, false),array('function', 'due', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 29, false),array('function', 'assemble', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 77, false),array('function', 'user_link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 102, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 24, false),array('modifier', 'date', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 110, false),array('modifier', 'lower', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 128, false),array('modifier', 'time', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/index.tpl', 130, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Overview<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Overview<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  echo smarty_function_page_object(array('object' => $this->_tpl_vars['active_project']), $this);?>


<div id="project_home">
  <div class="project_home_right">
  
    <div class="dashboard_sidebar alt" id="project_home_progress"><div class="dashboard_sidebar_inner"><div class="dashboard_sidebar_inner_2">
      <h2><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Project Progress<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
      <div id="project_progress"><?php echo smarty_function_project_progress(array('project' => $this->_tpl_vars['active_project']), $this);?>
</div>
    </div></div></div>

    
    <?php if (is_foreachable ( $this->_tpl_vars['late_and_today'] ) || is_foreachable ( $this->_tpl_vars['upcoming_objects'] )): ?>
    <div class="dashboard_sidebar alt"><div class="dashboard_sidebar_inner"><div class="dashboard_sidebar_inner_2">
    <?php if (is_foreachable ( $this->_tpl_vars['late_and_today'] )): ?>
      <div id="late_today">
      <h2><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Late / Today Milestones<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
        <table class="common_table">
          <tbody>
          <?php $_from = $this->_tpl_vars['late_and_today']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object']):
?>
            <tr class="<?php if ($this->_tpl_vars['object']->isLate()): ?>late<?php elseif ($this->_tpl_vars['object']->isUpcoming()): ?>upcoming<?php else: ?>today<?php endif; ?>">
              <td class="info">
                <a href="<?php echo $this->_tpl_vars['object']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['object']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a>
              <?php if ($this->_tpl_vars['object']->hasAssignees(true)): ?>
                <span class="details block"><?php echo smarty_function_object_assignees(array('object' => $this->_tpl_vars['object']), $this);?>
</span>
              <?php endif; ?>
              </td>
              <td class="due"><?php echo smarty_function_due(array('object' => $this->_tpl_vars['object']), $this);?>
</td>
            </tr>
          <?php endforeach; endif; unset($_from); ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
    
    <?php if (is_foreachable ( $this->_tpl_vars['upcoming_objects'] )): ?>
      <div id="upcoming">
      <h2><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upcoming Milestones<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
        <table class="common_table">
          <tbody>
          <?php $_from = $this->_tpl_vars['upcoming_objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object']):
?>
            <tr class="<?php if ($this->_tpl_vars['object']->isLate()): ?>late<?php elseif ($this->_tpl_vars['object']->isUpcoming()): ?>upcoming<?php else: ?>today<?php endif; ?>">
              <td class="info">
                <a href="<?php echo $this->_tpl_vars['object']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['object']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a>
              <?php if ($this->_tpl_vars['object']->hasAssignees(true)): ?>
                <span class="details block"><?php echo smarty_function_object_assignees(array('object' => $this->_tpl_vars['object']), $this);?>
</span>
              <?php endif; ?>
              </td>
              <td class="due"><?php echo smarty_function_due(array('object' => $this->_tpl_vars['object']), $this);?>
</td>
            </tr>
          <?php endforeach; endif; unset($_from); ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
    
    </div></div></div>
    <?php endif; ?>
    
    <?php if (is_foreachable ( $this->_tpl_vars['home_sidebars'] )): ?>
      <?php $_from = $this->_tpl_vars['home_sidebars']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['home_sidebar']):
?>
        <?php if ($this->_tpl_vars['home_sidebar']['body']): ?>
          <div class="dashboard_sidebar <?php if (! $this->_tpl_vars['home_sidebar']['is_important']): ?>alt<?php endif; ?>" id="<?php echo $this->_tpl_vars['home_sidebar']['id']; ?>
"><div class="dashboard_sidebar_inner"><div class="dashboard_sidebar_inner_2">
            <h2><?php echo $this->_tpl_vars['home_sidebar']['label']; ?>
</h2>
            <?php echo $this->_tpl_vars['home_sidebar']['body']; ?>

          </div></div></div>
        <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
  </div>
    
  <div class="project_home_left">
    <div class="dashboard_wide_sidebar" id="project_details"><div class="dashboard_wide_sidebar_inner"><div class="dashboard_wide_sidebar_inner_2">
      <div class="project_details_right">
        <div id="show_me" class="<?php if ($this->_tpl_vars['active_project']->getOverview()): ?>with_overview<?php endif; ?>">
          <?php $this->_tag_stack[] = array('assign_var', array('name' => 'user_tasks_url')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_user_tasks','project_id' => $this->_tpl_vars['active_project']->getId()), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <?php $this->_tag_stack[] = array('assign_var', array('name' => 'ical_subscribe_url')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_ical_subscribe','project_id' => $this->_tpl_vars['active_project']->getId()), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <?php $this->_tag_stack[] = array('assign_var', array('name' => 'rss_url')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_rss','project_id' => $this->_tpl_vars['active_project']->getId(),'token' => $this->_tpl_vars['logged_user']->getToken(true)), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <ul>
            <li id="show_me_assignments"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['user_tasks_url'])); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My Assignments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
            <li id="show_me_ical"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['ical_subscribe_url'])); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>iCalendar Feed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
            <li id="show_me_rss"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['rss_url'])); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>RSS Feed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
          </ul>
        </div>
      </div>
      
      <div class="project_details_left">
        <?php if ($this->_tpl_vars['active_project']->canEdit($this->_tpl_vars['logged_user'])): ?>
        <div id="project_icon"><a href="<?php echo $this->_tpl_vars['active_project']->getEditIconUrl(); ?>
" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click to Change Project Icon<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" class="icon_selector" id="select_project_icon"><img src="<?php echo $this->_tpl_vars['active_project']->getIconUrl(true); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['active_project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
" /></a></div>
        <script type="text/javascript">
          App.widgets.IconPicker.init('edit_icon','select_project_icon', App.lang('Change Icon'));
        </script>
        <?php else: ?>
        <div id="project_icon"><img src="<?php echo $this->_tpl_vars['active_project']->getIconUrl(true); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['active_project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
" /></div>
        <?php endif; ?>
        
        <div id="project_meta">
          <h2><?php echo ((is_array($_tmp=$this->_tpl_vars['active_project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</h2>
          <div class="project_meta_details">
            <p><?php echo $this->_tpl_vars['active_project']->getFormattedOverview(); ?>
</p>
            <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Leader<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <strong><?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['active_project']->getLeader()), $this);?>
</strong></p>
          <?php if (instance_of ( $this->_tpl_vars['project_company'] , 'Company' )): ?>
            <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Client<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <strong><a href="<?php echo $this->_tpl_vars['project_company']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['project_company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></strong></p>
          <?php endif; ?>
          <?php if (instance_of ( $this->_tpl_vars['project_group'] , 'ProjectGroup' )): ?>
            <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <strong><a href="<?php echo $this->_tpl_vars['project_group']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['project_group']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></strong></p>
          <?php endif; ?>
            <?php if ($this->_tpl_vars['active_project']->getStartsOn()): ?>
            <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Starts On<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['active_project']->getStartsOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
</strong></p>
          <?php endif; ?>
            
            <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <strong><?php echo ((is_array($_tmp=$this->_tpl_vars['active_project']->getVerboseStatus())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</strong></p>
          </div>
        </div>
      </div>
    </div></div></div>

    <div class="dashboard_wide_sidebar alt"><div class="dashboard_wide_sidebar_inner"><div class="dashboard_wide_sidebar_inner_2">
    <?php if (is_foreachable ( $this->_tpl_vars['grouped_activities'] )): ?>
    
    <div id="recent_activities">
      <?php $_from = $this->_tpl_vars['grouped_activities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['activities'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['activities']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['date'] => $this->_tpl_vars['activities']):
        $this->_foreach['activities']['iteration']++;
?>
      <h3 class="day_section"><?php echo ((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</h3>
      <div class="day_activities">
        <?php $_from = $this->_tpl_vars['activities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['activities'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['activities']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['activity']):
        $this->_foreach['activities']['iteration']++;
?>
        <?php $this->assign('activity_object', $this->_tpl_vars['activity']->getObject()); ?>
        <div class="activity <?php echo ((is_array($_tmp=$this->_tpl_vars['activity_object']->getType())) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
_activity <?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getType())) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
_activity">
          <div class="log_icon"><img src="<?php echo $this->_tpl_vars['activity']->getIconUrl(); ?>
" alt="" /></div>
          <div class="log_time"><?php echo ((is_array($_tmp=$this->_tpl_vars['activity']->getCreatedOn())) ? $this->_run_mod_handler('time', true, $_tmp) : smarty_modifier_time($_tmp)); ?>
</div>
          <div class="log_info">
            <div class="log_info_head"><?php echo $this->_tpl_vars['activity']->renderHead($this->_tpl_vars['activity_object'],true); ?>
</div>
          <?php if ($this->_tpl_vars['activity']->has_body): ?>
            <?php $this->assign('rendered_body', $this->_tpl_vars['activity']->renderBody($this->_tpl_vars['activity_object'],false)); ?>
            <?php if (( $this->_tpl_vars['rendered_body'] )): ?>
              <div class="log_info_body"><?php echo $this->_tpl_vars['rendered_body']; ?>
</div>
            <?php endif; ?>
          <?php endif; ?>
          <?php if ($this->_tpl_vars['activity']->has_footer): ?>
            <?php $this->assign('rendered_footer', $this->_tpl_vars['activity']->renderFooter($this->_tpl_vars['activity_object'],false)); ?>
            <?php if (( $this->_tpl_vars['rendered_footer'] )): ?>
            <div class="log_info_foot">
              <?php echo $this->_tpl_vars['rendered_footer']; ?>

            </div>
            <?php endif; ?>
          <?php endif; ?>
          </div>
        </div>
        <?php endforeach; endif; unset($_from); ?>
      </div>
      <?php endforeach; endif; unset($_from); ?>
    
      <p class="recent_activities_rss"><a href="<?php echo smarty_function_assemble(array('route' => 'project_rss','project_id' => $this->_tpl_vars['active_project']->getId(),'token' => $this->_tpl_vars['logged_user']->getToken(true)), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recent Activities<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
    </div>
    <?php else: ?>
      <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This Project has no Recent Activities<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
    <?php endif; ?>
    </div></div></div>
  </div>
</div>
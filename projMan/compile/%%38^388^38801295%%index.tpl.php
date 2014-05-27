<?php /* Smarty version 2.6.16, created on 2012-07-06 11:50:36
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl', 2, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl', 3, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl', 35, false),array('function', 'empty_slate', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl', 5, false),array('function', 'include_template', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl', 23, false),array('function', 'image', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl', 60, false),array('function', 'project_link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl', 62, false),array('function', 'user_link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl', 85, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl', 61, false),array('modifier', 'datetime', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl', 85, false),array('modifier', 'time', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/index.tpl', 89, false),)), $this); ?>
<?php if ($this->_tpl_vars['show_welcome_message']): ?>
  <?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Welcome to activeCollab<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Welcome<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

  <div id="dashboard"><?php echo smarty_function_empty_slate(array('module' => 'system','name' => 'dashboard'), $this);?>
</div>
<?php else: ?>
  <?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Dashboard<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>View<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

  <div id="dashboard">
    <!-- Dashboard top sections -->
    
      <!-- Dashboard sections -->
      <div id="dashboard_sections">
        <ul class="top_tabs dashboard_tabs">
        <?php $_from = $this->_tpl_vars['dashboard_sections']->data; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['dashboard_sections'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['dashboard_sections']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['dashboard_section_name'] => $this->_tpl_vars['dashboard_section']):
        $this->_foreach['dashboard_sections']['iteration']++;
?>
      	  <li id="dashboard_section_<?php echo $this->_tpl_vars['dashboard_section_name']; ?>
"><a href="<?php echo $this->_tpl_vars['dashboard_section']['url']; ?>
"><span><?php echo $this->_tpl_vars['dashboard_section']['text']; ?>
</span></a></li>
      	<?php endforeach; endif; unset($_from); ?>
        </ul>
        
        <div class="top_tabs_object_list dashboard_wide_sidebar alt"><div class="dashboard_wide_sidebar_inner"><div class="dashboard_wide_sidebar_inner_2">
          <div class="dashboard_section_content" id="dashboard_section_recent_activities_content">
            <?php echo smarty_function_include_template(array('name' => 'recent_activities','controller' => 'dashboard','module' => 'system'), $this);?>

          </div>
        </div></div></div>
      </div>
      <script type="text/javascript">
        App.widgets.DashboardSections.init('dashboard_sections');
      </script>
      <!-- / dashboard sections -->
    
      <div id="dashboard_sidebars">
        <?php if ($this->_tpl_vars['important_items']->count()): ?>
        <div class="dashboard_sidebar" id="dashboard_important"><div class="dashboard_sidebar_inner"><div class="dashboard_sidebar_inner_2">
          <h2><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Important<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
          <ul class="dashboard_important_list">
          
          <?php $_from = $this->_tpl_vars['important_items']->data; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['important_item']):
?>
            <li class="<?php echo $this->_tpl_vars['important_item']['class']; ?>
">
              <a href="<?php echo $this->_tpl_vars['important_item']['url']; ?>
">
                <?php if ($this->_tpl_vars['important_item']['icon']): ?>
                  <img src="<?php echo $this->_tpl_vars['important_item']['icon']; ?>
" alt="" />
                <?php endif; ?>
                <span><?php echo $this->_tpl_vars['important_item']['label']; ?>
</span></a>
            </li>
          <?php endforeach; endif; unset($_from); ?>
          </ul>
        </div></div></div>
        <script type="text/javascript">
          App.widgets.DashboardImportantItems.init('dashboard_important');
        </script>
        <?php endif; ?>
            
        <div class="dashboard_sidebar" id="pinned_projects"><div class="dashboard_sidebar_inner"><div class="dashboard_sidebar_inner_2">
          <h2><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Favorite Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
          <ul class="dashboard_sidebar_list">
          <?php if (is_foreachable ( $this->_tpl_vars['pinned_projects'] )): ?>
            <?php $_from = $this->_tpl_vars['pinned_projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project']):
?>
            <li class="with_icon pinned_project" id="project_<?php echo $this->_tpl_vars['project']->getId(); ?>
">
              <a href="<?php echo $this->_tpl_vars['project']->getUnpinUrl(); ?>
" class="unpin"><?php echo smarty_function_image(array('name' => "dismiss.gif"), $this);?>
</a>
              <img src="<?php echo $this->_tpl_vars['project']->getIconUrl(); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
" />
              <span class="name"><?php echo smarty_function_project_link(array('project' => $this->_tpl_vars['project']), $this);?>
</span>
            </li>
            <?php endforeach; endif; unset($_from); ?>
          <?php endif; ?>
            <li class="drop_here"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Drop project here<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
          </ul>
        </div></div></div>
        <script type="text/javascript">
          App.widgets.DashboardFavoriteProjects.init('pinned_projects');
        </script>
        
        <div class="dashboard_sidebar alt" id="who_is_online"><div class="dashboard_sidebar_inner"><div class="dashboard_sidebar_inner_2">
          <div class="title">
            <h2><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Who is Online?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
          </div>

          <div id="who_is_online_container">
          <?php if (is_foreachable ( $this->_tpl_vars['online_users'] )): ?>
            <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>People who were online in the last 15 minutes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
            <ul class="online_users_list dashboard_sidebar_list">
            <?php $_from = $this->_tpl_vars['online_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
              <li class="with_icon">
                <img src="<?php echo $this->_tpl_vars['user']->getAvatarUrl(); ?>
" alt="" />
                <span class="name" title="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['user']->getLastActivityOn())) ? $this->_run_mod_handler('datetime', true, $_tmp) : smarty_modifier_datetime($_tmp)))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"><?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['user']), $this);?>
</span>
              </li>
            <?php endforeach; endif; unset($_from); ?>
            </ul>
            <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Loaded at<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['request_time'])) ? $this->_run_mod_handler('time', true, $_tmp) : smarty_modifier_time($_tmp)); ?>
</p>
          <?php else: ?>
            <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Nobody was online in the last 15 minutes<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
          <?php endif; ?>
          </div>
        </div></div></div>
      </div>
    </div>
  </div>
  <!-- / Dashboard top sections -->
<?php endif; ?>
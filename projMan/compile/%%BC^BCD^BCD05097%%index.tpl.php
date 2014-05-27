<?php /* Smarty version 2.6.16, created on 2012-07-06 11:56:09
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/projects/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/projects/index.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/projects/index.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/projects/index.tpl', 10, false),array('block', 'pagination', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/projects/index.tpl', 24, false),array('block', 'link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/projects/index.tpl', 64, false),array('function', 'assemble', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/projects/index.tpl', 12, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/projects/index.tpl', 36, false),array('function', 'project_card', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/projects/index.tpl', 37, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/projects/index.tpl', 80, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Active Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Active Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="projects" class="list_view">
  <div class="object_list">
    <?php if ($this->_tpl_vars['logged_user']->isOwner()): ?>
    <p class="pagination top" id="group_projects_by">
      <span class="inner_pagination">
      <?php if ($this->_tpl_vars['group_by'] == 'client'): ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Client<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
      <?php else: ?>
        <a href="<?php echo smarty_function_assemble(array('route' => 'projects','group_by' => 'client'), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Client<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> 
      <?php endif; ?>
        | 
      <?php if ($this->_tpl_vars['group_by'] == 'group'): ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
      <?php else: ?>
        <a href="<?php echo smarty_function_assemble(array('route' => 'projects','group_by' => 'group'), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> 
      <?php endif; ?>
      </span>
    </p>
    <?php endif; ?>
  <?php if ($this->_tpl_vars['group_by'] == 'client' && instance_of ( $this->_tpl_vars['selected_company'] , 'Company' )): ?>
    <p class="pagination top"><span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'projects','page' => '-PAGE-','company_id' => $this->_tpl_vars['selected_company']->getId(),'group_by' => $this->_tpl_vars['group_by']), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
  <?php elseif ($this->_tpl_vars['group_by'] == 'group' && instance_of ( $this->_tpl_vars['selected_group'] , 'ProjectGroup' )): ?>
    <p class="pagination top"><span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'projects','page' => '-PAGE-','group_id' => $this->_tpl_vars['selected_group']->getId(),'group_by' => $this->_tpl_vars['group_by']), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
  <?php else: ?>
    <p class="pagination top"><span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'projects','page' => '-PAGE-','group_by' => $this->_tpl_vars['group_by']), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></p>
  <?php endif; ?>
    
    <div class="clear"></div>
    
  <?php if (is_foreachable ( $this->_tpl_vars['projects'] )): ?>
    <table class="projects_table">
    <?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project']):
?>
      <tr class="project_row <?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
      <?php echo smarty_function_project_card(array('project' => $this->_tpl_vars['project']), $this);?>

      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
    
    <?php if (( $this->_tpl_vars['pagination']->getLastPage() > 1 ) && ! $this->_tpl_vars['pagination']->isLast()): ?>
      <?php if ($this->_tpl_vars['group_by'] == 'client' && instance_of ( $this->_tpl_vars['selected_company'] , 'Company' )): ?>
        <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'projects','page' => $this->_tpl_vars['pagination']->getNextPage(),'company_id' => $this->_tpl_vars['selected_company']->getId(),'group_by' => $this->_tpl_vars['group_by']), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
      <?php elseif ($this->_tpl_vars['group_by'] == 'group' && instance_of ( $this->_tpl_vars['selected_group'] , 'ProjectGroup' )): ?>
        <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'projects','page' => $this->_tpl_vars['pagination']->getNextPage(),'group_id' => $this->_tpl_vars['selected_group']->getId(),'group_by' => $this->_tpl_vars['group_by']), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
      <?php else: ?>
        <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'projects','page' => $this->_tpl_vars['pagination']->getNextPage(),'group_by' => $this->_tpl_vars['group_by']), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
      <?php endif; ?>
    <?php endif; ?>
    
  <?php else: ?>
    <?php if (instance_of ( $this->_tpl_vars['selected_group'] , 'ProjectGroup' )): ?>
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no active projects in this group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
    <?php else: ?>
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no active projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
    <?php endif; ?>
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['group_by'] == 'client'): ?>
    <?php if (instance_of ( $this->_tpl_vars['selected_company'] , 'Company' )): ?>
      <p class="archive_link"><a href="<?php echo smarty_function_assemble(array('route' => 'projects_archive','group_by' => 'client','company_id' => $this->_tpl_vars['selected_company']->getId()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Archive<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
    <?php else: ?>
      <p class="archive_link"><?php $this->_tag_stack[] = array('link', array('href' => '?route=projects_archive&group_by=client')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Archive<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
    <?php endif; ?>
  <?php else: ?>
    <?php if (instance_of ( $this->_tpl_vars['selected_group'] , 'ProjectGroup' )): ?>
      <p class="archive_link"><a href="<?php echo smarty_function_assemble(array('route' => 'projects_archive','group_by' => 'group','group_id' => $this->_tpl_vars['selected_group']->getId()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Archive<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
    <?php else: ?>
      <p class="archive_link"><?php $this->_tag_stack[] = array('link', array('href' => '?route=projects_archive&group_by=group')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Archive<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
    <?php endif; ?>
  <?php endif; ?>
  </div>

<?php if ($this->_tpl_vars['group_by'] == 'client'): ?>
  <ul class="category_list">
    <li <?php if ($this->_tpl_vars['selected_company']->isOwner()): ?>class="selected"<?php endif; ?>><a href="<?php echo smarty_function_assemble(array('route' => 'projects','group_by' => 'client'), $this);?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Internal Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
<?php if (is_foreachable ( $this->_tpl_vars['companies'] )): ?>
  <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['company']):
?>
    <li <?php if (instance_of ( $this->_tpl_vars['selected_company'] , 'Company' ) && $this->_tpl_vars['selected_company']->getId() == $this->_tpl_vars['company']->getId()): ?>class="selected"<?php endif; ?>><a href="<?php echo smarty_function_assemble(array('route' => 'projects','company_id' => $this->_tpl_vars['company']->getId(),'group_by' => 'client'), $this);?>
"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span></a></li>
  <?php endforeach; endif; unset($_from);  endif; ?>
  </ul>
<?php else: ?>
  <ul class="category_list project_group_list">
    <li <?php if (! instance_of ( $this->_tpl_vars['selected_group'] , 'ProjectGroup' )): ?>class="selected"<?php endif; ?>><a href="<?php echo smarty_function_assemble(array('route' => 'projects','group_by' => 'group'), $this);?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Active Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
<?php if (is_foreachable ( $this->_tpl_vars['groups'] )): ?>
  <?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
    <li project_group_id="<?php echo $this->_tpl_vars['group']->getId(); ?>
" <?php if (instance_of ( $this->_tpl_vars['selected_group'] , 'ProjectGroup' ) && $this->_tpl_vars['selected_group']->getId() == $this->_tpl_vars['group']->getId()): ?>class="selected"<?php endif; ?>><a href="<?php echo smarty_function_assemble(array('route' => 'projects','group_id' => $this->_tpl_vars['group']->getId(),'group_by' => 'group'), $this);?>
"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['group']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span></a></li>
  <?php endforeach; endif; unset($_from); ?>
  <?php if ($this->_tpl_vars['logged_user']->isProjectManager() || $this->_tpl_vars['logged_user']->isAdministrator()): ?>
    <li id="manage_project_groups"><a href="<?php echo smarty_function_assemble(array('route' => 'project_groups'), $this);?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manage Groups<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
  <?php endif;  endif; ?>
  </ul>
  <script type="text/javascript">
    App.system.ManageProjectGroups.init('manage_project_groups');
  </script>
<?php endif; ?>
  
  <div class="clear"></div>
</div>
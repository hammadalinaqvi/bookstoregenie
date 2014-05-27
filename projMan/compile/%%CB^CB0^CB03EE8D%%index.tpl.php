<?php /* Smarty version 2.6.16, created on 2012-07-09 14:14:00
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/index.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/index.tpl', 2, false),array('block', 'link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/index.tpl', 15, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/index.tpl', 24, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/index.tpl', 8, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/index.tpl', 13, false),array('function', 'user_link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/index.tpl', 20, false),array('function', 'image_url', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project_people/index.tpl', 35, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>People<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="people">
<?php if (is_foreachable ( $this->_tpl_vars['people'] )):  $_from = $this->_tpl_vars['people']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project_company']):
?>
  <div class="company">
    <h2 class="section_name"><span class="section_name_span"><a href="<?php echo $this->_tpl_vars['project_company']['company']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['project_company']['company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></span></h2>
    <div class="section_container">
      <table class="users">
        <tbody>
        <?php $_from = $this->_tpl_vars['project_company']['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
          <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
            <td class="avatar">
              <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['user']->getViewUrl())); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <img src="<?php echo $this->_tpl_vars['user']->getAvatarUrl(false); ?>
" alt="" />
              <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </td>
            <td class="name">
              <h3><?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['user']), $this);?>
</h3>
            </td>
            <td class="meta">
              <dl>
                <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
                <dd><a href="mailto:<?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getEmail())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getEmail())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></dd>
              <?php if ($this->_tpl_vars['user']->getConfigValue('im_type') && $this->_tpl_vars['user']->getConfigValue('im_value')): ?>
                <dt><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getConfigValue('im_type'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dt>
                <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getConfigValue('im_value'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
              <?php endif; ?>
              </dl>
            </td>
            <td class="role"><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getVerboseProjectRole($this->_tpl_vars['active_project']))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</td>
            <td class="options">
            <?php if ($this->_tpl_vars['logged_user']->canChangeProjectPermissions($this->_tpl_vars['user'],$this->_tpl_vars['active_project'])): ?>
              <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['active_project']->getUserPermissionsUrl($this->_tpl_vars['user']),'title' => 'Change Permissions')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-permissions.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php endif; ?>
            
            <?php if ($this->_tpl_vars['logged_user']->canRemoveFromProject($this->_tpl_vars['user'],$this->_tpl_vars['active_project'])): ?>
              <?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['active_project']->getRemoveUserUrl($this->_tpl_vars['user']),'method' => 'post','title' => 'Remove from Project')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
" alt="" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
            <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; endif; unset($_from); ?>
        </tbody>
      </table>
    </div>
  </div>
<?php endforeach; endif; unset($_from);  else: ?>
  <p><?php $this->_tag_stack[] = array('lang', array('url' => $this->_tpl_vars['active_project']->getAddPeopleUrl())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href=":url">Click here</a> to add users to this project.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>
</div>
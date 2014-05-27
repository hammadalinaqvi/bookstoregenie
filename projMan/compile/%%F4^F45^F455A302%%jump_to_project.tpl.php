<?php /* Smarty version 2.6.16, created on 2012-07-09 14:34:14
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/widgets/jump_to_project.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/widgets/jump_to_project.tpl', 3, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/widgets/jump_to_project.tpl', 6, false),array('function', 'project_icon', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/widgets/jump_to_project.tpl', 7, false),array('function', 'assemble', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/widgets/jump_to_project.tpl', 8, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/widgets/jump_to_project.tpl', 8, false),)), $this); ?>
<div id="jump_to_project">
<?php if (is_foreachable ( $this->_tpl_vars['pinned_projects'] )): ?>
  <h3><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Favorite Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
  <table>
  <?php $_from = $this->_tpl_vars['pinned_projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project_id'] => $this->_tpl_vars['project_name']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even','name' => 'pinned_projects'), $this);?>
">
      <td class="icon"><img src="<?php echo smarty_function_project_icon(array('project' => $this->_tpl_vars['project_id'],'large' => false), $this);?>
" alt="" /></td>
      <td class="name"><a href="<?php echo smarty_function_assemble(array('route' => 'project_overview','project_id' => $this->_tpl_vars['project_id']), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['project_name'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
<?php endif; ?>

<?php if (is_foreachable ( $this->_tpl_vars['active_projects'] )): ?>
  <?php if (is_foreachable ( $this->_tpl_vars['pinned_projects'] )): ?>
  <h3><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Other active projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
  <?php endif; ?>
  <table>
  <?php $_from = $this->_tpl_vars['active_projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project_id'] => $this->_tpl_vars['project_name']):
?>
    <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even','name' => 'active_projects'), $this);?>
">
      <td class="icon"><img src="<?php echo smarty_function_project_icon(array('project' => $this->_tpl_vars['project_id'],'large' => false), $this);?>
" alt="" /></td>
      <td class="name"><a href="<?php echo smarty_function_assemble(array('route' => 'project_overview','project_id' => $this->_tpl_vars['project_id']), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['project_name'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
<?php endif; ?>

<?php if (! is_foreachable ( $this->_tpl_vars['pinned_projects'] ) && ! is_foreachable ( $this->_tpl_vars['active_projects'] )): ?>
  <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no active projects you are working on<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
<?php endif; ?>
</div>
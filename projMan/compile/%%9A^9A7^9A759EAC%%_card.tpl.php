<?php /* Smarty version 2.6.16, created on 2012-07-09 14:34:17
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/project/_card.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/_card.tpl', 1, false),array('modifier', 'date', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/_card.tpl', 13, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/_card.tpl', 5, false),array('function', 'user_link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/_card.tpl', 6, false),array('function', 'project_progress', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/project/_card.tpl', 18, false),)), $this); ?>
<td class="icon"><img src="<?php echo $this->_tpl_vars['_card_project']->getIconUrl(true); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['_card_project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
" /></td>
<td class="name">
  <h3><a href="<?php echo $this->_tpl_vars['_card_project']->getOverviewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['_card_project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></h3>
  <dl>
    <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Leader<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
    <dd><?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['_card_project']->getLeader()), $this);?>
</dd>
  <?php if (instance_of ( $this->_tpl_vars['_card_project_company'] , 'Company' )): ?>
    <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Client<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
    <dd><a href="<?php echo $this->_tpl_vars['_card_project_company']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['_card_project_company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></dd>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['_card_project']->getStartsOn()): ?>
    <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Starts On<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
    <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['_card_project']->getStartsOn())) ? $this->_run_mod_handler('date', true, $_tmp, 0) : smarty_modifier_date($_tmp, 0)); ?>
</dd>
  <?php endif; ?>
  </dl>
</td>
<td class="progress">
  <?php echo smarty_function_project_progress(array('project' => $this->_tpl_vars['_card_project']), $this);?>

</td>
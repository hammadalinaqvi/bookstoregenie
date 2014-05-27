<?php /* Smarty version 2.6.16, created on 2012-07-11 11:31:28
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/index.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/index.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/index.tpl', 6, false),array('block', 'button', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/index.tpl', 62, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/index.tpl', 17, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/index.tpl', 20, false),array('modifier', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/index.tpl', 22, false),array('modifier', 'clickable', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/modules_admin/index.tpl', 22, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Modules<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Modules<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div id="modules_admin">
  <?php if (is_foreachable ( $this->_tpl_vars['modules'] )): ?>
  <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Installed modules<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
  <div id="modules" class="section_container">
    <table class="modules_list">
      <thead>
        <th class="icon_medium"></th>
        <th class="name"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th class="is_system"></th>
        <th class="version"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Version<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      </thead>
      <tbody>
      <?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
        <tr class="<?php echo smarty_function_cycle(array('values' => 'even, odd'), $this);?>
">
          <td class="icon_medium"><img src="<?php echo $this->_tpl_vars['module']->getIconUrl(); ?>
" alt="" /></td>
          <td class="name">
            <a href="<?php echo $this->_tpl_vars['module']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['module']->getDisplayName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a>
          <?php if ($this->_tpl_vars['module']->getDescription()): ?>
            <span class="details block"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['module']->getDescription())) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)))) ? $this->_run_mod_handler('clickable', true, $_tmp) : smarty_modifier_clickable($_tmp)); ?>
</span>
          <?php endif; ?>
          </td>
          <td class="is_system">
          <?php if ($this->_tpl_vars['module']->getIsSystem()): ?>
            <span class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>System<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
          <?php endif; ?>
          </td>
          <td class="version"><span class="details"><?php echo $this->_tpl_vars['module']->getVersion(); ?>
</span></td>
        </tr>
      <?php endforeach; endif; unset($_from); ?>
      </tbody>
    </table>
  </div>
  <?php else: ?>
  <p class="section_container"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No modules in database. Something is really wrong here :'(<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  <?php endif; ?>
  
  <?php if (is_foreachable ( $this->_tpl_vars['available_modules'] )): ?>
  <div id="available_modules">
    <h2 class="section_name"><span class="section_name_span"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Available modules<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></h2>
    <div class="section_container">
      <table class="modules_list">
        <thead>
          <th class="icon_medium"></th>
          <th class="name"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
          <th class="options"></th>
          <th class="version"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Version<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        </thead>
        <tbody>
        <?php $_from = $this->_tpl_vars['available_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
          <tr class="<?php echo smarty_function_cycle(array('values' => 'even, odd'), $this);?>
">
            <td class="icon_medium"><img src="<?php echo $this->_tpl_vars['module']->getIconUrl(); ?>
" alt="" /></td>
            <td class="name">
              <a href="<?php echo $this->_tpl_vars['module']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['module']->getDisplayName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a>
              <?php if ($this->_tpl_vars['module']->getDescription()): ?>
              <span class="details block"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['module']->getDescription())) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)))) ? $this->_run_mod_handler('clickable', true, $_tmp) : smarty_modifier_clickable($_tmp)); ?>
</span>
              <?php endif; ?>
            </td>
            <td class="options">
            <?php $this->_tag_stack[] = array('button', array('href' => $this->_tpl_vars['module']->getInstallUrl())); $_block_repeat=true;smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Install<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </td>
            <td class="version"><span class="details"><?php echo $this->_tpl_vars['module']->getVersion(); ?>
</span></td>
          </tr>
        <?php endforeach; endif; unset($_from); ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php endif; ?>
</div>
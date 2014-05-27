<?php /* Smarty version 2.6.16, created on 2012-07-09 20:32:41
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/user.tpl', 8, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/user.tpl', 14, false),)), $this); ?>
<div class="wrapper">
  <div class="box">
    <div class="object_main_info">
      <div class="icon">
        <img src="<?php echo $this->_tpl_vars['current_user']->getAvatarUrl(true); ?>
" alt="logo" />
      </div>
      <div class="name">
      <?php echo ((is_array($_tmp=$this->_tpl_vars['current_user']->getDisplayName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>

      </div>
      <div class="clear"></div>
    </div>
    <dl class="object_details">
    <?php if ($this->_tpl_vars['current_user']->getConfigValue('title')): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['current_user']->getConfigValue('title'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
    <?php endif; ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><a href="mailto:<?php echo ((is_array($_tmp=$this->_tpl_vars['current_user']->getEmail())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
}"><?php echo ((is_array($_tmp=$this->_tpl_vars['current_user']->getEmail())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></dd>
    <?php if ($this->_tpl_vars['current_user']->getConfigValue('phone_work')): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Work Phone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['current_user']->getConfigValue('phone_work'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['current_user']->getConfigValue('phone_mobile')): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Mobile Phone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['current_user']->getConfigValue('phone_mobile'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['current_user']->getConfigValue('im_type') && $this->_tpl_vars['current_user']->getConfigValue('im_value')): ?>
      <dt><?php echo ((is_array($_tmp=$this->_tpl_vars['current_user']->getConfigValue('im_type'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['current_user']->getConfigValue('im_value'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
    <?php endif; ?>
    </dl>
  </div>
</div>
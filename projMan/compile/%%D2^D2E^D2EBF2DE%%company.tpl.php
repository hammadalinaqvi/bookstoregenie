<?php /* Smarty version 2.6.16, created on 2012-07-09 20:32:31
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/company.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/company.tpl', 8, false),array('modifier', 'nl2br', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/company.tpl', 15, false),array('modifier', 'excerpt', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/company.tpl', 37, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/company.tpl', 14, false),array('function', 'mobile_access_get_view_url', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/views/mobile_access_people/company.tpl', 37, false),)), $this); ?>
<div class="wrapper">
  <div class="box">
    <div class="object_main_info">
      <div class="icon">
        <img src="<?php echo $this->_tpl_vars['current_company']->getLogoUrl(true); ?>
" alt="logo" />
      </div>
      <div class="name">
      <?php echo ((is_array($_tmp=$this->_tpl_vars['current_company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>

      </div>
      <div class="clear"></div>
    </div>
    <dl class="object_details">
    <?php if ($this->_tpl_vars['current_company']->getConfigValue('office_address')): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['current_company']->getConfigValue('office_address'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</dd>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['current_company']->getConfigValue('office_phone')): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Phone Number<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['current_company']->getConfigValue('office_phone'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['current_company']->getConfigValue('office_fax')): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fax Number<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['current_company']->getConfigValue('office_fax'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
    <?php endif; ?>
    <?php if (is_valid_url ( $this->_tpl_vars['current_company']->getConfigValue('office_homepage') )): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Homepage<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><a href="<?php echo $this->_tpl_vars['current_company']->getConfigValue('office_homepage'); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['current_company']->getConfigValue('office_homepage'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></dd>
    <?php endif; ?>
    </dl>
  </div>
  
  <?php if (is_foreachable ( $this->_tpl_vars['current_company_users'] )): ?>
  <h2 class="label"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
  <div class="box">
    <ul class="menu main_menu">
    <?php $_from = $this->_tpl_vars['current_company_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
      <li style="background-image: url(<?php echo $this->_tpl_vars['user']->getAvatarUrl(); ?>
)"><a href="<?php echo smarty_function_mobile_access_get_view_url(array('object' => $this->_tpl_vars['user']), $this);?>
"><span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['user']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('excerpt', true, $_tmp, 22) : smarty_modifier_excerpt($_tmp, 22)); ?>
</span></a></li>
    <?php endforeach; endif; unset($_from); ?>
    </ul>
  </div>
  <?php endif; ?>
  
  <?php if (is_foreachable ( $this->_tpl_vars['current_company_projects'] )): ?>
  <h2 class="label"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
  <div class="box">
    <ul class="menu main_menu">
    <?php $_from = $this->_tpl_vars['current_company_projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project']):
?>
      <li style="background-image: url(<?php echo $this->_tpl_vars['project']->getIconUrl(); ?>
)"><a href="<?php echo smarty_function_mobile_access_get_view_url(array('object' => $this->_tpl_vars['project']), $this);?>
"><span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('excerpt', true, $_tmp, 22) : smarty_modifier_excerpt($_tmp, 22)); ?>
</span></a></li>
    <?php endforeach; endif; unset($_from); ?>
    </ul>
  </div>
  <?php endif; ?>
  
  
</div>
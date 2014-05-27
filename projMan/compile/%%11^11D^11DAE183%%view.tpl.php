<?php /* Smarty version 2.6.16, created on 2012-07-09 12:42:09
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/companies/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/companies/view.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/companies/view.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/companies/view.tpl', 19, false),array('function', 'page_object', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/companies/view.tpl', 3, false),array('function', 'object_quick_options', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/companies/view.tpl', 5, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/companies/view.tpl', 58, false),array('function', 'user_link', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/companies/view.tpl', 61, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/companies/view.tpl', 20, false),array('modifier', 'nl2br', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/companies/view.tpl', 25, false),array('modifier', 'ago', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/companies/view.tpl', 64, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array('not_lang' => true)); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['active_company']->getName();  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Profile<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  echo smarty_function_page_object(array('object' => $this->_tpl_vars['active_company']), $this);?>


<?php echo smarty_function_object_quick_options(array('object' => $this->_tpl_vars['active_company'],'user' => $this->_tpl_vars['logged_user']), $this);?>

<div class="company main_object" id="company_details">
  <div class="body">
    <?php if ($this->_tpl_vars['active_company']->canEdit($this->_tpl_vars['logged_user'])): ?>
      <a href="<?php echo $this->_tpl_vars['active_company']->getEditLogoUrl(); ?>
" id="select_company_icon">
        <img src="<?php echo $this->_tpl_vars['active_company']->getLogoUrl(true); ?>
" alt="" class="properties_icon" />
      </a>
    <script type="text/javascript">
      App.widgets.IconPicker.init('edit_icon','select_company_icon', App.lang('Change Logo'));
    </script>
    <?php else: ?>
      <img src="<?php echo $this->_tpl_vars['active_company']->getLogoUrl(true); ?>
" alt="" class="properties_icon" />    
    <?php endif; ?>
    <dl class="properties">
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
      
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd>
      <?php if ($this->_tpl_vars['active_company']->getConfigValue('office_address')): ?>
        <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['active_company']->getConfigValue('office_address'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

      <?php else: ?>
        <em><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>not set<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></em>
      <?php endif; ?>
      </dd>
    
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Phone Number<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd>
      <?php if ($this->_tpl_vars['active_company']->getConfigValue('office_phone')): ?>
        <?php echo ((is_array($_tmp=$this->_tpl_vars['active_company']->getConfigValue('office_phone'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>

      <?php else: ?>
        <em><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>not set<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></em>
      <?php endif; ?>
      </dd>
    <?php if ($this->_tpl_vars['active_company']->getConfigValue('office_fax')): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fax Number<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><?php echo ((is_array($_tmp=$this->_tpl_vars['active_company']->getConfigValue('office_fax'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
    <?php endif; ?>
    <?php if (is_valid_url ( $this->_tpl_vars['active_company']->getConfigValue('office_homepage') )): ?>
      <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Homepage<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
      <dd><a href="<?php echo $this->_tpl_vars['active_company']->getConfigValue('office_homepage'); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['active_company']->getConfigValue('office_homepage'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a></dd>
    <?php endif; ?>
    </dl>
    
    <div class="body content">
    <?php if (is_foreachable ( $this->_tpl_vars['users'] )): ?>
      <table>
        <tr>
          <th class="icon"></th>
          <th class="name"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Person<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
          <th class="last_activity"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Seen<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        </tr>
      <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
        <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
          <td class="icon"><img src="<?php echo $this->_tpl_vars['user']->getAvatarUrl(true); ?>
" alt="" /></td>
          <td class="name">
            <?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['user']), $this);?>

            <?php if ($this->_tpl_vars['user']->getConfigValue('title')): ?><span class="details block"><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getConfigValue('title'))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span><?php endif; ?>
          </td>
          <td class="last_activity details"><?php if ($this->_tpl_vars['logged_user']->getId() != $this->_tpl_vars['user']->getId()):  echo ((is_array($_tmp=$this->_tpl_vars['user']->getLastActivityOn())) ? $this->_run_mod_handler('ago', true, $_tmp) : smarty_modifier_ago($_tmp));  endif; ?></td>
        </tr>
      <?php endforeach; endif; unset($_from); ?>
      </table>
    <?php else: ?>
      <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no users in this company<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  if ($this->_tpl_vars['add_user_url']): ?>. <?php $this->_tag_stack[] = array('lang', array('add_url' => $this->_tpl_vars['add_user_url'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Would you like to <a href=":add_url">create one</a>?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif; ?></p>
    <?php endif; ?>
    </div>
  </div>
</div>
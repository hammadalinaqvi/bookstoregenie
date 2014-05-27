<?php /* Smarty version 2.6.16, created on 2012-07-09 20:31:23
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/wireframe.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'page_head_tags', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/wireframe.tpl', 8, false),array('function', 'assemble', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/wireframe.tpl', 32, false),array('function', 'mobile_access_project_breadcrumbs', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/wireframe.tpl', 40, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/wireframe.tpl', 11, false),array('modifier', 'excerpt', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/wireframe.tpl', 21, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/wireframe.tpl', 13, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['module_assets_url']; ?>
/<?php echo $this->_tpl_vars['mobile_device']; ?>
/stylesheets/style.css" type="text/css" media="screen" id="style_main_css"/>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['module_assets_url']; ?>
/js.php?device=<?php echo $this->_tpl_vars['mobile_device']; ?>
"></script>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=320"/>
    <?php echo smarty_function_page_head_tags(array(), $this);?>

    <title>
    <?php if ($this->_tpl_vars['page_title']): ?>
      <?php echo ((is_array($_tmp=$this->_tpl_vars['page_title'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>

    <?php else: ?>
      <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?> / <?php echo ((is_array($_tmp=$this->_tpl_vars['owner_company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</title>
  </head>
  
  <body>
    <div id="main_title">
      <h1>
      <?php if ($this->_tpl_vars['page_title']): ?>
        <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['page_title'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('excerpt', true, $_tmp, 18) : smarty_modifier_excerpt($_tmp, 18)); ?>

      <?php else: ?>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php endif; ?>
      </h1>
      
      <?php if ($this->_tpl_vars['page_back_url']): ?>
        <a href="<?php echo $this->_tpl_vars['page_back_url']; ?>
" class="button_back" id="button_back"><span>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Up<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </span></a>
      <?php else: ?>
        <a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access'), $this);?>
" class="button_back" id="button_back"><span>
        <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Home<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </span></a>
      <?php endif; ?>
      <a href="#" class="button_menu" id="button_menu"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Menu<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a>
    </div>
      
    <div id="app_body">     
      <?php echo smarty_function_mobile_access_project_breadcrumbs(array('breadcrumbs' => $this->_tpl_vars['page_breadcrumbs']), $this);?>

      <?php echo $this->_tpl_vars['content_for_layout']; ?>

    </div>
    
    <div id="overlay_menu">
      <div class="black_overlay"></div>
      <div id="overlay_profile_menu">
        <a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access_logout'), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Logout<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
        <span><?php echo $this->_tpl_vars['logged_user']->getDisplayName(); ?>
</span>
      </div>
      <ul id="overlay_main_menu">
        <li><a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access'), $this);?>
" class="icon_big_home"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Home<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
        <li><a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access_assignments'), $this);?>
" class="icon_big_assignments"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
        <li><a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access_starred'), $this);?>
" class="icon_big_starred"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Starred<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
        <li><a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access_people'), $this);?>
" class="icon_big_people"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>People<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
        <li><a href="<?php echo smarty_function_assemble(array('route' => 'mobile_access_projects'), $this);?>
" class="icon_big_projects"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Projects<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></li>
      </ul>
      <?php if ($this->_tpl_vars['project_sections']): ?>
      <div class="clear"></div>
      <div id="overlay_project_menu">
        <h3><?php echo ((is_array($_tmp=$this->_tpl_vars['active_project']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</h3>
        <ul>
          <?php $_from = $this->_tpl_vars['project_sections']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project_section']):
?>
            <?php if ($this->_tpl_vars['active_project_section'] == $this->_tpl_vars['project_section']['name']): ?>
            <li><a href="<?php echo $this->_tpl_vars['project_section']['url']; ?>
" class="selected"><?php echo $this->_tpl_vars['project_section']['full_name']; ?>
</a></li>
            <?php else: ?>
            <li><a href="<?php echo $this->_tpl_vars['project_section']['url']; ?>
"><?php echo $this->_tpl_vars['project_section']['full_name']; ?>
</a></li>
            <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
        </ul>
        <div class="clear"></div>
      </div>
      <?php endif; ?>
    </div>
  </body>
</html>
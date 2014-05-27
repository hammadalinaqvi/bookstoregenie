<?php /* Smarty version 2.6.16, created on 2012-07-09 20:13:45
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/auth.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'page_head_tags', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/auth.tpl', 8, false),array('function', 'image_url', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/auth.tpl', 15, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/auth.tpl', 11, false),array('modifier', 'excerpt', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/auth.tpl', 22, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/mobile_access/layouts/auth.tpl', 13, false),)), $this); ?>
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
    <!-- <link rel="shortcut icon" href="<?php echo smarty_function_image_url(array('name' => 'favicon.png'), $this);?>
" type="image/x-icon" /> -->
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
    </div>
      
    <div id="app_body">     
      <?php echo $this->_tpl_vars['content_for_layout']; ?>

    </div>

  </body>
</html>
<?php /* Smarty version 2.6.16, created on 2012-07-06 11:50:36
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'assign_var', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 4, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 48, false),array('block', 'link', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 64, false),array('function', 'template_vars_to_js', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 20, false),array('function', 'js_langs', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 23, false),array('function', 'page_head_tags', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 33, false),array('function', 'page_title', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 34, false),array('function', 'brand', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 35, false),array('function', 'assemble', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 64, false),array('function', 'menu', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 71, false),array('function', 'image_url', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 119, false),array('function', 'counter', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 133, false),array('function', 'flash_box', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 182, false),array('function', 'year', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 194, false),array('function', 'benchmark', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 198, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 34, false),array('modifier', 'excerpt', '/home/books1/public_html/projMan/activecollab/application/modules/system/layouts/wireframe.tpl', 174, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">
  <head>
    <?php $this->_tag_stack[] = array('assign_var', array('name' => 'assets_query_string')); $_block_repeat=true;smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>v=<?php echo $this->_tpl_vars['application']->version; ?>
&modules=<?php $_from = $this->_tpl_vars['loaded_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['loaded_module']):
 echo $this->_tpl_vars['loaded_module']->getName(); ?>
,<?php endforeach; endif; unset($_from);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_assign_var($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['assets_url']; ?>
/css.php?<?php echo $this->_tpl_vars['assets_query_string']; ?>
" type="text/css" media="screen" id="style_main_css"/>
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['assets_url']; ?>
/themes/<?php echo $this->_tpl_vars['theme_name']; ?>
/theme.css" type="text/css" media="screen" id="style_theme_css"/>
    
    <!--[if IE]>
      <link rel="stylesheet" href="<?php echo $this->_tpl_vars['assets_url']; ?>
/stylesheets/iefix.css" type="text/css" />
      <link rel="stylesheet" href="<?php echo $this->_tpl_vars['assets_url']; ?>
/themes/<?php echo $this->_tpl_vars['theme_name']; ?>
/iefix.css" type="text/css" media="screen"/>
    <![endif]-->
    
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['assets_url']; ?>
/print.php?<?php echo $this->_tpl_vars['assets_query_string']; ?>
" type="text/css" media="print" />
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['assets_url']; ?>
/themes/<?php echo $this->_tpl_vars['theme_name']; ?>
/print.css" type="text/css" media="print" />
    <link rel="alternate stylesheet" href="<?php echo $this->_tpl_vars['assets_url']; ?>
/print_preview.php?theme_name=<?php echo $this->_tpl_vars['theme_name']; ?>
" type="text/css" media="screen" id="print_preview_css" disabled="true" />
    
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['assets_url']; ?>
/js.php?<?php echo $this->_tpl_vars['assets_query_string']; ?>
"></script>
    <?php echo smarty_function_template_vars_to_js(array(), $this);?>

    
    <?php if (instance_of ( $this->_tpl_vars['current_language'] , 'Language' )): ?>
      <?php echo smarty_function_js_langs(array('locale' => $this->_tpl_vars['current_language']->getLocale()), $this);?>

    <?php endif; ?>
    <script type="text/javascript">
      if(App.<?php echo $this->_tpl_vars['request']->getModule(); ?>
 && App.<?php echo $this->_tpl_vars['request']->getModule(); ?>
.controllers.<?php echo $this->_tpl_vars['request']->getController(); ?>
) {
        if(typeof(App.<?php echo $this->_tpl_vars['request']->getModule(); ?>
.controllers.<?php echo $this->_tpl_vars['request']->getController(); ?>
.<?php echo $this->_tpl_vars['request']->getAction(); ?>
) == 'function') {
          App.<?php echo $this->_tpl_vars['request']->getModule(); ?>
.controllers.<?php echo $this->_tpl_vars['request']->getController(); ?>
.<?php echo $this->_tpl_vars['request']->getAction(); ?>
();
        }
      }
    </script>
    
    <?php echo smarty_function_page_head_tags(array(), $this);?>

    <title><?php echo smarty_function_page_title(array('default' => 'Projects'), $this);?>
 / <?php echo ((is_array($_tmp=$this->_tpl_vars['owner_company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</title>
    <link rel="shortcut icon" href="<?php echo smarty_function_brand(array('what' => 'favicon'), $this);?>
" type="image/x-icon" />
    
    <?php if (is_foreachable ( $this->_tpl_vars['wireframe']->rss_feeds )): ?>
      <?php $_from = $this->_tpl_vars['wireframe']->rss_feeds; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rss_feed']):
?>
        <link rel="alternate" type="<?php echo $this->_tpl_vars['rss_feed']['feed_type']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['rss_feed']['title'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
" href="<?php echo $this->_tpl_vars['rss_feed']['url']; ?>
" />
      <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
  </head>
  <body style="margin: 0">
  
    <!-- Print Preview -->
    <div id="print_preview_header">
      <ul>
        <li><button type="button" id="print_preview_print"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Print<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></button></li>
        <li><button type="button" id="print_preview_close"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Close Preview<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></button></li>
      </ul>
      <h2><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Print Preview<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
    </div>
    
    <!-- Top block -->
    <div id="top">
    	<div class="container">
    	  <p id="logged_user">
    	  <?php if ($this->_tpl_vars['logged_user']->getFirstName()): ?>
    	    <?php $this->assign('_welcome_name', $this->_tpl_vars['logged_user']->getFirstName()); ?>
    	  <?php else: ?>
    	    <?php $this->assign('_welcome_name', $this->_tpl_vars['logged_user']->getDisplayName()); ?>
    	  <?php endif; ?>
    	    <span class="inner">
      	    <?php $this->_tag_stack[] = array('lang', array('name' => $this->_tpl_vars['_welcome_name'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Welcome back :name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> | <?php if ($this->_tpl_vars['logged_user']->isAdministrator()): ?><a href="<?php echo smarty_function_assemble(array('route' => 'admin'), $this);?>
" class="<?php if ($this->_tpl_vars['wireframe']->current_menu_item == 'admin'): ?>active<?php endif; ?>"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Admin<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> | <?php endif; ?> <a href="<?php echo $this->_tpl_vars['logged_user']->getViewUrl(); ?>
" class="<?php if ($this->_tpl_vars['wireframe']->current_menu_item == 'profile'): ?>active<?php endif; ?>"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Profile<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a> | <?php $this->_tag_stack[] = array('link', array('href' => '?route=logout')); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Logout<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    	    </span>
    	  </p>
        <div id="header">
        	<p id="site_log">
        	  <a href="<?php echo smarty_function_assemble(array('route' => 'homepage'), $this);?>
" class="site_logo"><img src="<?php echo smarty_function_brand(array('what' => 'logo'), $this);?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['owner_company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
 logo" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Back to start page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /></a>
        	</p>
        	<?php echo smarty_function_menu(array(), $this);?>

        	<?php echo '
        	<script type="text/javascript">
        	   App.MainMenu.init(\'menu\');
        	</script>
        	'; ?>

        </div>
      </div>
    </div>
    
    <?php if (isset ( $this->_tpl_vars['page_tabs'] )): ?>
    <div id="tabs">
    	<div class="container">
      	<ul>
      	<?php $_from = $this->_tpl_vars['page_tabs']->data; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['page_tabs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['page_tabs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['current_tab_name'] => $this->_tpl_vars['current_tab']):
        $this->_foreach['page_tabs']['iteration']++;
?>
      	  <li <?php if ($this->_foreach['page_tabs']['iteration'] == 1): ?>class="first"<?php endif; ?> id="page_tab_<?php echo $this->_tpl_vars['current_tab_name']; ?>
"><a href="<?php echo $this->_tpl_vars['current_tab']['url']; ?>
" <?php if ($this->_tpl_vars['current_tab_name'] == $this->_tpl_vars['page_tab']): ?>class="current"<?php endif; ?>><span><?php echo ((is_array($_tmp=$this->_tpl_vars['current_tab']['text'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span></a></li>
      	<?php endforeach; endif; unset($_from); ?>
        </ul>
      </div>
    </div>
    <?php endif; ?>
    
    <div id="page_header_container">
    	<div class="container">
        <div id="page_header" class="<?php if ($this->_tpl_vars['wireframe']->details): ?>with_page_details<?php else: ?>without_page_details<?php endif; ?>">
	      <div class="page_info_container">
	      <?php if (instance_of ( $this->_tpl_vars['wireframe']->page_company , 'Company' ) && instance_of ( $this->_tpl_vars['wireframe']->page_project , 'Project' )): ?>
	        <h1 id="page_title"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['wireframe']->page_company->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
 | <?php echo ((is_array($_tmp=$this->_tpl_vars['wireframe']->page_project->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
 | </span> <?php echo smarty_function_page_title(array('default' => 'Page'), $this);?>
</h1>
	      <?php elseif (instance_of ( $this->_tpl_vars['wireframe']->page_company , 'Company' )): ?>
	        <h1 id="page_title"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['wireframe']->page_company->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
 | </span> <?php echo smarty_function_page_title(array('default' => 'Page'), $this);?>
</h1>
	      <?php else: ?>
	        <h1 id="page_title"><?php echo smarty_function_page_title(array('default' => 'Page'), $this);?>
</h1>
	      <?php endif; ?>
	      
  				<?php if ($this->_tpl_vars['wireframe']->details): ?>
  				<p id="page_details"><?php echo $this->_tpl_vars['wireframe']->details; ?>
</p>
  				<?php endif; ?>
				</div>
		  <?php $this->assign('page_actions', $this->_tpl_vars['wireframe']->getSortedPageActions()); ?>
  	  <?php if ($this->_tpl_vars['wireframe']->print_button || is_foreachable ( $this->_tpl_vars['page_actions'] )): ?>
  	    <ul id="page_actions">
  	    <?php if (is_foreachable ( $this->_tpl_vars['page_actions'] )): ?>
  	    <?php $_from = $this->_tpl_vars['page_actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['page_actions'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['page_actions']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['page_action_name'] => $this->_tpl_vars['page_action']):
        $this->_foreach['page_actions']['iteration']++;
?>
  	      <?php if (count ( $this->_tpl_vars['page_actions'] ) == 1): ?>
  	        <li id="<?php echo $this->_tpl_vars['page_action_name']; ?>
_page_action" class="single <?php if (is_foreachable ( $this->_tpl_vars['page_action']['subitems'] )): ?>with_subitems hoverable<?php else: ?>without_subitems<?php endif; ?>">
  	      <?php else: ?>
    	      <li id="<?php echo $this->_tpl_vars['page_action_name']; ?>
_page_action" class="<?php if (($this->_foreach['page_actions']['iteration'] <= 1)): ?>first<?php elseif (($this->_foreach['page_actions']['iteration'] == $this->_foreach['page_actions']['total'])): ?>last <?php endif; ?> <?php if (is_foreachable ( $this->_tpl_vars['page_action']['subitems'] )): ?>with_subitems hoverable<?php else: ?>without_subitems<?php endif; ?>">
  	      <?php endif; ?>
  	        <?php $this->_tag_stack[] = array('link', array('id' => $this->_tpl_vars['page_action']['id'],'href' => $this->_tpl_vars['page_action']['url'],'method' => $this->_tpl_vars['page_action']['method'],'confirm' => $this->_tpl_vars['page_action']['confirm'],'not_lang' => true)); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span><?php echo ((is_array($_tmp=$this->_tpl_vars['page_action']['text'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
 <?php if (is_foreachable ( $this->_tpl_vars['page_action']['subitems'] )): ?><img src="<?php echo smarty_function_image_url(array('name' => 'dropdown_arrow.gif'), $this);?>
" alt="" /><?php endif; ?></span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  	        
  	        <?php if (is_foreachable ( $this->_tpl_vars['page_action']['subitems'] )): ?>
  	        <ul>
  	        <?php $_from = $this->_tpl_vars['page_action']['subitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page_action_subaction_name'] => $this->_tpl_vars['page_action_subaction']):
?>
  	          <?php if ($this->_tpl_vars['page_action_subaction']['text'] && $this->_tpl_vars['page_action_subaction']['url']): ?>
  	          <li id="<?php echo $this->_tpl_vars['page_action_subaction_name']; ?>
_page_action" class="subaction"><?php $this->_tag_stack[] = array('link', array('href' => $this->_tpl_vars['page_action_subaction']['url'],'method' => $this->_tpl_vars['page_action_subaction']['method'],'id' => $this->_tpl_vars['page_action_subaction']['id'],'confirm' => $this->_tpl_vars['page_action_subaction']['confirm'])); $_block_repeat=true;smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo ((is_array($_tmp=$this->_tpl_vars['page_action_subaction']['text'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp));  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_link($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
  	          <?php else: ?>
  	          <li id="<?php echo $this->_tpl_vars['page_action_subaction_name']; ?>
_page_action" class="separator"></li>
  	          <?php endif; ?>
  	        <?php endforeach; endif; unset($_from); ?>
  	        </ul>
  	        <?php endif; ?>
  	      </li>
  	        <?php echo smarty_function_counter(array('name' => 'actions_counter_name','assign' => 'actions_counter'), $this);?>

  	      <?php endforeach; endif; unset($_from); ?>
  	    <?php endif; ?>
  	    <?php if ($this->_tpl_vars['wireframe']->print_button): ?>
  	      <li class="single"><a href="javascript:window.print();" id="print_button"><span><img src="<?php echo smarty_function_image_url(array('name' => 'icons/print.gif'), $this);?>
" alt="Print" /></span></a></li>
  	    <?php endif; ?>
  			</ul>
  		<?php endif; ?>
 		  <div class="clear"></div>

  		  
		  </div>
      </div>
    </div>
    
    <div id="page">
    	<div class="container">
    	  <div class="container_inner">
    	  <?php if (WARN_WHEN_JAVASCRIPT_IS_DISABLED || is_foreachable ( $this->_tpl_vars['wireframe']->page_messages )): ?>
    	    <div id="page_messages">
    	    <?php if (is_foreachable ( $this->_tpl_vars['wireframe']->page_messages )): ?>
    		    <?php $_from = $this->_tpl_vars['wireframe']->page_messages; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['page_messages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['page_messages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['page_message']):
        $this->_foreach['page_messages']['iteration']++;
?>
  		      <div class="page_message <?php echo ((is_array($_tmp=$this->_tpl_vars['page_message']['class'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
 <?php if ($this->_foreach['page_messages']['iteration'] == 1): ?>first<?php endif; ?>" style="background-image: url('<?php echo $this->_tpl_vars['page_message']['icon']; ?>
')">
  		        <p><?php echo $this->_tpl_vars['page_message']['body']; ?>
</p>
  		      </div>
    		    <?php endforeach; endif; unset($_from); ?>
    		  <?php endif; ?>
  		      <div class="page_message <?php if (! is_foreachable ( $this->_tpl_vars['wireframe']->page_messages )): ?>first<?php endif; ?>" id="javascript_required" style="background-image: url('<?php echo smarty_function_image_url(array('name' => "messages/error.gif"), $this);?>
')">
  		        <p><?php $this->_tag_stack[] = array('lang', array('url' => $this->_tpl_vars['js_disabled_url'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>It appears that JavaScript is disabled in your web browser. Please enable it to have full system functionality available. <a href=":url">Read more</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.</p>
  		      </div>
  		      <script type="text/javascript">
  		        $('#javascript_required').hide();
  		      </script>
    		  </div>
    		<?php endif; ?>
    		  
    		  <ul id="breadcrumbs">
    		    <li class="first"><a href="<?php echo smarty_function_assemble(array('route' => 'dashboard'), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Dashboard<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>&raquo;</li>
    		    <?php $_from = $this->_tpl_vars['wireframe']->bread_crumbs; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['_bread_crumb'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['_bread_crumb']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['bread_crumb']):
        $this->_foreach['_bread_crumb']['iteration']++;
?>
    		    <li>
    		    <?php if ($this->_tpl_vars['bread_crumb']['url']): ?>
    		      <a href="<?php echo $this->_tpl_vars['bread_crumb']['url']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['bread_crumb']['text'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['bread_crumb']['text'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)))) ? $this->_run_mod_handler('excerpt', true, $_tmp, 20) : smarty_modifier_excerpt($_tmp, 20)); ?>
</a>&raquo;
    		    <?php else: ?>
    		      <span class="current"><?php echo ((is_array($_tmp=$this->_tpl_vars['bread_crumb']['text'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span>
    		    <?php endif; ?>
    		    </li>
    		    <?php endforeach; endif; unset($_from); ?>
    		  </ul>
    	     		  
    		  <?php echo smarty_function_flash_box(array(), $this);?>

    		  <div id="page_content">
    		    <?php echo $this->_tpl_vars['content_for_layout']; ?>

    		    <div class="clear"></div>
    		  </div>
    		  <div class="content_fix"></div>
        </div>
      </div>
    </div>
    
    <div id="footer">
    <?php if ($this->_tpl_vars['application']->copyright_removed()): ?>
      <p id="copyright">&copy;<?php echo smarty_function_year(array(), $this);?>
 by <?php echo ((is_array($_tmp=$this->_tpl_vars['owner_company']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</p>
    <?php else: ?>
    	<p id="powered_by"><a href="http://www.vbsupport.org/forum/index.php" target="_blank"><img src="<?php echo smarty_function_image_url(array('name' => "acpowered.gif"), $this);?>
" alt="NulleD By FintMax" /></a></p>
    <?php endif; ?>
    	<?php echo smarty_function_benchmark(array(), $this);?>

    </div>
  </body>
</html>
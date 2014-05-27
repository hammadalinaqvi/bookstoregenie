<?php /* Smarty version 2.6.16, created on 2012-07-09 14:36:18
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 9, false),array('block', 'pagination', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 9, false),array('function', 'assemble', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 9, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 18, false),array('function', 'object_star', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 19, false),array('function', 'object_link', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 22, false),array('function', 'user_link', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 23, false),array('function', 'object_visibility', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 33, false),array('function', 'empty_slate', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 44, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 15, false),array('modifier', 'ago', '/home/books1/public_html/projMan/activecollab/application/modules/pages/views/pages/index.tpl', 25, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Pages<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="list_view" id="pages">
  <div class="object_list">
  <?php if (is_foreachable ( $this->_tpl_vars['grouped_pages'] )): ?>
    <?php if ($this->_tpl_vars['pagination']->getLastPage() > 1): ?>
      <p class="pagination top">
        <span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_pages','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => '-PAGE-'), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      </p>
      <div class="clear"></div>
    <?php endif; ?>
  
    <?php $_from = $this->_tpl_vars['grouped_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['date'] => $this->_tpl_vars['pages']):
?>
    <h3><?php echo ((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</h3>
    <table>
    <?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
      <tr class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
        <td class="star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['page'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
      <?php if ($this->_tpl_vars['page']->getRevisionNum() == 1): ?>
        <td class="name">
          <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['page']), $this);?>

          <span class="block details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Initial version by<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['page']->getCreatedBy()), $this);?>
</span>
        </td>
        <td class="age"><span class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Created<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['page']->getUpdatedOn())) ? $this->_run_mod_handler('ago', true, $_tmp) : smarty_modifier_ago($_tmp)); ?>
</span></td>
      <?php else: ?>
        <td class="name">
          <?php echo smarty_function_object_link(array('object' => $this->_tpl_vars['page']), $this);?>

          <span class="block details"><?php $this->_tag_stack[] = array('lang', array('version' => $this->_tpl_vars['page']->getRevisionNum())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Version #:version by<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['page']->getCreatedBy()), $this);?>
. <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Initial version by<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_user_link(array('user' => $this->_tpl_vars['page']->getCreatedBy()), $this);?>
</span>
        </td>
        <td class="age"><span class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Updated<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo ((is_array($_tmp=$this->_tpl_vars['page']->getUpdatedOn())) ? $this->_run_mod_handler('ago', true, $_tmp) : smarty_modifier_ago($_tmp)); ?>
</span></td>
      <?php endif; ?>
        <td class="visibility"><?php echo smarty_function_object_visibility(array('object' => $this->_tpl_vars['page'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
    <?php endforeach; endif; unset($_from); ?>
    
    <?php if (( $this->_tpl_vars['pagination']->getLastPage() > 1 ) && ! $this->_tpl_vars['pagination']->isLast()): ?>
      <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'project_pages','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => $this->_tpl_vars['pagination']->getNextPage()), $this);?>
">Next Page</a></p>
    <?php endif; ?>
  <?php else: ?>
    <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no recently updated pages to show<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>. <?php if ($this->_tpl_vars['add_page_url']):  $this->_tag_stack[] = array('lang', array('add_url' => $this->_tpl_vars['add_page_url'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href=":add_url">Create a new page now</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>?<?php endif; ?></p>
    <?php echo smarty_function_empty_slate(array('name' => 'pages','module' => 'pages'), $this);?>

  <?php endif; ?>
  </div>
  
  <ul class="category_list">
    <li <?php if ($this->_tpl_vars['active_category']->isNew()): ?>class="selected"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['pages_url']; ?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recently Updated<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
  <?php if (is_foreachable ( $this->_tpl_vars['categories'] )): ?>
    <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
    <li category_id="<?php echo $this->_tpl_vars['category']->getId(); ?>
" <?php if ($this->_tpl_vars['active_category']->isLoaded() && $this->_tpl_vars['active_category']->getId() == $this->_tpl_vars['category']->getId()): ?>class="selected"<?php endif; ?>><a href="<?php echo smarty_function_assemble(array('route' => 'project_pages','project_id' => $this->_tpl_vars['active_project']->getId(),'category_id' => $this->_tpl_vars['category']->getId()), $this);?>
"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['category']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span></a></li>
    <?php endforeach; endif; unset($_from); ?>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['can_manage_categories']): ?>
    <li id="manage_categories"><a href="<?php echo $this->_tpl_vars['categories_url']; ?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manage Categories<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
  <?php endif; ?>
  </ul>
  <script type="text/javascript">
    App.resources.ManageCategories.init('manage_categories');
  </script>
  
  <div class="clear"></div>
</div>
<?php /* Smarty version 2.6.16, created on 2012-07-09 14:27:25
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 2, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 12, false),array('block', 'pagination', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 12, false),array('function', 'assemble', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 12, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 32, false),array('function', 'action_by', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 37, false),array('function', 'category_link', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 37, false),array('function', 'object_visibility', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 50, false),array('function', 'empty_slate', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 70, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 35, false),array('modifier', 'ago', '/home/books1/public_html/projMan/activecollab/application/modules/discussions/views/discussions/index.tpl', 46, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Discussions<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>List<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="list_view">
  <div class="object_list">
  <?php if (is_foreachable ( $this->_tpl_vars['discussions'] )): ?>

  <?php if ($this->_tpl_vars['pagination']->getLastPage() > 1): ?>
  <p class="pagination top">
    <span class="inner_pagination">
  <?php if (isset ( $this->_tpl_vars['active_category'] ) && instance_of ( $this->_tpl_vars['active_category'] , 'Category' ) && $this->_tpl_vars['active_category']->isLoaded()): ?>
    <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_discussions','project_id' => $this->_tpl_vars['active_project']->getId(),'category_id' => $this->_tpl_vars['active_category']->getId(),'page' => '-PAGE-'), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php else: ?>
    <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_discussions','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => '-PAGE-'), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php endif; ?>
    </span>
  </p>
  <div class="clear"></div>
  <?php endif; ?>
  
  <table class="discussions">
    <tr>
      <th class="icon"></th>
      <th class="name"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Discussion<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th class="comments_count"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Replies<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th class="last_comment"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last Reply<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
    <?php if ($this->_tpl_vars['logged_user']->canSeePrivate()): ?>
      <th class="visibility"></th>
    <?php endif; ?>
    </tr>
  <?php $_from = $this->_tpl_vars['discussions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discussion']):
?>
    <tr class="discussion <?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
" id="discussion<?php echo $this->_tpl_vars['discussion']->getId(); ?>
">
      <td class="icon"><a href="<?php echo $this->_tpl_vars['discussion']->getViewUrl(); ?>
" class="icon"><img src="<?php echo $this->_tpl_vars['discussion']->getIconUrl($this->_tpl_vars['logged_user']); ?>
" /></td>
      <td class="name">
        <a href="<?php echo $this->_tpl_vars['discussion']->getViewUrl(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['discussion']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a> <span class="inline_pagination"><?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['discussion']->getPagination(false,$this->_tpl_vars['logged_user']),'sensitive' => true)); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['discussion']->getViewUrl('-PAGE-');  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      <?php if ($this->_tpl_vars['discussion']->getParentId()): ?>
        <span class="details block"><?php echo smarty_function_action_by(array('user' => $this->_tpl_vars['discussion']->getCreatedBy(),'action' => 'Started'), $this);?>
 <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>in<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_category_link(array('object' => $this->_tpl_vars['discussion']), $this);?>
</span>
      <?php else: ?>
        <span class="details block"><?php echo smarty_function_action_by(array('user' => $this->_tpl_vars['discussion']->getCreatedBy(),'action' => 'Started'), $this);?>
</span>
      <?php endif; ?>
      </td>
      <td class="comments_count"><?php echo $this->_tpl_vars['discussion']->getCommentsCount(); ?>
</td>
      <td class="last_comment">
      <?php $this->assign('discussion_last_comment_by', $this->_tpl_vars['discussion']->getLastCommentBy()); ?>
      <?php if (instance_of ( $this->_tpl_vars['discussion_last_comment_by'] , 'User' )): ?>
        <?php echo ((is_array($_tmp=$this->_tpl_vars['discussion']->getLastCommentOn())) ? $this->_run_mod_handler('ago', true, $_tmp) : smarty_modifier_ago($_tmp)); ?>
 <?php $this->_tag_stack[] = array('lang', array('user_url' => $this->_tpl_vars['discussion_last_comment_by']->getViewUrl(),'user_name' => $this->_tpl_vars['discussion_last_comment_by']->getDisplayName(true))); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>by <a href=":user_url">:user_name</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php endif; ?>
      </td>
    <?php if ($this->_tpl_vars['logged_user']->canSeePrivate()): ?>
      <td class="visibility"><?php echo smarty_function_object_visibility(array('object' => $this->_tpl_vars['discussion'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</td>
    <?php endif; ?>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
  <div class="clear"></div>
  
  <?php if (( $this->_tpl_vars['pagination']->getLastPage() > 1 ) && ! $this->_tpl_vars['pagination']->isLast()): ?>
    <?php if (isset ( $this->_tpl_vars['active_category'] ) && instance_of ( $this->_tpl_vars['active_category'] , 'Category' ) && $this->_tpl_vars['active_category']->isLoaded()): ?>
      <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'project_discussions','project_id' => $this->_tpl_vars['active_project']->getId(),'category_id' => $this->_tpl_vars['active_category']->getId(),'page' => $this->_tpl_vars['pagination']->getNextPage()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
    <?php else: ?>
      <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'project_discussions','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => $this->_tpl_vars['pagination']->getNextPage()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
    <?php endif; ?>
  <?php endif; ?>
  
  <?php else: ?>
    <?php if (instance_of ( $this->_tpl_vars['active_category'] , 'Category' ) && $this->_tpl_vars['active_category']->isLoaded()): ?>
      <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No discussions in this category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>. <?php if ($this->_tpl_vars['add_discussion_url']):  $this->_tag_stack[] = array('lang', array('add_url' => $this->_tpl_vars['add_discussion_url'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href=":add_url">Start one now</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>?<?php endif; ?></p>
    <?php else: ?>
      <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No discussions here<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>. <?php if ($this->_tpl_vars['add_discussion_url']):  $this->_tag_stack[] = array('lang', array('add_url' => $this->_tpl_vars['add_discussion_url'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href=":add_url">Start one now</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>?<?php endif; ?></p>
      <?php echo smarty_function_empty_slate(array('name' => 'discussions','module' => 'discussions'), $this);?>

    <?php endif; ?>
  <?php endif; ?>
  </div>

  <ul class="category_list">
    <li <?php if ($this->_tpl_vars['active_category']->isNew()): ?>class="selected"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['discussions_url']; ?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Discussions<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
	<?php if (is_foreachable ( $this->_tpl_vars['categories'] )): ?>
	  <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
	    <li category_id="<?php echo $this->_tpl_vars['category']->getId(); ?>
" <?php if ($this->_tpl_vars['active_category']->isLoaded() && $this->_tpl_vars['active_category']->getId() == $this->_tpl_vars['category']->getId()): ?>class="selected"<?php endif; ?>><a href="<?php echo smarty_function_assemble(array('route' => 'project_discussions','project_id' => $this->_tpl_vars['active_project']->getId(),'category_id' => $this->_tpl_vars['category']->getId()), $this);?>
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
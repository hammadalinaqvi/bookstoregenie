<?php /* Smarty version 2.6.16, created on 2012-07-09 14:16:00
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 2, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 6, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 6, false),array('block', 'pagination', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 14, false),array('block', 'form', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 22, false),array('function', 'assemble', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 14, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 36, false),array('function', 'object_star', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 37, false),array('function', 'action_on_by', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 51, false),array('function', 'object_visibility', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 69, false),array('function', 'empty_slate', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 121, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 42, false),array('modifier', 'excerpt', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 42, false),array('modifier', 'filesize', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/index.tpl', 42, false),)), $this); ?>
<?php if ($this->_tpl_vars['active_category']->isLoaded()): ?>
  <?php $this->_tag_stack[] = array('title', array('not_lang' => true)); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['active_category']->getName();  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  else: ?>
  <?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Files<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif;  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  $this->_tag_stack[] = array('lang', array('page' => $this->_tpl_vars['pagination']->getCurrentPage())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page :page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="list_view" id="files">
  <div class="object_list">
  <?php if (is_foreachable ( $this->_tpl_vars['files'] )): ?>
    <?php if ($this->_tpl_vars['pagination']->getLastPage() > 1): ?>
      <p class="pagination top">
      <?php if (isset ( $this->_tpl_vars['active_category'] ) && instance_of ( $this->_tpl_vars['active_category'] , 'Category' ) && $this->_tpl_vars['active_category']->isLoaded()): ?>
        <span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_files','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => '-PAGE-','category_id' => $this->_tpl_vars['active_category']->getId()), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      <?php else: ?>
        <span class="inner_pagination"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php $this->_tag_stack[] = array('pagination', array('pager' => $this->_tpl_vars['pagination'])); $_block_repeat=true;smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo smarty_function_assemble(array('route' => 'project_files','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => '-PAGE-'), $this); $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_pagination($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      <?php endif; ?>
      </p>
      <div class="clear"></div>
    <?php endif; ?>
  
    <?php $this->_tag_stack[] = array('form', array('method' => 'POST','action' => $this->_tpl_vars['mass_edit_url'])); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <input type="hidden" name="object_types" value="files" />
      <table id="file_list" class="common_table">
        <tr>
          <th></th>
          <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thumbnail<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
          <th><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>File Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
          <th></th>
          <th></th>
          <th class="checkbox"><input type="checkbox" class="auto master_checkbox input_checkbox" /></th>
        </tr>
        <tbody>
      <?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['file']):
?>
        <?php if (instance_of ( $this->_tpl_vars['file'] , 'File' )): ?>
          <tr class="file <?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
">
            <td class="star"><span class="star"><?php echo smarty_function_object_star(array('object' => $this->_tpl_vars['file'],'user' => $this->_tpl_vars['logged_user']), $this);?>
</span></td>
            <td class="thumbnail"><a href="<?php echo $this->_tpl_vars['file']->getViewUrl(); ?>
"><img src="<?php echo $this->_tpl_vars['file']->getThumbnailUrl(); ?>
" alt="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thumbnail<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /></a></td>
            <td class="details">
              <dl>
                <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>File<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
                <dd class="filename"><a href="<?php echo $this->_tpl_vars['file']->getViewUrl(); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['file']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['file']->getName())) ? $this->_run_mod_handler('excerpt', true, $_tmp, 40) : smarty_modifier_excerpt($_tmp, 40)))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</a>, <?php echo ((is_array($_tmp=$this->_tpl_vars['file']->getSize())) ? $this->_run_mod_handler('filesize', true, $_tmp) : smarty_modifier_filesize($_tmp)); ?>
</dd>
                
              <?php if ($this->_tpl_vars['file']->getBody()): ?>
                <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
                <dd class="description"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['file']->getBody())) ? $this->_run_mod_handler('excerpt', true, $_tmp, 100, '...', true) : smarty_modifier_excerpt($_tmp, 100, '...', true)))) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</dd>
              <?php endif; ?>
                
              <?php if ($this->_tpl_vars['file']->getRevision() == 1): ?>
                <dt>&nbsp;</dt>
                <dd><?php echo smarty_function_action_on_by(array('user' => $this->_tpl_vars['file']->getCreatedBy(),'datetime' => $this->_tpl_vars['file']->getCreatedOn(),'action' => 'Uploaded'), $this);?>
</dd>
              <?php else: ?>
                <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Latest Version<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
                <dd>#<?php echo $this->_tpl_vars['file']->getRevision(); ?>
 &mdash; <?php echo smarty_function_action_on_by(array('user' => $this->_tpl_vars['file']->getLastRevisionBy(),'datetime' => $this->_tpl_vars['file']->getLastRevisionOn(),'action' => 'Uploaded'), $this);?>
</dd>
                
                <dt><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>First Version<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></dt>
                <dd><?php echo smarty_function_action_on_by(array('user' => $this->_tpl_vars['file']->getCreatedBy(),'datetime' => $this->_tpl_vars['file']->getCreatedOn(),'action' => 'Uploaded'), $this);?>
</dd>
              <?php endif; ?>
              </dl>
            </td>
            <td class="options">
              <a href="<?php echo $this->_tpl_vars['file']->getDownloadUrl(true); ?>
" class="button_add"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Download<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
              <?php if ($this->_tpl_vars['file']->canEdit($this->_tpl_vars['logged_user'])): ?>
              <br /><a href="<?php echo $this->_tpl_vars['file']->getNewVersionUrl(); ?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Version<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
              <?php endif; ?>
            </td>
            <td class="visibility">
              <?php if ($this->_tpl_vars['logged_user']->canSeePrivate() && ( $this->_tpl_vars['file']->getVisibility() <= VISIBILITY_PRIVATE )): ?>
                <?php echo smarty_function_object_visibility(array('object' => $this->_tpl_vars['file'],'user' => $this->_tpl_vars['logged_user']), $this);?>

              <?php endif; ?>
            </td>
            <td class="checkbox">
              <?php if ($this->_tpl_vars['file']->canDelete($this->_tpl_vars['logged_user'])): ?>
                <input type="checkbox" name="files[]" value="<?php echo $this->_tpl_vars['file']->getId(); ?>
" class="auto slave_checkbox input_checkbox" />
              <?php endif; ?>
            </td>
          </tr>
        <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
        </tbody>
      </table>
      
      <!-- MASS EDIT START -->
      <div id="mass_edit">
        <select name="with_selected" class="auto conflicts_action" id="file_list_action">
          <option value=""><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>With selected ...<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
          <option value=""></option>
          <option value="move_to_trash"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Move To Trash<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
          <?php if (is_foreachable ( $this->_tpl_vars['categories'] )): ?>
          <option value=""></option>
          <optgroup label="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Move To Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">
            <option value="move_to_category"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>&lt;None&gt;<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
            <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
            <option value="move_to_category_<?php echo $this->_tpl_vars['category']->getId(); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['category']->getName())) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
          </optgroup>
          <?php endif; ?>
        </select>
        <button class="simple" id="file_list_submit" type="submit" class="auto conflicts_submit"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Go<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></button>
      </div>
      <!-- MASS EDIT END -->
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <div class="clear"></div>
    
    
    <!-- PAGINATION START -->
    <?php if (( $this->_tpl_vars['pagination']->getLastPage() > 1 ) && ! $this->_tpl_vars['pagination']->isLast()): ?>
      <?php if (isset ( $this->_tpl_vars['active_category'] ) && instance_of ( $this->_tpl_vars['active_category'] , 'Category' ) && $this->_tpl_vars['active_category']->isLoaded()): ?>
        <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'project_files','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => $this->_tpl_vars['pagination']->getNextPage(),'category_id' => $this->_tpl_vars['active_category']->getId()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
      <?php else: ?>
        <p class="next_page"><a href="<?php echo smarty_function_assemble(array('route' => 'project_files','project_id' => $this->_tpl_vars['active_project']->getId(),'page' => $this->_tpl_vars['pagination']->getNextPage()), $this);?>
"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Next Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></p>
      <?php endif; ?>
    <?php endif; ?>
    <!-- PAGINATION END -->
  <?php else: ?>
    <!-- EMPTY PAGE START -->
    <?php if (instance_of ( $this->_tpl_vars['active_category'] , 'Category' ) && $this->_tpl_vars['active_category']->isLoaded()): ?>
      <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no files in this category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>. <?php if ($this->_tpl_vars['upload_url']):  $this->_tag_stack[] = array('lang', array('add_url' => $this->_tpl_vars['upload_url'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href=":add_url">Upload now</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>?<?php endif; ?></p>
    <?php else: ?>
      <p class="empty_page"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no files to show<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>. <?php if ($this->_tpl_vars['upload_url']):  $this->_tag_stack[] = array('lang', array('add_url' => $this->_tpl_vars['upload_url'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href=":add_url">Upload now</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>?<?php endif; ?></p>
      <?php echo smarty_function_empty_slate(array('name' => 'files','module' => 'files'), $this);?>

    <?php endif; ?>
      <!-- EMPTY PAGE END -->
  <?php endif; ?>
  </div>
  
  <!-- CATEGORY LIST START-->
  <ul class="category_list">
    <li <?php if (( $this->_tpl_vars['active_category']->isNew() && ! $this->_tpl_vars['attachments_view'] )): ?>class="selected"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['files_url']; ?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Files<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
    <li <?php if ($this->_tpl_vars['attachments_view']): ?>class="selected"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['attachments_url']; ?>
"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All Attachments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a></li>
    <?php if (is_foreachable ( $this->_tpl_vars['categories'] )): ?>
      <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
      <li category_id="<?php echo $this->_tpl_vars['category']->getId(); ?>
" <?php if ($this->_tpl_vars['active_category']->isLoaded() && $this->_tpl_vars['active_category']->getId() == $this->_tpl_vars['category']->getId()): ?>class="selected"<?php endif; ?>><a href="<?php echo smarty_function_assemble(array('route' => 'project_files','project_id' => $this->_tpl_vars['active_project']->getId(),'category_id' => $this->_tpl_vars['category']->getId()), $this);?>
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
  <!-- CATEGORY LIST END -->
  
  <div class="clear"></div>
</div>
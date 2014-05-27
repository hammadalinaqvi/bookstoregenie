<?php /* Smarty version 2.6.16, created on 2012-07-09 14:16:10
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'title', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 1, false),array('block', 'add_bread_crumb', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 2, false),array('block', 'form', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 4, false),array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 9, false),array('block', 'wrap', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 41, false),array('block', 'label', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 42, false),array('block', 'wrap_buttons', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 76, false),array('function', 'image_url', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 17, false),array('function', 'select_assignees_inline', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 43, false),array('function', 'select_category', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 51, false),array('function', 'select_milestone', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 57, false),array('function', 'select_tags', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 63, false),array('function', 'select_visibility', '/home/books1/public_html/projMan/activecollab/application/modules/files/views/files/upload.tpl', 69, false),)), $this); ?>
<?php $this->_tag_stack[] = array('title', array()); $_block_repeat=true;smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upload Files<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_title($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $this->_tag_stack[] = array('add_bread_crumb', array()); $_block_repeat=true;smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upload Files<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_add_bread_crumb($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->_tag_stack[] = array('form', array('action' => $this->_tpl_vars['upload_url'],'method' => 'post','enctype' => "multipart/form-data",'id' => 'main_form')); $_block_repeat=true;smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="form_left_col">
  <table class="common_table multiupload_table">
    <tr>
      <th></th>
      <th class="input"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>File<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
      <th class="description" colspan="2"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description <i>(optional)</i><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
    </tr>
    
    <tr>
      <td class="number">#1</td>
      <td class="input"><input type="file" value="" name="attachment"/></td>
      <td class="description"><input type="text" name="file[body]" /></td>
      <td class="button_column"><img src="<?php echo smarty_function_image_url(array('name' => 'gray-delete.gif'), $this);?>
" class="button_remove" /></td>
    </tr>
    <tr>
      <td class="number">#2</td>
      <td class="input"><input type="file" value="" name="attachment"/></td>
      <td class="description"><input type="text" name="file[body]" /></td>
      <td class="button_column"><img src="<?php echo smarty_function_image_url(array('name' => 'gray-delete.gif'), $this);?>
" class="button_remove" /></td>
    </tr>
    <tr>
      <td class="number">#3</td>
      <td class="input"><input type="file" value="" name="attachment"/></td>
      <td class="description"><input type="text" name="file[body]" /></td>
      <td class="button_column"><img src="<?php echo smarty_function_image_url(array('name' => 'gray-delete.gif'), $this);?>
" class="button_remove" /></td>
    </tr>
    
  </table>
  <div class="right_buttons">
    <a href="#" class="button_add"><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Another File<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a>
  </div>
  <div class="clear"></div>
  
  <p class="details"><?php $this->_tag_stack[] = array('lang', array('max_size' => $this->_tpl_vars['max_upload_size'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><strong>Note</strong>: Max upload size is :max_size per file<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
  
  <?php if ($this->_tpl_vars['active_file']->isNew()): ?>
    <?php $this->_tag_stack[] = array('wrap', array('field' => 'notify_users')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <?php $this->_tag_stack[] = array('label', array()); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notify People<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php echo smarty_function_select_assignees_inline(array('name' => 'notify_users','project' => $this->_tpl_vars['active_project']), $this);?>

    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php endif; ?>
</div>

<div class="form_right_col">
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'parent_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'fileParent')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_category(array('name' => 'file[parent_id]','value' => $this->_tpl_vars['file_data']['parent_id'],'id' => 'fileParent','module' => 'files','controller' => 'files','project' => $this->_tpl_vars['active_project'],'user' => $this->_tpl_vars['logged_user']), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
<?php if ($this->_tpl_vars['logged_user']->canSeeMilestones($this->_tpl_vars['active_project'])): ?>
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'milestone_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'fileMilestone')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Milestone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_milestone(array('name' => 'file[milestone_id]','value' => $this->_tpl_vars['file_data']['milestone_id'],'project' => $this->_tpl_vars['active_project'],'id' => 'fileMilestone'), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif; ?>
  
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'tags')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'fileTags')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tags<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_tags(array('name' => 'file[tags]','value' => $this->_tpl_vars['file_data']['tags'],'project' => $this->_tpl_vars['active_project'],'id' => 'fileTags'), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
<?php if ($this->_tpl_vars['logged_user']->canSeePrivate()): ?>
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'visibility','class' => 'ctrlHolderNoTopPadding')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'fileVisibility')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Visibility<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_visibility(array('name' => 'file[visibility]','value' => $this->_tpl_vars['file_data']['visibility'],'id' => 'fileVisibility','project' => $this->_tpl_vars['active_project'],'short_description' => true), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  else: ?>
  <input type="hidden" name="file[visibility]" value="1" id="fileVisibility_1" />
<?php endif; ?>
</div>
<div class="clear"></div>
<?php $this->_tag_stack[] = array('wrap_buttons', array()); $_block_repeat=true;smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
  <button type="button" class="button_add" id="upload_files"><span><span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upload<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></span></button></td>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap_buttons($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_form($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<form id="multiupload_form" action="<?php echo $this->_tpl_vars['upload_single_file_url']; ?>
" method="POST" enctype="multipart/form-data">
  <input id="multiupload_parent_id" name="file[parent_id]" type="hidden" />
  <input id="multiupload_milestone_id" name="file[milestone_id]" type="hidden" />
  <input id="multiupload_tags" name="file[tags]" type="hidden" />
  <input id="multiupload_visibility" name="file[visibility]" type="hidden" />
  <input id="multiupload_body" name="file[body]" type="hidden" />
  <input type="hidden" style="display: none;" value="submitted" name="submitted"/>
</form>
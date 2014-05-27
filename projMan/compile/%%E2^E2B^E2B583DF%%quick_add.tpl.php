<?php /* Smarty version 2.6.16, created on 2012-07-10 02:08:09
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/quick_add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/quick_add.tpl', 10, false),array('block', 'button', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/dashboard/quick_add.tpl', 27, false),)), $this); ?>
<script type="text/javascript">
  App.data.quick_add_map = <?php echo $this->_tpl_vars['js_encoded_formatted_map']; ?>
;
  App.data.quick_add_urls = <?php echo $this->_tpl_vars['js_encoded_quick_add_urls']; ?>
;
</script>

<div id="quick_add">
  <div id="quick_add_step_1">
    <div class="quick_add_col_container height_limited_popup">
      <div class="quick_add_col_left">
        <p><strong><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Choose Project<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></p>
        <div id="project_id" class="list_chooser">
          <?php $_from = $this->_tpl_vars['formatted_map']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['project_id'] => $this->_tpl_vars['project_map']):
?>
            <label for="quickadd_project_<?php echo $this->_tpl_vars['project_id']; ?>
"><input type="radio" name="project_id" value="<?php echo $this->_tpl_vars['project_id']; ?>
" class="input_radio" id="quickadd_project_<?php echo $this->_tpl_vars['project_id']; ?>
" /><?php echo $this->_tpl_vars['project_map']['name']; ?>
</label>
          <?php endforeach; endif; unset($_from); ?>
        </div>
      </div>
      
      <div class="quick_add_col_right">
        <p><strong><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Choose Object Type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></p>
        <div id="object_chooser" class="list_chooser">
        
        </div>
      </div>
    </div>

    <div class="wizardbar">
      <?php $this->_tag_stack[] = array('button', array('class' => 'continue')); $_block_repeat=true;smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Continue<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_button($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><a href="#" class="wizzard_back"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Close<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
    </div>
  </div>
  
  <div id="quick_add_step_2">
  </div>
</div>
<script type="text/javascript">
  App.system.QuickAdd.init();
</script>
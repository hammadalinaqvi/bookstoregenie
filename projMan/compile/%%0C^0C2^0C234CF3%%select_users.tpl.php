<?php /* Smarty version 2.6.16, created on 2012-07-09 14:14:17
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/system/views/widgets/select_users.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/widgets/select_users.tpl', 5, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/widgets/select_users.tpl', 9, false),array('function', 'cycle', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/widgets/select_users.tpl', 11, false),array('function', 'image_url', '/home/books1/public_html/projMan/activecollab/application/modules/system/views/widgets/select_users.tpl', 21, false),)), $this); ?>
<div id="<?php echo $this->_tpl_vars['widget_id']; ?>
_popup" class="select_users_widget_popup">
  <table class="select_users_layout">
    <tr>
      <td class="users_list">
        <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Available users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
      <?php if (is_foreachable ( $this->_tpl_vars['grouped_users'] )): ?>
        <select multiple="multiple">
        <?php $_from = $this->_tpl_vars['grouped_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['company_name'] => $this->_tpl_vars['users']):
?>
          <optgroup label="<?php echo ((is_array($_tmp=$this->_tpl_vars['company_name'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
">
          <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
            <option value="<?php echo $this->_tpl_vars['user']['id']; ?>
" class="<?php echo smarty_function_cycle(array('values' => 'odd,even'), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['user']['display_name'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</option>
          <?php endforeach; endif; unset($_from); ?>
          </optgroup>
        <?php endforeach; endif; unset($_from); ?>
        </select>
      <?php else: ?>
        <p class="details"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No users here<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>
      <?php endif; ?>
      </td>
      <td class="divider">
        <img src="<?php echo smarty_function_image_url(array('name' => "arrow-right.gif"), $this);?>
" alt="" />
      </td>
      <td class="selected_users">
        <div class="selected_users_list" <?php if (! is_foreachable ( $this->_tpl_vars['selected_users'] )): ?>style="display: none"<?php endif; ?>>
          <p><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Selected users<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</p>
          <div class="selected_users_list_container">
            <table>
            <?php if (is_foreachable ( $this->_tpl_vars['selected_users'] )): ?>
            <?php $_from = $this->_tpl_vars['selected_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
              <tr id="<?php echo $this->_tpl_vars['widget_id']; ?>
_user_<?php echo $this->_tpl_vars['user']->getId(); ?>
" class="<?php echo smarty_function_cycle(array('values' => 'odd,even','name' => $this->_tpl_vars['selected_users_cycle_name']), $this);?>
">
                <td class="display_name"><?php $this->_tag_stack[] = array('lang', array('username' => $this->_tpl_vars['user']->getDisplayName(),'company' => $this->_tpl_vars['user']->getCompanyName())); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span>:username</span> of :company<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
                <td class="remove"><img src="<?php echo smarty_function_image_url(array('name' => "gray-delete.gif"), $this);?>
" alt="" title="<?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Remove from the list<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /></td>
              </tr>
            <?php endforeach; endif; unset($_from); ?>
            <?php endif; ?>
            </table>
          </div>
        </div>
        <p class="no_users_selected" <?php if (is_foreachable ( $this->_tpl_vars['selected_users'] )): ?>style="display: none"<?php endif; ?>>
          <?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No users selected<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          <br /><br />
          <span><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Select users from the list on the left and click the arrow button to mark them as selected<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
        </p>
      </td>
    </tr>
  </table>
</div>
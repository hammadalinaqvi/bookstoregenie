<?php /* Smarty version 2.6.16, created on 2012-07-09 14:16:10
         compiled from /home/books1/public_html/projMan/activecollab/application/modules/resources/views/_select_assignees_inline.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'lang', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/_select_assignees_inline.tpl', 5, false),array('modifier', 'clean', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/_select_assignees_inline.tpl', 11, false),array('function', 'var_export', '/home/books1/public_html/projMan/activecollab/application/modules/resources/views/_select_assignees_inline.tpl', 37, false),)), $this); ?>
<div class="select_asignees_inline_widget" id="<?php echo $this->_tpl_vars['_select_assignees_id']; ?>
">
<?php if ($this->_tpl_vars['_select_assignees_choose_responsible']): ?>
  <input type="hidden" name="<?php echo $this->_tpl_vars['_select_assignees_responsible_name']; ?>
" value="<?php echo $this->_tpl_vars['_select_assignees_responsible']; ?>
" id="<?php echo $this->_tpl_vars['_select_assignees_id']; ?>
_responsible" />
  <div class="select_asignees_inline_widget_responsible_block">
    <span class="placeholder"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No one is responsible<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
  </div>
<?php endif;  $_from = $this->_tpl_vars['_select_assignees_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['company'] => $this->_tpl_vars['users']):
?>
  <?php if (is_foreachable ( $this->_tpl_vars['users'] )): ?>
    <div class="user_group">
      <label class="company_name" for="<?php echo $this->_tpl_vars['_select_assignees_id']; ?>
_company_<?php echo ((is_array($_tmp=$this->_tpl_vars['company'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
"><input type="checkbox" name="" value="" id="<?php echo $this->_tpl_vars['_select_assignees_id']; ?>
_company_<?php echo ((is_array($_tmp=$this->_tpl_vars['company'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
}" class="input_checkbox" /><span><?php $this->_tag_stack[] = array('lang', array('company_name' => $this->_tpl_vars['company'])); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>All of :company_name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></label>
      <div class="company_users">
        <table>
          <tr>
          <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['users_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['users_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['user']):
        $this->_foreach['users_loop']['iteration']++;
?>
            <?php if (( ($this->_foreach['users_loop']['iteration']-1) % $this->_tpl_vars['_select_assignees_users_per_row'] == 0 ) && ( ($this->_foreach['users_loop']['iteration']-1) != 0 )): ?>
              </tr><tr>
            <?php endif; ?>
            <td><span class="company_user">
              <input type="checkbox" name="<?php echo $this->_tpl_vars['_select_assignees_name']; ?>
[]" value="<?php echo $this->_tpl_vars['user']['id']; ?>
" id="<?php echo $this->_tpl_vars['_select_assignees_id']; ?>
_user_<?php echo $this->_tpl_vars['user']['id']; ?>
" <?php if (in_array ( $this->_tpl_vars['user']['id'] , $this->_tpl_vars['_select_assignees_assigned'] )): ?>checked="checked"<?php endif; ?> class="input_checkbox"/>
              <?php if ($this->_tpl_vars['_select_assignees_choose_responsible'] && ( $this->_tpl_vars['_select_assignees_responsible'] == $this->_tpl_vars['user']['id'] )): ?>
                <span class="responsible_setter responsible"><?php echo ((is_array($_tmp=$this->_tpl_vars['user']['display_name'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span>
              <?php else: ?>
                <span class="responsible_setter"><?php echo ((is_array($_tmp=$this->_tpl_vars['user']['display_name'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
</span>
              <?php endif; ?>
            </span></td>
          <?php endforeach; endif; unset($_from); ?>
          </tr>
        </table>
      </div>
    </div>
  <?php endif;  endforeach; endif; unset($_from); ?>
</div>
<script type="text/javascript">
  var picker_wrapper = $('#<?php echo $this->_tpl_vars['_select_assignees_id']; ?>
:first');
  App.widgets.SelectAsigneesInlineWidget.init(picker_wrapper, '#<?php echo $this->_tpl_vars['_select_assignees_id']; ?>
',<?php echo smarty_function_var_export(array('var' => $this->_tpl_vars['_select_assignees_choose_responsible']), $this); if ($this->_tpl_vars['_select_assignees_choose_responsible'] && $this->_tpl_vars['_select_assignees_responsible']): ?>, <?php echo $this->_tpl_vars['_select_assignees_responsible'];  endif; ?>);
</script>
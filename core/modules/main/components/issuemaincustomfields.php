                            <?php use pachno\core\entities\DatatypeBase;

                            foreach ($customfields_list as $field => $info): ?>
                            <?php
                                if (!$info['visible']) {
                                    continue;
                                }
                                switch ($info['type'])
                                {
                                    case DatatypeBase::INPUT_TEXTAREA_MAIN:
                                        ?>
                                        <div id="<?php echo $field;?>_field">
                                            <fieldset id="<?php echo $field; ?>_header" class="hoverable viewissue_customfield">
                                                <legend>
                                                    <a href="javascript:void(0);" onclick="Pachno.Issues.Field.revert('<?php echo make_url('issue_revertfield', array('project_key' => $issue->getProject()->getKey(), 'issue_id' => $issue->getID(), 'field' => $field)); ?>', '<?php echo $field; ?>');" title="<?php echo __('Undo this change'); ?>"><?php echo fa_image_tag('undo-alt', ['class' => 'undo'], 'fas'); ?></a>
                                                    <?php echo fa_image_tag('edit', array('class' => 'dropdown', 'id' => $field.'_edit', 'onclick' => "$('#{$field}_change').show(); $('#{$field}_name').hide(); $('#no_{$field}').hide();", 'title' => __('Click here to edit this field'))); ?>
                                                    <?php echo $info['title']; ?>:
                                                </legend>
                                                <div id="<?php echo $field; ?>_content" class="resizable">
                                                    <div class="faded_out" id="no_<?php echo $field; ?>" <?php if ($info['name'] != ''):?> style="display: none;" <?php endif; ?>><?php echo __('Nothing entered.'); ?></div>
                                                    <div id="<?php echo $field; ?>_name" class="issue_inline_description">
                                                        <?php if ($info['name'] != ''): ?>
                                                            <?php echo \pachno\core\helpers\TextParser::parseText($info['name'], false, null, array('headers' => false, 'issue' => $issue)); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <br style="clear: both;">
                                                </div>
                                                <div id="<?php echo $field; ?>_change" class="resizable" style="display: none;">
                                                    <form id="<?php echo $field; ?>_form" action="<?php echo make_url('edit_issue', array('project_key' => $issue->getProject()->getKey(), 'issue_id' => $issue->getID(), 'field' => $field)); ?>" method="post" onSubmit="Pachno.Issues.Field.set('<?php echo make_url('edit_issue', array('project_key' => $issue->getProject()->getKey(), 'issue_id' => $issue->getID(), 'field' => $field)) ?>', '<?php echo $field; ?>', '<?php echo $field; ?>'); return false;">
                                                        <?php include_component('main/textarea', array('area_name' => $field.'_value', 'target_type' => 'issue', 'target_id' => $issue->getID(), 'area_id' => $field.'_value', 'height' => '100px', 'width' => '100%', 'value' => htmlentities($info['name'], ENT_COMPAT, \pachno\core\framework\Context::getI18n()->getCharset()))); ?>
                                                        <br>
                                                        <input type="submit" value="<?php echo __('Save'); ?>" style="font-weight: bold;"><?php echo __('%save or %cancel', array('%save' => '', '%cancel' => javascript_link_tag(__('cancel'), array('style' => 'font-weight: bold;', 'onclick' => "$('#{$field}_change').hide();".(($info['name'] != '') ? "$('#{$field}_name').show();" : "$('#no_{$field}').show();")."return false;")))); ?>                                                    </form>
                                                    <?php echo image_tag('spinning_16.gif', array('style' => 'display: none; float: left; margin-right: 5px;', 'id' => $field.'_spinning')); ?>
                                                    <div id="<?php echo $field; ?>_change_error" class="error_message" style="display: none;"></div>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <br />
                                            <?php
                                            break;
                                }
                            ?>
                            <?php endforeach; ?>

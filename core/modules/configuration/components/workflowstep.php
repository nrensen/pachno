<?php
    
    use pachno\core\entities\WorkflowStep;
    use pachno\core\framework\Context;
    use pachno\core\entities\Status;

    /**
     * @var WorkflowStep $step
     * @var bool $selected
     */

?>
<div class="configurable-component form-container workflow-step <?php if ($selected): ?>active<?php endif; ?>" id="workflow_step_component_<?= $step->getID(); ?>" data-workflow-step data-id="<?= $step->getID(); ?>" data-options-url="<?= make_url('configure_workflow_step', ['workflow_id' => $step->getWorkflow()->getID(), 'step_id' => $step->getId()]); ?>">
    <div class="row">
        <div class="icon handle"><?= fa_image_tag('grip-vertical'); ?></div>
        <div class="name">
            <span class="status-badge" style="background-color: <?php echo ($step->getLinkedStatus() instanceof Status) ? $step->getLinkedStatus()->getColor() : '#FFF'; ?>; color: <?php echo ($step->getLinkedStatus() instanceof Status) ? $step->getLinkedStatus()->getTextColor() : 'inherit'; ?>;">
                <span><?php echo ($step->getLinkedStatus() instanceof Status) ? $step->getLinkedStatus()->getName() : __('Unknown'); ?></span>
            </span>
        </div>
        <button class="icon open trigger-open-component" type="button">
            <?= fa_image_tag('angle-right'); ?>
        </button>
    </div>
</div>

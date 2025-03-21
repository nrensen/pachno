<?php

    use pachno\core\entities\AgileBoard;
    use pachno\core\entities\Milestone;
    use pachno\core\entities\Project;
    
    /**
     * @var Milestone $milestone
     */
    
    if (isset($board))
    {
        switch ($board->getType())
        {
            case AgileBoard::TYPE_SCRUM:
            case AgileBoard::TYPE_KANBAN:
                if (!isset($savebuttonlabel)) $savebuttonlabel = __('Save sprint');
                $milestoneplaceholder = __('Give the sprint a name such as "Sprint 2", or similar');
                $milestoneheader = ($milestone->getId()) ? __('Edit sprint details') : __('Add new sprint');
                $milestonenamelabel = __e('Sprint name');
                $milestoneincludeissues_text = __e('The %number selected issue(s) will be automatically added to the new sprint', array('%number' => '<span id="milestone_include_num_issues"></span>'));
                $milestone_type = Milestone::TYPE_SCRUMSPRINT;
                break;
            case AgileBoard::TYPE_GENERIC:
            default:
                if (!isset($savebuttonlabel)) $savebuttonlabel = __('Save milestone');
                $milestoneplaceholder = __e('Enter a milestone name');
                $milestoneheader = ($milestone->getId()) ? __('Edit milestone details') : __('Add milestone');
                $milestonenamelabel = __e('Milestone name');
                $milestoneincludeissues_text = __e('The %number selected issue(s) will be automatically assigned to the new milestone', array('%number' => '<span id="milestone_include_num_issues"></span>'));
                $milestone_type = Milestone::TYPE_REGULAR;
                break;
        }
    }

    $action_url = make_url('project_milestone', array('project_key' => $milestone->getProject() instanceof Project ? $milestone->getProject()->getKey() : 0, 'board_id' => isset($board) ? $board->getID() : '0', 'milestone_id' => (int) $milestone->getID()));

    $starthidden = $starthidden ?? false;
    $includeform = $includeform ?? true;

    $options = compact('starthidden', 'includeform', 'milestone', 'action_url', 'savebuttonlabel', 'milestoneplaceholder', 'milestoneheader', 'milestonenamelabel', 'milestone_type');
    if (isset($board)) {
        $options['board'] = $board;
    }

    include_component('project/editmilestone', $options);

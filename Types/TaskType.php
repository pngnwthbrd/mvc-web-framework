<?php

namespace Types;

class TaskType extends AbstractType
{
    protected $id;
    protected $parent_id;
    protected $fk_project;
    protected $fk_user;
    protected $name;
    protected $start_date;
    protected $end_date;
    protected $progress;
    protected $progress_time;
    protected $tags;
    protected $active;
    protected $uc;
    protected $tc;
    protected $ue;
    protected $te;
}
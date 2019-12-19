<?php

function add_task(string $name,string $desc, int $start, int $end): array
{
    return [
        'name' => $name,
        'desc' => $desc,
        'start' => $start,
        'end' => $end
    ];
}

function post_task()
{
    $isset_task_name = (isset($_POST['task_name']) and !empty($_POST['task_name']));
    $isset_task_desc = (isset($_POST['task_desc']) and !empty($_POST['task_desc']));
    $isset_task_start = (isset($_POST['task_start']) and !empty($_POST['task_start']));
    $isset_task_end = (isset($_POST['task_end']) and !empty($_POST['task_end']));
    if($isset_task_desc and $isset_task_end and $isset_task_name and $isset_task_start){
        return add_task($_POST['task_name'], $_POST['task_desc'], $_POST['task_start'], $_POST['task_end']);
    }else{
        return [];
    }
}
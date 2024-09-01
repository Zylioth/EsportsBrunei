<?php
//function to validate a topic that is to be created so that there could not be any duplicates or missing fields

function validateTopic($topic)
{
    $errors = array();

    if (empty($topic['name'])) {
        array_push($errors, 'Name is required');
    }

    $existingTopic = selectOne('topics', ['name' => $post['name']]);
    if ($existingTopic) {
        if (isset($post['update-topic']) && $existingTopic['id'] != $post['id']) {
            array_push($errors, 'Name already exists');
        }

        if (isset($post['add-topic'])) {
            array_push($errors, 'Name already exists');
        }
    }

    return $errors;
}

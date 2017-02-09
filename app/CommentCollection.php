<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class CommentCollection extends Collection
{
    public function threaded()
    {
        $comments = parent::groupBy('parent_id');
        if (count($comments)) {
            $comments['root'] = $comments[''];
            unset($comments['']);
        }
        return $comments;
    }
}
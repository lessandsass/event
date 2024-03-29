<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class DeleteCommentController extends Controller
{
    public function __invoke($id, Comment $comment)
    {

        $this->authorize('delete', $comment);
        $comment->delete();

        return back();
    }
}

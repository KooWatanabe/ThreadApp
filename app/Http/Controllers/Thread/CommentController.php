<?php

namespace App\Http\Controllers\Thread;

use App\Account;
use App\Thread;
use App\Comment;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    protected $home;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function commentFixForm(int $thread_id, int $commnet_id)
    {
        $data = ['thread_id' => $thread_id, 'comment_id' => $commnet_id];
        return view('thread.commentFix', $data);
    }

    public function post(Request $request, int $thread_id)
    {
        $this->validator($request->all())->validate();
        $this->create(
            [
                'account_id' => \Auth::user()->id,
                'thread_id' => $thread_id,
                'comment' => $request->input('comment'),
            ]
        );
        return redirect(route('thread',['thread_id' => $thread_id]));
    }

    public function commentFix(Request $request, int $thread_id, int $comment_id)
    {
        $this->validator($request->all())->validate();
        $this->update($comment_id, $request->input('comment'));
        return redirect(route('thread',['thread_id' => $thread_id]));
    }

    public function commentDeleteForm(int $thread_id, int $comment_id)
    {
        if (!$this->checkPostUser(\Auth::user()->id, $comment_id)){
            return redirect(route('thread', ['thread_id' => $thread_id]));
        }
        $comment = $this->getCommentById($comment_id);
        $data = ['thread_id' => $thread_id, 'comment' => $comment];
        return view('thread.commentDelete', $data);
    }

    public function commentDelete(Request $request, int $thread_id, int $comment_id)
    {
        $comment = $this->getCommentById($comment_id);
        if ($comment->id === $comment_id) $comment->delete();
        return redirect(route('thread',['thread_id' => $thread_id]));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'comment' => 'required|max:300',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Comment
     */
    protected function create(array $data): void
    {
        Comment::create([
            'account_id' => $data['account_id'],
            'thread_id' => $data['thread_id'],
            'comment' => $data['comment'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Comment
     */
    protected function update(int $comment_id, string $comment): void
    {
        Comment::find($comment_id)->update([
            'comment' => $comment,
        ]);
    }

    protected function checkPostUser(int $account_id, int $comment_id)
    {
        return Comment::find($comment_id)->account_id === $account_id ? true : false;
    }

    protected function getCommentById(int $comment_id)
    {
        return Comment::find($comment_id);
    }
}
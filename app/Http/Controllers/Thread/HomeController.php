<?php

namespace App\Http\Controllers\Thread;

use App\Account;
use App\Thread;
use App\Comment;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->getHomeData();
        if ($request->input('created', false) === '1') $data['create_flg'] = true;
        return view('thread.home', $data);
    }

    public function getHomeData()
    {
        $threads = Thread::paginate(10);
        if ($threads->count() === 0){
            return ['flg' => false];
        }

        $comments = Comment::all();
        $thread_datas = [];
        foreach ($threads as $thread) {
            $count = strval($comments->where('thread_id', $thread->id)->count());
            $thread_data = [
                'name' => $thread->name.'('.$count.')',
                'create' => Carbon::createFromFormat('Y-m-d H:i:s', $thread->created_at)->format('Y/m/d H:i:s'),
                'update' => Carbon::createFromFormat('Y-m-d H:i:s', $thread->updated_at)->format('Y/m/d H:i:s'),
            ];

            $thread_datas[strval($thread->id)] = $thread_data;
        }
        return [
            'flg' => true,
            'threads' => $threads,
            'thread_datas' => $thread_datas,
            'create_flg' => false,
        ];
    }

    public function threadCreateForm()
    {
        return view('thread.threadCreate');
    }

    public function threadCreate(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->create(
            [
                'account_id' => \Auth::user()->id,
                'title' => $request->input('title')
            ]
        );

        return redirect(route('home',['created' => true]));
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
            'title' => 'required|max:40',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Thread
     */
    protected function create(array $data): void
    {
        Thread::create([
            'account_id' => $data['account_id'],
            'name' => $data['title'],
        ]);
    }

    public function thread(int $thread_id)
    {
        $account_id = \Auth::user()->id;
        $thread_name = $this->getThreadName($thread_id);
        $create_flg = $this->checkCreateUser($account_id, $thread_id);
        $comments = $this->getCommentByThreadId($thread_id);
        $dont_write = $comments->count() > 100 ? true : false;

        $data = [
            'account_id' => $account_id,
            'thread_id' => $thread_id,
            'thread_name' => $thread_name,
            'create_flg' => $create_flg,
            'dont_write' => $dont_write,
            'comments' => $comments->paginate(10),
        ];
        return view('thread.thread', $data);
    }

    protected function checkCreateUser(int $account_id, int $thread_id)
    {
        return Thread::find($thread_id)->account_id === $account_id ? true : false;
    }

    protected function getCommentByThreadId(int $thread_id)
    {
        return Comment::where('thread_id', $thread_id);
    }

    protected function getThreadName(int $thread_id)
    {
        return Thread::find($thread_id)->name;
    }

    public function threadDeleteForm(int $thread_id)
    {
        if (!$this->checkCreateUser(\Auth::user()->id, $thread_id)){
            return redirect('home');
        }
        $thread_name = $this->getThreadName($thread_id);
        $data = ['thread_id' => $thread_id, 'thread_name' => $thread_name];
        return view('thread.threadDelete', $data);
    }

    public function threadDelete(Request $request, int $thread_id)
    {
        $target_comment_ids = [];
        $comments = $this->getCommentByThreadId($thread_id)->get();
        foreach($comments as $comment){
            $target_comment_ids[] = $comment->id;
        }
        Comment::destroy($target_comment_ids);
        $thread = Thread::find($thread_id);
        if ($thread->id === $thread_id) $thread->delete();
        return redirect('home');
    }
}

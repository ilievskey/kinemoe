<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Genre;
use App\Models\Like;
use App\Models\Post;
use App\Models\Report;
use App\Models\Role;
use App\Models\SystemSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // home page dash====================================================================================================================
    public function home(){
        // chart.js stuff
        $postsCount = Post::count();
        $commentsCount = Comment::count();
        $likesCount = Like::count();
        $latestUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        $latestReports= Report::with('user', 'post', 'comment')->latest()->take(5)->get();

        return view('admin.home', compact('postsCount', 'commentsCount', 'likesCount', 'latestUsers', 'latestReports'));
    }

    // users section====================================================================================================================
    public function users(){
        return view('admin.users');
    }

    //--------------search user
    public function searchUsers(Request $request)
    {
        $query = $request->get('q');
        if(strpos($query, '@') === 0){
            $parts = explode(' ', substr($query, 1), 2);
            $roleName = $parts[0];
            $userName = $parts[1] ?? '';

            $role = Role::where('role_name', 'LIKE', '%' . $roleName . '%')->first();

            if($role){
                $users = User::where('user_role', $role->id)
                    ->where('name', 'LIKE', '%' . $userName . '%')
                    ->get(['id', 'name', 'profile_picture']);
            } else {
                $users = collect();
            }
        } else{
            $users = User::where('name', 'LIKE', '%' . $query . '%')->get(['id', 'name', 'profile_picture']);
        }

        return response()->json($users);
    }

    //--------------edit user
    public function editUser(User $user)
    {
        $roles = Role::all();
        $posts = Post::where('post_by', $user->id)->latest()->paginate(3);
        $comments = Comment::where('comment_by', $user->id)->latest()->paginate(3);
        $contents = Content::all(); //for artists
        $linkedContents = $user->contents->pluck('id')->toArray(); //for artists

        return view('admin.edit-user', compact('user', 'posts', 'comments', 'roles', 'contents', 'linkedContents'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'badge' => 'nullable',
            'user_role' => 'required|integer|exists:roles,id',
            'biography' => 'nullable|string',
            'awards' => 'nullable|integer|min:0',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_role = $request->user_role;
        $user->badge = $request->badge;

        if ($request->user_role == 3) {
            $user->biography = $request->biography;
            $user->awards = $request->awards;

            $linkedContentIds = $request->input('linked_content', []);
            $user->contents()->sync($linkedContentIds);
        }

        if ($request->has('ban')) {
            $user->ban();
        } elseif ($request->has('unban')) {
            $user->unban();
        }

        if ($request->has('warn')) {
            $user->addWarning();
        }

        if ($request->has('clear_warnings')) {
            $user->warnings_count = 0;
            $user->save();
        }
        
        $user->save();

        return redirect()->route('dashboard')->with('success', 'User updated successfully.');
    }

    //--------------delete user
    public function deleteUser(User $user){

        $user->delete();
        return response()->json(['success' => 'User deleted successfully']);
    }

    //--------------edit post
    public function editPost(User $user, Post $post)
    {
        return view('admin.usercontent.edit-post', compact('user', 'post'));
    }

    public function updatePost(Request $request, User $user, Post $post)
    {
        $request->validate([
            'post_title' => 'required|string|max:255',
            'post_content' => 'required|string',
        ]);

        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->save();

        return redirect()->route('admin.users.edit', $user->id)->with('success', 'Post updated successfully.');
    }

    //--------------edit comment
    public function editComment(User $user, Comment $comment)
    {
        return view('admin.usercontent.edit-comment', compact('user', 'comment'));
    }

    public function updateComment(Request $request, User $user, Comment $comment)
    {
        $request->validate([
            'comment_content' => 'required|string',
        ]);

        $comment->comment_content = $request->comment_content;
        $comment->save();

        return redirect()->route('admin.users.edit', $user->id)->with('success', 'Comment updated successfully.');
    }

    // reports section====================================================================================================================
    public function showReports()
    {
        $reports = Report::with('user', 'post', 'comment')->latest()->get();
        return view('admin.reports', compact('reports'));
    }

    public function deleteReport(Report $report)
    {
        if ($report->post) {
            $report->post->delete();
        } elseif ($report->comment) {
            $report->comment->delete();
        }
        $report->delete();

        return back()->with('success', 'Content and report deleted successfully.');
    }

    public function dismissReport(Report $report)
    {
        $report->delete();

        return back()->with('success', 'Report dismissed successfully.');
    }

    //content section====================================================================================================================
    public function content()
    {
        $contents = Content::with('genre')->latest()->get();
        return view('admin.content', compact('contents'));
    }

    public function createContent()
    {
        $genres = Genre::all();
        return view('admin.content.create-content', compact('genres'));
    }

    public function storeContent(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'genre_id' => 'required|exists:genres,id',
            'cast' => 'required|string',
            'content_type' => 'required|in:movie,series,podcast',
            'release_date' => 'required|date',
            'scheduled_for' => 'nullable|date|after:now'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('content_images', 'public');
        }
        
        Content::create($data);

        return redirect()->route('dashboard')->with('success', 'Content added successfully.');
    }

    public function editContent(Content $content)
    {
        $genres = Genre::all();
        return view('admin.content.edit-content', compact('content', 'genres'));
    }

    public function updateContent(Request $request, Content $content)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
            'genre_id' => 'required|exists:genres,id',
            'cast' => 'required|string',
            'content_type' => 'required|in:movie,series,podcast',
            'release_date' => 'required|date',
            'scheduled_for' => 'nullable|date|after:now'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($content->image_path) {
                Storage::disk('public')->delete($content->image_path);
            }
            $data['image_path'] = $request->file('image')->store('content_images', 'public');
        }

        $content->update($data);

        return redirect()->route('dashboard')->with('success', 'Content updated successfully.');
    }

    public function deleteContent(Content $content)
    {
        if ($content->image_path) {
            Storage::disk('public')->delete($content->image_path);
        }

        $content->delete();

        return response()->json(['success' => 'Content deleted successfully.']);
    }

    //settings section====================================================================================================================

    public function settings(){
        $settings = SystemSettings::first();
        return view('admin.settings', compact('settings'));
    }

    public function settingsUpdate(Request $request){
        
        $request->validate([
            'site_name' => 'required|string|max:255',
            'image_path' => 'nullable|image|max:2048',
            'site_contact' => 'required|string|max:255',
            'site_name' => 'required|string|max:255',
        ]);

        $settings = SystemSettings::first();
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('public/settings');
            $settings->image_path = $imagePath;
        }

        $settings->update([
            'site_name' => $request->site_name,
            'site_contact' => $request->site_contact,
            'site_tos' => $request->site_tos,
        ]);

        return redirect()->route('dashboard')->with('success', 'Settings updated successfully.');
    }

    
}

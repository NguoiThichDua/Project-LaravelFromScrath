<?php

namespace App\Http\Controllers;

# Xoá file
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
# Khi sử dụng đến model nào thì gọi nó ở đây
use App\Post;
# Sử dụng câu lệnh DB
use DB;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        # Hạn chế đăng nhập để thực hiện chức năng
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # $posts = Post::all();
        # $posts = Post::orderBy('title','asc')->get();
        # $posts = Post::where('title','Post two')->get();
        # $posts = Post::orderBy('title','desc')->get();
        # $posts = DB::select('SELECT * FROM posts WHERE id=1');
        # $posts = Post::orderBy('title','desc')->take(1)->get();
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        # Upload File
        if($request->hasFile('cover_image')){
            # lấy tên tập tin với phần mở rộng
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            # Chỉ lấy tên không lấy đuôi mở rộng
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            # Lấy phần đuôi mở rộng
            $extension = $request->file('cover_image')->guessClientExtension();
            # Tên để lưu ở DB
            $fileNameToStore = $fileName.'.'.time().'.'.$extension;
            # Upload
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }else{
            $fileNameToStore = 'noImage.png';
        }

        # Create Post
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        
        return  redirect('/posts')->with('success', 'Created Post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        
        # Check xem có phải người đăng hay không
        if(auth()->user()->id !== $post->user_id){
            return redirect()->back()->with('error', auth()->user()->id);
        }
        
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        # Upload File
        if($request->hasFile('cover_image')){
            # lấy tên tập tin với phần mở rộng
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            # Chỉ lấy tên không lấy đuôi mở rộng
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            # Lấy phần đuôi mở rộng
            $extension = $request->file('cover_image')->guessClientExtension();
            # Tên để lưu ở DB
            $fileNameToStore = $fileName.'.'.time().'.'.$extension;
            # Upload
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
                
        # Create Post
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;

        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }

        $post->save();
        
        return  redirect('/posts')->with('success', 'Updated Post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        # Check xem có phải người đăng hay không
        if(auth()->user()->id !== $post->user_id){
            return redirect()->back()->with('error', 'Unauthoirezed Pages');
        }

        if($post->cover_image != 'noImage.png'){
            # Delete img
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Deleted Post');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    private $category;
    private $post;

    public function __construct(Category $category, Post $post){
        $this->category = $category;
        $this->post     = $post;
    }

    public function index(){
        $all_categories = $this->category->orderBy('updated_at', 'desc')->get();

        $uncategorized_count = 0;
        $all_posts = $this->post->all();
        // Not including the hidden posts

        foreach ($all_posts as $post){
            if ($post->categoryPost->count() == 0){
                $uncategorized_count++;
            }
        }
        // Check if the post is existing in the category_post table

        return view('admin.categories.index')
                ->with('all_categories', $all_categories)
                ->with('uncategorized_count', $uncategorized_count);
    }

    public function store(Request $request){
        # Validate form data
        $request->validate([
            'name' => 'required|min:1|max:50|unique:categories,name'
        ]);

        # Save the category
        $this->category->name = ucwords(strtolower($request->name));
        $this->category->save();

        #Go back to homepage
        return redirect()->back();
    }

    public function edit($id){
        $category = $this->category->name;
        return view('admin.categories.modal.action', $category->id);
        
    }

    public function update(Request $request, $id){
        #1. Validate the data from the form
        $request->validate([
            'new_name' => 'required|min:1|max:50|unique:categories,name,' . $id
        ]);

        #2. Update the category
        $category = $this->category->findOrFail($id);
        $category->name = ucwords(strtolower($request->new_name));
        $category->save();

        return redirect()->back();
    }

    public function destroy($id){
        $this->category->destroy($id);

        return redirect()->back();
    }
}

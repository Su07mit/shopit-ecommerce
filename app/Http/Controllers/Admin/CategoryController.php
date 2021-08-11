<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index(): View
    {
        $categories = Category::paginate(12);
        return view('admin.categories.index', compact('categories'));
    }


    public function create(): View
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }


    public function store(Request $request): RedirectResponse
    {
        $request['slug'] = Str::slug($request['slug']);

        $data = $request->validate([
            'name'          => ['required'],
            'slug'          => ['required', 'unique:categories,slug'],
            'image'         => ['nullable', 'image', 'mimes:png,jpg,gif'],
            'category_id'   => ['nullable', 'exists:categories,id'],
            'description'   => ['nullable'],
        ]);

        unset($data['image']);

        if ($request->hasFile('image')) {
            $data['media_id'] = (new MediaService)->upload($request->file('image'), 'categories');
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category added Successfully!');
    }


    public function show(Category $category): View
    {
        return view('admin.categories.show', compact('category'));
    }


    public function edit(Category $category): View
    {
        $categories = Category::where('id', '!=', $category->id)->get();

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $request['slug'] = Str::slug($request['slug']);

        $data = $request->validate([
            'name'          => ['required'],
            'slug'          => ['required', 'unique:categories,slug,' . $category->id],
            'image'         => ['nullable', 'image', 'mimes:png,jpg,gif'],
            'category_id'   => ['nullable', 'exists:categories,id'],
            'description'   => ['nullable'],
        ]);

        unset($data['image']);

        if ($request->hasFile('image')) {

            if ($category->media_id && $category->media) {
                Storage::delete('public/' . $category->media->path);
            }

            $data['media_id'] = (new MediaService)->upload($request->file('image'), 'categories');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category Updated Successfully!');
    }


    public function destroy(Category $category): RedirectResponse
    {
        if ($category->media_id && $category->media) {
            Storage::delete('public/' . $category->media->path);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category Deleted Successfully!');
    }

    public function generateSlug(Request $request): string
    {
        if (empty($request->title)) {
            return "";
        }

        $title = Str::slug($request->title);
        return $this->checkAndGenerateSlug($title, 0);
    }

    public function checkAndGenerateSlug(string $title, int $number = 0): string
    {
        if ($number > 0) {
            $new_title = $title . "-" . $number;
        }

        if (Category::where('slug', $new_title ?? $title)->first()) {
            return $this->checkAndGenerateSlug($title, $number + 1);
        }

        return $new_title ?? $title;
    }
}

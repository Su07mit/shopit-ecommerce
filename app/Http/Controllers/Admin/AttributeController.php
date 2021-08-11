<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttributeController extends Controller
{

    public function index(): View
    {
        $attributes = Attribute::paginate(12);
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create(): View
    {
        return view('admin.attributes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'          => ['required'],
            'description'   => ['nullable'],
        ]);

        Attribute::create([
            'name'  => $request->name,
            'description'   => clean($request->description),
        ]);

        return redirect()->route('admin.attributes.index')->with('success', 'Attribute Added Successfully');
    }


    public function edit(Attribute $attribute): View
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(Request $request, Attribute $attribute): RedirectResponse
    {
        $request->validate([
            'name'          => ['required'],
            'description'   => ['nullable'],
        ]);

        $attribute->update([
            'name'  => $request->name,
            'description'   => clean($request->description),
        ]);

        return redirect()->route('admin.attributes.index')->with('success', 'Attribute Updated Successfully');
    }


    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return redirect()->route('admin.attributes.index')->with('success', 'Attribute Deleted Successfully');
    }
}

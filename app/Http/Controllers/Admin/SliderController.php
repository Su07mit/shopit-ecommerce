<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::paginate();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = request()->validate([
            'name'      =>  ['required'],
            'image'     =>  ['required', 'image', 'mimes:png,jpg,gif'],
            'url'       =>  ['required'],
        ]);

        $data['media_id'] = MediaService::upload($request->file('image'), "sliders");

        Slider::create($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider Added Successfully');
    }

    public function show(Slider $slider): View
    {
        return view('admin.sliders.show', compact('slider'));
    }

    public function edit(Slider $slider): View
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider): RedirectResponse
    {
        $data = request()->validate([
            'name'      =>  ['required'],
            'image'     =>  ['nullable', 'image', 'mimes:png,jpg,gif'],
            'url'       =>  ['required'],
        ]);

        if ($request->hasFile('image')) {
            $media = $slider->media;
            Storage::delete('/public/' . $media->path);

            $data['media_id'] = MediaService::upload($request->file('image'), "sliders");
        }

        $slider->update($data);

        if ($request->hasFile('image')) {
            $media->delete(); //delete old media
        }

        return redirect()->route('admin.sliders.index')->with('success', 'Slider Updated Successfully');
    }

    public function destroy(Slider $slider): RedirectResponse
    {
        $media = $slider->media;

        Storage::delete('/public/' . $media->path);

        $slider->delete();
        $media->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider Deleted Successfully');
    }
}

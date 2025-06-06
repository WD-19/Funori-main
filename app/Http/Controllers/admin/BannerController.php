<?php

namespace App\Http\Controllers\admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BannerController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Banner::query();

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%")
                    ->orWhere('order', 'like', "%{$search}%")
                    ->orWhere('start_date', 'like', "%{$search}%")
                    ->orWhere('end_date', 'like', "%{$search}%");
            });
        }

        $banners = $query->paginate(5);

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $datas = $request->all();
            if ($request->hasFile('image_url')) {
                $file = $request->file('image_url');
                $fileName = time() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('imgs', $fileName, 'public');
                $datas['image_url'] = $path;
            }

            Banner::create($datas);
            return redirect()->route('admin.banners.create')->with('message', 'Thêm banner thành công');
        } catch (\Throwable $th) {
            Log::error('Lỗi nghiêm trọng', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::find($id);
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $datas = $request->all();
            if ($request->hasFile('image_url')) {
                $file = $request->file('image_url');
                $fileName = time() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('imgs', $fileName, 'public');
                $datas['image_url'] = $path;
            }
            $banner = Banner::find($id);
            $banner->update($datas);
            return redirect()->route('admin.banners.edit', $banner->id)->with('message', 'Sửa banner thành công');
        } catch (\Throwable $th) {
            Log::error('Lỗi nghiêm trọng', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $banner = Banner::find($id);
            $banner->delete();
            Storage::delete($banner->image_url);

            return redirect()->route('admin.banners.index')->with('message', 'Sửa banner thành công');
        } catch (\Throwable $th) {
            Log::error('Lỗi nghiêm trọng', ['message' => $th->getMessage()]);
        }
    }
}

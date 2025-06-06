<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Brand::query();

        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('created_at', 'like', "%{$search}%")
                    ->orWhere('updated_at', 'like', "%{$search}%");
            });
        }

        $brands = $query->paginate(5);

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $datas = $request->all();
            if ($request->hasFile('logo_url')) {
                $file = $request->file('logo_url');
                $fileName = time() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('imgs', $fileName, 'public');
                $datas['logo_url'] = $path;
            }
            if ($request->slug) {
                $datas['slug'] = Str::slug($request->slug);
            } else {
                $datas['slug'] = Str::slug($request->name);
            }

            Brand::create($datas);
            return redirect()->route('admin.brands.create')->with('message', 'Thêm Brand thành công');
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
        $brand = Brand::find($id);
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $datas = $request->all();
            if ($request->hasFile('logo_url')) {
                $file = $request->file('logo_url');
                $fileName = time() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('imgs', $fileName, 'public');
                $datas['logo_url'] = $path;
            }
            if ($request->slug) {
                $datas['slug'] = Str::slug($request->slug);
            } else {
                $datas['slug'] = Str::slug($request->name);
            }
            $brand = Brand::find($id);
            $brand->update($datas);
            return redirect()->route('admin.brands.edit', $brand->id)->with('message', 'Sửa Brand thành công');
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
            $brand = Brand::find($id);
            $brand->delete();
            Storage::delete($brand->logo_url);

            return redirect()->route('admin.brands.index')->with('message', 'Sửa Brand thành công');
        } catch (\Throwable $th) {
            Log::error('Lỗi nghiêm trọng', ['message' => $th->getMessage()]);
        }
    }
}

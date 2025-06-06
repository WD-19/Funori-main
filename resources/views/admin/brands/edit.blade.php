@extends('admin.layout.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-30">
        <h3>Update brand</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="index.html">
                    <div class="text-tiny">Dashboard</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <a href="#">
                    <div class="text-tiny">brand</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Update brand</div>
            </li>
        </ul>
    </div>
    <!-- form-add-brand -->
    <form class="form-add-brand" method="Post" enctype="multipart/form-data"
        action="{{ route('admin.brands.update', $brand->id) }}">
        @csrf
        @method('PUT')
        <div class="wg-box mb-30">
            <fieldset class="img-edit1">
                <div class="body-title mb-10">Upload image_url</div>
                <div class="upload-image mb-16">
                    <div class="up-load">
                        <label class="uploadfile" for="myFile">
                            <span class="icon">
                                <i class="icon-upload-cloud"></i>
                            </span>
                            <div class="text-tiny">Drop your images here or select <span class="text-secondary">click to
                                    browse</span></div>
                            <input type="file" id="myFile" name="logo_url">
                            <img src="#" id="myFile-input" alt="">
                        </label>
                    </div>
                    {{-- <div class="flex gap20 flex-wrap">
                        <div class="item">
                            <img src="images/upload/img-1.jpg" alt="">
                        </div>
                        <div class="item">
                            <img src="images/upload/img-2.jpg" alt="">
                        </div>
                    </div> --}}
                </div>
                <img src="{{ asset('storage/' . $brand->logo_url) }}" alt="" class="img-edit">
                <div class="body-text">You need to add at least 4 images. Pay attention to the quality of the pictures you
                    add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the
                    brand shows all the details</div>
            </fieldset>

        </div>

        <div class="wg-box mb-30">
            <fieldset class="name">
                <div class="body-title mb-10">name <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Enter title" name="name" tabindex="0"
                    value="{{ $brand->name }}" aria-required="true" required="">
                <div class="text-tiny text-surface-2">Do not exceed 20 characters when entering the brand name.</div>
            </fieldset>
            <fieldset class="name">
                <div class="body-title mb-10">slug</div>
                <input class="mb-10" type="text" placeholder="Enter title" name="slug" tabindex="0"
                    value="{{ $brand->slug }}" aria-required="true">
                <div class="text-tiny text-surface-2">Do not exceed 20 characters when entering the brand name.</div>
            </fieldset>
            <fieldset class="category">
                <div class="body-title mb-10">description <span class="tf-color-1">*</span></div>
                <textarea name="description" id="" cols="30" rows="10">
                    {{ $brand->description }}
                </textarea>
            </fieldset>
            <div class="cols-lg gap22">
                <fieldset class="sale-price">
                    <div class="body-title mb-10">is_active</div>
                    <select name="is_active" id="">
                        <option value="1" {{ $brand->is_active == 1 ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="0" {{ $brand->is_active == 0 ? 'selected' : '' }}>Chưa kích hoạt</option>
                    </select>
                </fieldset>
            </div>
        </div>

        <div class="cols gap10">
            <button class="tf-button w380" type="submit">Update brand</button>
            <a href="#" class="tf-button style-3 w380" type="submit">Cancel</a>
        </div>
    </form>
@endsection

@extends('admin.layout.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-30">
        <h3>Add Banner</h3>
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
                    <div class="text-tiny">Banner</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Add Banner</div>
            </li>
        </ul>
    </div>
    <!-- form-add-Banner -->
    <form class="form-add-Banner" method="Post" enctype="multipart/form-data" action="{{ route('admin.banners.store') }}">
        @csrf
        <div class="wg-box mb-30">
            <fieldset>
                <div class="body-title mb-10">Upload image_url</div>
                <div class="upload-image mb-16">
                    <div class="up-load">
                        <label class="uploadfile" for="myFile">
                            <span class="icon">
                                <i class="icon-upload-cloud"></i>
                            </span>
                            <div class="text-tiny">Drop your images here or select <span class="text-secondary">click to
                                    browse</span></div>
                            <input type="file" id="myFile" name="image_url">
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
                <div class="body-text">You need to add at least 4 images. Pay attention to the quality of the pictures you
                    add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the
                    Banner shows all the details</div>
            </fieldset>
        </div>

        <div class="wg-box mb-30">
            <fieldset class="name">
                <div class="body-title mb-10">link_url <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Enter title" name="link_url" tabindex="0" value=""
                    aria-required="true" required="">
                <div class="text-tiny text-surface-2">Do not exceed 20 characters when entering the Banner name.</div>
            </fieldset>
            <fieldset class="name">
                <div class="body-title mb-10">Title <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Enter title" name="title" tabindex="0" value=""
                    aria-required="true" required="">
                <div class="text-tiny text-surface-2">Do not exceed 20 characters when entering the Banner name.</div>
            </fieldset>
            <fieldset class="category">
                <div class="body-title mb-10">description <span class="tf-color-1">*</span></div>
                <textarea name="description" id="" cols="30" rows="10"></textarea>
            </fieldset>
            <div class="cols-lg gap22">
                <fieldset class="price">
                    <div class="body-title mb-10">position <span class="tf-color-1">*</span></div>
                    <input class="" type="text" placeholder="Price" name="position" tabindex="0" value=""
                        aria-required="true" required="">
                </fieldset>
                <fieldset class="sale-price">
                    <div class="body-title mb-10">order</div>
                    <input class="" type="number" placeholder="Sale Price " name="order" tabindex="0"
                        value="" aria-required="true" required="">
                </fieldset>
                <fieldset class="sale-price">
                    <div class="body-title mb-10">is_active</div>
                    <select name="is_active" id="">
                        <option value="1">Kích hoạt</option>
                        <option value="0">Chưa kích hoạt</option>
                    </select>
                </fieldset>
                <fieldset class="schedule">
                    <div class="body-title mb-10">start_date</div>
                    <input type="date" name="start_date">
                </fieldset>
                <fieldset class="schedule">
                    <div class="body-title mb-10">end_date</div>
                    <input type="date" name="end_date">
                </fieldset>
            </div>
        </div>

        <div class="cols gap10">
            <button class="tf-button w380" type="submit">Add Banner</button>
            <a href="#" class="tf-button style-3 w380" type="submit">Cancel</a>
        </div>
    </form>
@endsection

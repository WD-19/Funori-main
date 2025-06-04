@extends('admin.layout.admin')

@section('title', 'Danh sách user')

@section('content')
 <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                                    <h3>All User</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                        <li>
                                            <a href="index.html"><div class="text-tiny">Dashboard</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <a href="#"><div class="text-tiny">User</div></a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">All User</div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- all-user -->
                                <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <form class="form-search">
                                                <fieldset class="name">
                                                    <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value="" aria-required="true" required="">
                                                </fieldset>
                                                <div class="button-submit">
                                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                        <a class="tf-button style-1 w208" href="{{ route('admin.users.create') }}"><i class="icon-plus"></i>Add new</a>
                                    </div>
                                    <div class="wg-table table-all-user">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li>
                                                <div class="body-title">User</div>
                                            </li>    
                                            <li>
                                                <div class="body-title">Phone</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Email</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Account Status</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Role</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Created At</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                        
                                        <ul class="flex flex-column">
                                            @foreach ($users as $user )
                                            
                                                <li class="wg-product item-row">
                                                    <div class="name flex-grow">
                                                        <div class="image">
                                                            <img src="{{ Storage::URL($user->avatar_url) }}" alt="">
                                                        </div>
                                                        <div>
                                                            <div class="title">
                                                                <a href="#" class="body-title-2">{{ $user->full_name }}</a>
                                                            </div>
                                                            {{-- <div class="text-tiny">Product name</div> --}}
                                                        </div>
                                                    </div>
                                                    <div class="body-text">{{ $user->phone_number }}</div>
                                                    <div class="body-text">{{ $user->email }}</div>
                                                    <div class="body-text">{{ $user->account_status }}</div>
                                                    <div class="body-text">{{ $user->role }}</div>
                                                    <div class="body-text">{{ $user->created_at->format('d-m-Y') }}</div>
                                                    <div class="list-icon-function">
                                                        <div class="item eye">
                                                            <i class="icon-eye"></i>
                                                        </div>
                                                        <div class="item edit">
                                                            <i class="icon-edit-3"></i>
                                                        </div>
                                                        <div class="item trash">
                                                            <i class="icon-trash-2"></i>
                                                        </div>
                                                    </div>
                                                </li>
                                              
                                         @endforeach
                                    </ul>


                                    </div>
                                  <div class="pagination-wrapper">
                                        {{ $users->links() }}
                                  </div>
                                </div>
                                <!-- /all-user -->
                            </div>
                            <!-- /main-content-wrap -->
                        </div>

@endsection
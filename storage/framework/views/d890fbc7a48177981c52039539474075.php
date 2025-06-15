<?php $__env->startSection('title', 'Danh sách user'); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <a href="<?php echo e(route('admin.users.index')); ?>"><h3>All User</h3></a>
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
                            <div class="text-tiny">User</div>
                        </a>
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
                        <form class="form-search" method="GET" action="<?php echo e(route('admin.users.index')); ?>">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    value="<?php echo e(request('name')); ?>">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                         <form class="flex items-center gap10" method="GET" action="<?php echo e(route('admin.users.index')); ?>" id="filterForm" style="margin-left: 10px;">
                            <select name="filter" class="form-select" style="margin-bottom:0; width: 180px; font-size: 14px; padding: 4px 8px;" onchange="document.getElementById('filterForm').submit();">
                                <option value="">-- Tất cả --</option>
                                <option value="admin" <?php echo e(request('filter') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                <option value="user" <?php echo e(request('filter') == 'user' ? 'selected' : ''); ?>>User</option>
                                <option value="active" <?php echo e(request('filter') == 'active' ? 'selected' : ''); ?>>Active</option>
                                <option value="inactive" <?php echo e(request('filter') == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                                <option value="banned" <?php echo e(request('filter') == 'banned' ? 'selected' : ''); ?>>Banned</option>
                            </select>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="<?php echo e(route('admin.users.create')); ?>"><i class="icon-plus"></i>Thêm tài khoản</a>
                </div>
                <div class="wg-table table-all-user">
                    <?php
                        function sortIcon($field)
                        {
                            $currentSort = request('sort');
                            $currentOrder = request('order');
                            $isSorted = $currentSort === $field;
                            $isAsc = $currentOrder === 'asc';
                            $nextOrder = $isSorted && $isAsc ? 'desc' : 'asc';
                            $arrow = $isSorted ? ($isAsc ? '▲' : '▼') : '⇅';
                            $color = $isSorted ? '#4F8CFF' : '#aaa';
                            $url = request()->fullUrlWithQuery(['sort' => $field, 'order' => $nextOrder]);

                            return '<a href="' .
                                $url .
                                '" style="margin-left: 6px; color: ' .
                                $color .
                                ';">' .
                                $arrow .
                                '</a>';
                        }
                    ?>

                    <ul class="table-title flex gap20 mb-14">
                         <li>
                            <div class="body-title">ID</div>
                        </li>
                        <li>
                            <div class="body-title">
                                Tên người dùng <?php echo sortIcon('full_name'); ?>

                            </div>
                        </li>
                        <li>
                            <div class="body-title">Số điện thoại</div>
                        </li>
                        <li>
                            <div class="body-title">Email</div>
                        </li>
                        <li>
                            <div class="body-title">Trạng thái tài khoản</div>
                        </li>
                        <li>
                            <div class="body-title">Quyền</div>
                        </li>
                        <li>
                            <div class="body-title">
                                Created At <?php echo sortIcon('created_at'); ?>

                            </div>
                        </li>
                        <li>
                            <div class="body-title">Hành động</div>
                        </li>
                    </ul>


                    <ul class="flex flex-column">
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <li class="wg-product item-row">
                                <div class="body-text"><?php echo e($user->id); ?></div>

                                <div class="name flex-grow">
                                    <div class="image">
                                        <img src="<?php echo e(asset($user->avatar_url ? $user->avatar_url : 'images/images.jpg')); ?>"
                                            alt=""
                                            style="width:38px;height:38px;object-fit:cover;border-radius:50%;">
                                    </div>
                                    <div>
                                        <div class="title">
                                            <a href="#" class="body-title-2"><?php echo e($user->full_name); ?></a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="body-text"><?php echo e($user->phone_number); ?></div>
                                <div class="body-text"><?php echo e($user->email); ?></div>
                                <div>
                                    <div class="block-tracking bg-1 fw-7"
                                        <?php if($user->account_status == 'active'): ?> style="color: #28a745;"
                                                            <?php elseif($user->account_status == 'isactive'): ?>
                                                                style="color: #ffc107;"
                                                            <?php elseif($user->account_status == 'banned'): ?>
                                                                style="color: #dc3545;"
                                                            <?php else: ?>
                                                                style="color: #333;" <?php endif; ?>>
                                        <?php echo e($user->account_status); ?>

                                    </div>
                                </div>
                                <div>
                                    <div class="block-tracking bg-1 fw-7"
                                        <?php if($user->role == 'admin'): ?> style="color: #007bff;"
                                                            <?php elseif($user->role == 'user'): ?>
                                                                style="color: #17a2b8;"
                                                            <?php elseif($user->role == 'moderator'): ?>
                                                                style="color: #6f42c1;"
                                                            <?php else: ?>
                                                                style="color: #333;" <?php endif; ?>>
                                        <?php echo e($user->role); ?>

                                    </div>
                                </div>
                                <div class="body-text"><?php echo e($user->created_at->format('d-m-Y')); ?></div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <a style="color:orange " href="<?php echo e(route('admin.users.show', $user->id)); ?>"> <i
                                                class="icon-eye"></i></a>
                                    </div>
                                    <div class="item edit">
                                         <?php
                                            $isSelf = auth()->id() == $user->id;
                                            $isEditingAdmin = $user->role === 'admin';
                                        ?>

                                        <?php if($isEditingAdmin && !$isSelf): ?>
                                            <i class="fa fa-edit" style="color: #28a745; opacity: 0.4; cursor: not-allowed;" title="Không thể chỉnh sửa admin khác"></i>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" title="Chỉnh sửa">
                                                <i class="fa fa-edit" style="color: #28a745;"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>


                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Showing <?php echo e($users->firstItem()); ?> to <?php echo e($users->lastItem()); ?> of <?php echo e($users->total()); ?> entries
                    </div>
                    <ul class="wg-pagination">
                        <li>
                            <?php if($users->onFirstPage()): ?>
                            <span><i class="icon-chevron-left"></i></span>
                            <?php else: ?>
                            <a href="<?php echo e($users->previousPageUrl()); ?>"><i class="icon-chevron-left"></i></a>
                            <?php endif; ?>
                        </li>
                        <?php $__currentLoopData = $users->getUrlRange(1, $users->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="<?php echo e($page == $users->currentPage() ? 'active' : ''); ?>">
                            <?php if($page == $users->currentPage()): ?>
                            <span><?php echo e($page); ?></span>
                            <?php else: ?>
                            <a href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <?php if($users->hasMorePages()): ?>
                            <a href="<?php echo e($users->nextPageUrl()); ?>"><i class="icon-chevron-right"></i></a>
                            <?php else: ?>
                            <span><i class="icon-chevron-right"></i></span>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /all-user -->
        </div>
        <!-- /main-content-wrap -->
    </div>
                                   

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Funori-main\resources\views/admin/users/index.blade.php ENDPATH**/ ?>
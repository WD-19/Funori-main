<div class="box-content-blog">
            @forelse($posts as $post)
                <div class="blog-1">
                    <a href="{{ route('client.page.show', $post->slug) }}">
                        <img src="{{ $post->featured_image_url ? asset($post->featured_image_url) : asset('client/Picture/Blog/default.jpg') }}"
                            alt="">
                    </a>
                    <div class="content-blog-1">
                        <div class="list-link">
                            {{-- Nếu có categories thì foreach ở đây --}}
                        </div>
                        <div class="title">
                            <a href="{{ route('client.page.show', $post->slug) }}">{{ $post->title }}</a>
                        </div>
                        <div class="box-by">
                            <span>Bởi: {{ $post->author->name ?? 'N/A' }}</span>
                            <span>|</span>
                            <span>{{ $post->published_at ? $post->published_at->format('d/m/Y') : '' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p>Không có bài viết nào.</p>
            @endforelse
        </div>
        {{-- Hiển thị phân trang nếu dùng paginate --}}
        <div class="mt-3">
            {{ $posts->links() }}
        </div>
<div class="blog-header">
    <h1 class="blog-title">
        @if (isset($blog->title) && $blog->title != "")  
            {{ $blog->title }}
        @else
            My New Blog
        @endif
    </h1>
    <p class="lead blog-description">
        @if (isset($blog->desc) && $blog->desc != "")  
            {{ $blog->desc }}
        @else
            Add some description of this blog.
        @endif
    </p>
</div>
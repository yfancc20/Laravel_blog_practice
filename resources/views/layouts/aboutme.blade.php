<div class="sidebar-module sidebar-module-inset">
    <h4>
        @if (isset($blog->a_title) && $blog->a_title != "")
            {{ $blog->a_title }}
        @else
            About me
        @endif
    </h4>
    <p>
        @if (isset($blog->a_content) && $blog->a_content != "")
            {{ $blog->a_content }}
        @else
            Add something about yourself! To let anyone to know about you.
        @endif
    </p>
</div>
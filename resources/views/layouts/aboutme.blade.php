<div class="sidebar-module sidebar-module-inset">
    <h4>{{ $blog->a_title or "About me" }}</h4>
    <p>
        {{
            $blog->a_content
             or
            "Add something about yourself! To let anyone to know about you."
        }}
    </p>
</div>
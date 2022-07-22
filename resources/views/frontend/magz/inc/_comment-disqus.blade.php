<div class="comments">
    <div id="disqus_thread"></div>
    <script>
        (function() {
            var d = document,
                s = d.createElement('script');
            s.src = "https://{{ Settings::get('disqusshortname') }}.disqus.com/embed.js";
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>{{ __('Please enable JavaScript to view the') }} <a href="https://disqus.com/?ref_noscript">{{ __('comments powered by Disqus.') }}</a></noscript>
</div>

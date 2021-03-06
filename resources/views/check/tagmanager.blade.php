@if($_SERVER['SERVER_NAME'] == 'm.motif.me' || $_SERVER['SERVER_NAME'] == 'www.motif.me' || $_SERVER['SERVER_NAME'] == 'motif.me')
    {{--Google Tag Manager--}}
    <noscript>
        <iframe src="//www.googletagmanager.com/ns.html?id=GTM-M54JN5"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = '//www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M54JN5');</script>
    {{--End Google Tag Manager--}}


    <script>
        var _learnq = _learnq || [];
        _learnq.push(['account', 'ESvdYS']);

        @if(Session::has('user'))
        _learnq.push(['identify', {
            '$email' : '{{Session::get('user.login_email')}}'
        }]);
        @endif

        (function () {
            var b = document.createElement('script'); b.type = 'text/javascript'; b.async = true;
            b.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'a.klaviyo.com/media/js/analytics/analytics.js';
            var a = document.getElementsByTagName('script')[0]; a.parentNode.insertBefore(b, a);
        })();
    </script>
@endif
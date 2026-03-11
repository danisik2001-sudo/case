<!doctype html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="verification" content="d1c373ab1570cfb9a7dbb53c186b37a2" />
    <title>{{ \App\Models\Setting::query()->first()->sitename }} {{ \App\Models\Setting::query()->first()->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?time={{ time() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;600;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">

    <!-- SEO Meta Tags -->
    <meta name="keywords" content="{{ \App\Models\Setting::query()->first()->keywords }}" />
    <meta name="description" content="{{ \App\Models\Setting::query()->first()->description }}" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ \App\Models\Setting::query()->first()->sitename }} {{ \App\Models\Setting::query()->first()->title }}" />
    <meta property="og:description" content="{{ \App\Models\Setting::query()->first()->description }}" />
    <meta property="og:site_name" content="caseblaze.com" />
    <meta property="og:url" content="https://caseblaze.com" />

    <!-- VK Meta Tags -->
    <meta property="vk:title" content="{{ \App\Models\Setting::query()->first()->sitename }} {{ \App\Models\Setting::query()->first()->title }}" />
    <meta property="vk:description" content="{{ \App\Models\Setting::query()->first()->description }}" />
    <meta property="vk:url" content="https://caseblaze.com" />

    <!-- Additional Optimization -->
    <link rel="canonical" href="https://caseblaze.com" />
    <meta name="format-detection" content="telephone=no" />

    <meta name="1plat" content="374">

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) {
                    return;
                }
            }
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(101212165, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/101212165" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->


</head>

<body class="chrome">

    @if(Auth::user() && Auth::user()->blocked == 1)
    <!-- Сообщение о блокировке, если пользователь заблокирован -->
    <div class="block__container">
        <div class="title">ОШИБКА</div>
        <div class="sub_title">
            <div
                class="text color--inherit variant--h2 align--center bold uppercase">
                Ваш аккаунт заблокирован. Обратитесь в техническую поддержку!
            </div>
        </div>
    </div>
    @else
    <div id="app" class="app-wrapper">
        <app></app>
    </div>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sprite-js/0.1.0/sprite.min.js"></script>
    <script src="{{ mix('js/app.js') }}?time={{ time() }}"></script>

    <script>
        (function(t, l, g, r, m) {
            t[g] || (g = t[g] = function() {
                g.run ? g.run.apply(g, arguments) : g.queue.push(arguments)
            }, g.queue = [], t = l.createElement(r), t.async = !0, t.src = m, l = l.getElementsByTagName(r)[0], l.parentNode.insertBefore(t, l))
        })(window, document, 'tgp', 'script', 'https://telegram.org/js/pixel.js');
        tgp('init', 'eE9FLR83');
    </script>


    <script>
        tgp('event', 'eE9FLR83-j8dU5duu');
    </script>
</body>

</html>
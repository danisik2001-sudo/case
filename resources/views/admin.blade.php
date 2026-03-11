<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico">

    <title>Админ панель</title>

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Montserrat:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="/dash/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="/dash/css/line-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/dash/css/flaticon.css" rel="stylesheet" type="text/css" />
    <link href="/dash/css/flaticon2.css" rel="stylesheet" type="text/css" />
    <link href="/dash/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/dash/css/link.css" rel="stylesheet" type="text/css" />
    <link href="/dash/css/datatables.bundle.min.css" rel="stylesheet" type="text/css" />
    <link href="/dash/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

    <script src="/dash/js/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
    <script src="/dash/js/popper.min.js" type="text/javascript"></script>
    <script src="/dash/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/dash/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="/dash/js/bootstrap-datetimepicker.ru.js" type="text/javascript"></script>
    <script src="/dash/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="/dash/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="/dash/js/scripts.bundle.js" type="text/javascript"></script>
    <script src="/dash/js/datatables.bundle.min.js" type="text/javascript"></script>
    <script src="/dash/js/dtables.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/dash/css/select2.css">
    <link rel="stylesheet" href="/dash/css/select2-bootstrap4.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
</head>

<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <div id="app">
        <app></app>
    </div>
</body>
<script src="{{ mix('js/admin.js') }}?v={{time()}}"></script>

</html>
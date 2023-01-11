<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('pageTitle') {{!empty($pageHeader) ? $pageHeader : 'Kiotviet Giao Van'}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('templates/adminlte/dist/css/skins/skin-blue.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/adminlte/bower_components/select2/dist/css/select2.min.css')}}">

{{--    toastr--}}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{asset('templates/adminlte/dist/css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/main_price.css')}}">
    <link rel="stylesheet" href="{{asset('css/delivery_facebook.css')}}">
    @yield('css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('adminlte.layouts.header')
    @include('adminlte.layouts.sidebar')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="flash-message cashbook-screen">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))

                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#"
                                                                                                         class="close"
                                                                                                         data-dismiss="alert"
                                                                                                         aria-label="close">&times;</a>
                                </p>
                            @endif
                        @endforeach
                    </div> <!-- end .flash-message -->
                </div>
                @yield('content')
            </div>
        </section>
    </div>

    @include('adminlte.layouts.footer')
{{--    @if(auth()->user()->hasDirectPermission('crm.ticket.index'))--}}
{{--        @include('adminlte.crm.ticket.share.popup')--}}
{{--    @endif--}}
</div>

<script src="{{asset('templates/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('templates/adminlte/dist/js/adminlte.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/bootstrap-notify-master/bootstrap-notify.min.js')}}"></script>

<!-- daterangepicker -->
<script src="{{asset('templates/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('templates/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- jquery-autocomplete -->
<script src="{{asset('templates/adminlte/bower_components/jquery-autocomplete/jquery.autocomplete.min.js')}}"></script>

<script src="{{asset('js/common.js')}}"></script>
<script>
    $(function () {
        let ticketPopupValue = '{{ session('ticketPopup') }}';

        if (ticketPopupValue == true){
            $('#modal-ticket').modal('show');
        }

        let ticketCheckbox = $('#ticketPopup');
        // ticketCheckbox.change(function () {
        //     if ($(this).is(":checked")) {
        //         ticketPopup('off');
        //     } else {
        //         ticketPopup('on');
        //     }
        // });

        ticketCheckbox.click(function () {
            ticketPopup('off');
        });

        $('form.ajax-submit').submit(function (e) {
            e.preventDefault();

            var isSubmit = $(this).attr('is-submit');
            if (isSubmit !== 'true') {
                $(this).attr('is-submit', 'true');
                var $this = $(this);
                var url = $this.attr('action');
                var method = $this.attr('method');
                var data = $this.serialize();
                var handle = $this.attr('handle');

                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function (resp) {
                        if (resp.status === 'success') {
                            if (handle === 'alert') {
                                alert(resp.msg);
                                window.location.reload();
                            } else if (handle == 'reload') {
                                window.location.reload();
                            }
                        }
                    }
                });
            } else {
                alert('Please wait');
            }
        });
    });

    function ticketPopup(status) {
        $.ajax({
            type: 'get',
            url: '{{ url('/') }}',
            data: {
                status: status
            },
            dataType: 'json',
            success: function (resp) {
                if (status === 'off'){
                    $('#modal-ticket').modal('toggle');
                }
            }
        });
    }

    function formatNumber(value) {
        let val = (value / 1).toFixed(0).replace(".", ",");
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "click",
            html: true,
            animateIn: 'slideDown',
            animateOut: 'slideUp',
            target: '#popover',
        });
        let body = $('body');
        body.on('click', function (e) {
            $('[data-toggle="popover"]').each(function () {
                //the 'is' for buttons that trigger popups
                //the 'has' for icons within a button that triggers a popup
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });

        body.on('hidden.bs.popover', function (e) {
            $(e.target).data("bs.popover").inState.click = false;
        });
    })
</script>
@yield('script')
@stack('component-scripts')
</body>
</html>

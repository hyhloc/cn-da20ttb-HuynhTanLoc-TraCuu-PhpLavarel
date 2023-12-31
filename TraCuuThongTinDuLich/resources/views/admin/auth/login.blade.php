

<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Administrator Managerment</title>
    <link href="{!! url('/template-admin/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! url('/template-admin/css/font-awesome.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('/template-admin/css/login.min.css') !!}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="login">
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                @if (count($errors) >0)
                     <ul>
                         @foreach($errors->all() as $error)
                             <li class="text-danger"> {{ $error }}</li>
                         @endforeach
                     </ul>
                 @endif

                 @if (session('status'))
                     <ul>
                         <li class="text-danger"> {{ session('status') }}</li>
                     </ul>
                 @endif
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <h1>Đăng nhập</h1>
                    <div>
                        <input type="text" class="form-control" value="{{ old('login') }}" name="login" placeholder="Username" autocomplete="off" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" />
                    </div>
                    <div>
                        <button class="btn btn-lg btn-login btn-block btn-success" type="submit">
                            <input type="hidden" name="action" value="login"/>
                            <i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập
                        </button>
                        <a class="reset_pass" data-toggle="modal" href="#myModal">Quên mật khẩu?</a>
                    </div>
                    <div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <div>
                            <h1><i class="fa fa-paw"></i> Travel</h1>
                            <p>©{{date('Y')}} All Rights Reserved</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Bạn quên Mật khẩu ?</h4>
                </div>
                <div class="modal-body">
                    <p>Điền Email của bạn để nhận reset mật khẩu.</p>
                    <input type="text" name="reset-email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Hủy</button>
                    <button class="btn btn-primary" id="btn-reset-password" type="button">Gửi</button>
                    <img class="image-loading" style="height: 40px;position: absolute;right: 105px;bottom: 18px;display: none;" src="/template-admin/images/loading1.gif" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <script src="{!! asset('/template-admin/js/jquery-1.10.2.min.js') !!}"></script>
    <script src="{!! asset('/template-admin/js/bootstrap.min.js') !!}"></script>
    <script>
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,})+$/;
            return regex.test(email);
        }
        $(document).ready(function(){
            $('#btn-reset-password').on('click', function(){
                var email = $('input[name="reset-email"]').val();
                var token = $('input[name="_token"]').val();
                if(!isEmail(email)){
                    alert('Nhập sai định dạng email');
                    $('input[name="reset-email"]').focus();
                }else{
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        data:{"_token":token, email:email},
                        url: '/admin/ajax/reset-password',
                        success:function(data){
                            alert(data.message);
                            $('.image-loading').css('display','none');
                            if(data.status == 0){
                                $('.btn-primary').css('display','inline');
                                $('input[name="reset-email"]').focus();
                            }
                        },
                        beforeSend:function(){
                            $('.image-loading').css('display','inline');
                            $('.btn-primary').css('display','none');
                        }
                    });
                }
            });
            $('.close-alert').on('click',function(){
                $('.alert-success').fadeOut();
            });

            $('.close-error').on('click',function(){
                $('.alert-danger').fadeOut();
            });

            $('#edit_post_date').on('click',function(){
                $(this).parent().html('<input type="date" name="post_date" id="post_date" class="form-control">');
            });
        });
    </script>
</body>
</html>
<script src="{{ asset('frontend/js/jquery-3.1.1.min.js') }}"></script>

<script src="{{ asset('frontend/js/tether.min.js') }}"></script>

<script src="{{ asset('frontend/js/bootstrap.js') }}"></script>

<script src="{{ asset('frontend/js/swiper.js') }}"></script>

<script src="{{ asset('frontend/js/scripts.js') }}"></script>

<!-- Toster JS -->
<!-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script> -->
<script src="{{ asset('js/toastr.min.js') }}"></script>

@stack('js')

@if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                toastr.error('{{ $error }}',{
                    closeButton:true,
                    progressBar:true,
                });
                
            </script>
        @endforeach
    @endif
        {!! Toastr::message() !!}










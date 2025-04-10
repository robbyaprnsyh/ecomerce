
{{-- Canvas --}}
<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- JavaScripts
============================================= -->
<script src="{{ asset('user/assets/js/jquery.js') }}"></script>
<script src="{{ asset('user/assets/js/plugins.min.js') }}"></script>

<!-- Footer Scripts
============================================= -->
<script src="{{ asset('user/assets/js/functions.js') }}"></script>

<!-- Star Rating Plugin -->
<script src="{{ asset('user/assets/js/components/star-rating.js') }}"></script>
<script>
    $(".numbers").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
    });
</script>
{{-- EndCanvas --}}

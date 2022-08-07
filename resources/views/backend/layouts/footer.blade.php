<script type="text/javascript" src="{{ asset('backend/bundles/libscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js ( jquery.v2.1.4.js ) -->
<script type="text/javascript" src="{{ asset('backend/bundles/vendorscripts.bundle.js') }}"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script type="text/javascript" src="{{ asset('backend/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script> <!-- Sparkline Plugin Js -->
<script type="text/javascript" src="{{ asset('backend/bundles/flotscripts.bundle.js') }}"></script><!-- Flot Charts Plugin Js -->
<script type="text/javascript" src="{{ asset('backend/plugins/raphael/raphael.min.js') }}"></script> <!-- Morris Plugin Js -->
<script type="text/javascript" src="{{ asset('backend/plugins/morrisjs/morris.js') }}"></script> <!-- Morris Plugin Js -->
<script type="text/javascript" src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script> <!-- Jquery Knob Plugin Js -->
<script type="text/javascript" src="{{ asset('backend/js/pages/widgets/infobox/infobox-1.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jquery-countto/jquery.countTo.js') }}"></script> <!-- Jquery CountTo Plugin Js -->

<script type="text/javascript" src="{{ asset('backend/bundles/jvectormapscripts.bundle.js') }}"></script><!-- JVectorMap Plugin Js -->
<script type="text/javascript" src="{{ asset('backend/bundles/mainscripts.bundle.js') }}"></script><!-- Custom Js -->
<script type="text/javascript" src="{{ asset('backend/js/pages/index.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/pages/charts/sparkline.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/pages/maps/jvectormap.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/pages/charts/jquery-knob.js') }}"></script>

{{-- de sters --}}
<script type="text/javascript" src="{{ asset('https://kit.fontawesome.com/abd48c61b4.js') }}"
crossorigin="anonymous"></script>
{{-- de sters si de inlocuit cu i --}}
<script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script> 

{{-- All Banners --}}
<script type="text/javascript" src="{{ asset('backend/bundles/datatablescripts.bundle.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>

{{-- Create Banner --}}
<script type="text/javascript" src="{{ asset('backend/js/pages/forms/form-validation.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/jquery-validation/jquery.validate.js') }}"></script> <!-- Jquery Validation Plugin Css -->
<script type="text/javascript" src="{{ asset('backend/plugins/jquery-steps/jquery.steps.js') }}"></script> <!-- JQuery Steps Plugin Js -->

{{-- Bootstrap switch button --}}
<script type="text/javascript"
src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



@yield('scripts')

<script>
    setTimeout(() => {
        $('#alert').slideUp();
    }, 2000);
</script>

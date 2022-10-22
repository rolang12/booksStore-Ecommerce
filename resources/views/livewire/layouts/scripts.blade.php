 <!-- jQuery -->
 <script src="{{ asset('assets2/js/jquery-2.1.0.min.js') }}"></script>

 <!-- Bootstrap -->
 <script src="{{ asset('assets2/js/popper.js') }}"></script>
 <script src="{{ asset('assets2/js/bootstrap.min.js') }}"></script>

 <!-- Plugins -->
 <script src="{{ asset('assets2/js/owl-carousel.js') }}"></script>
 <script src="{{ asset('assets2/js/accordions.js') }}"></script>
 <script src="{{ asset('assets2/js/datepicker.js') }}"></script>
 <script src="{{ asset('assets2/js/scrollreveal.min.js') }}"></script>
 <script src="{{ asset('assets2/js/waypoints.min.js') }}"></script>
 <script src="{{ asset('assets2/js/jquery.counterup.min.js') }}"></script>
 <script src="{{ asset('assets2/js/imgfix.min.js') }}"></script>
 <script src="{{ asset('assets2/js/slick.js') }}"></script>
 <script src="{{ asset('assets2/js/lightbox.js') }}"></script>
 <script src="{{ asset('assets2/js/isotope.js') }}"></script>

 <!-- Global Init -->
 <script src="{{ asset('assets2/js/custom.js') }}"></script>

 <script>
     $(function() {
         var selectedClass = "";
         $("p").click(function() {
             selectedClass = $(this).attr("data-rel");
             $("#portfolio").fadeTo(50, 0.1);
             $("#portfolio div").not("." + selectedClass).fadeOut();
             setTimeout(function() {
                 $("." + selectedClass).fadeIn();
                 $("#portfolio").fadeTo(50, 1);
             }, 500);

         });
     });
 </script>

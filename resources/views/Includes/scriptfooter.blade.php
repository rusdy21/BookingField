 <!-- Bootstrap core JavaScript-->
 <script src="{{ url('vendor/jquery/jquery.min.js')}}"></script>
 <script src="{{ url('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

 <!-- Core plugin JavaScript-->
 <script src="{{ url('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

 <!-- Custom scripts for all pages-->
 <script src="{{ url('js/sb-admin-2.min.js')}}"></script>

 <!-- Page level plugins -->
 <script src="{{ url('vendor/chart.js/Chart.min.js')}}"></script>

 <!-- Page level custom scripts -->
 <script src="{{ url('js/demo/chart-area-demo.js')}}"></script>
 <script src="{{ url('js/demo/chart-pie-demo.js')}}"></script>

 <!-- Ckeditor -->
 <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

<!-- script ckeditor --->
<script>
    ClassicEditor
            .create( document.querySelector( '.ckeditor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>

<!-- Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- Field_JS -->
<script src="{{ url('js/demo/field-status.js')}}"></script>
<!-- Datepicker Script -->
<script type="text/javascript">
    $(function(){
     $(".datepicker").datepicker({
         format: 'yyyy-mm-dd',
         autoclose: true,
         todayHighlight: true,
     });
    });
   </script>


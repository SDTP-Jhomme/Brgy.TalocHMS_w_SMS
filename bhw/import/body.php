<!-- Bootstrap core JavaScript-->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="../assets/js/sb-admin-2.min.js"></script>
<!-- import Vue.js -->
<script src="../assets/js/vue.js"></script>
<!-- import Element.js -->
<script src="../assets/js/element.js"></script>
<!-- import Element-English.js -->
<script src="../assets/js/element-en.js"></script>
<!-- import Axios.js -->
<script src="../assets/js/axios.min.js"></script>
<script>
    $(document).ready(function() {
        $('#userDropdown').click(function(event) {
            event.stopPropagation();
            $("#dropdownMenu").toggle();
        });
        $("#dropdownMenu").on("click", function(event) {
            event.stopPropagation();
        });
    });

    $(document).on("click", function() {
        $("#dropdownMenu").hide();
    });
</script>
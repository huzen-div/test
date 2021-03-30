</div>
</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy;2020, สำนักงานการฌาปนกิจสงเคราะห์ กระทรวงสาธารณสุข</div>
            <!--<div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>-->
        </div>
    </div>
</footer>
</div>
</div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>



<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('js/scripts.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<!-- <script src="<?= base_url('assets/demo/chart-area-demo.js'); ?>"></script> -->
<!-- <script src="<?= base_url('assets/demo/chart-bar-demo.js'); ?>"></script> -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/demo/datatables-demo.js'); ?>"></script>
<script>
    $(function() {

        $("#myModal").on('show.bs.modal', function(e) {
            var link = $(e.relatedTarget);
            $(this).find('.modal-content').load(link.attr('href'));
        })
    })
    $(document).ready(function() {

        $(".value").trigger('change');
        $(".vat").trigger('change');
        $(".cal").trigger('change');

        $(".findage").trigger('change');
        $(".findage2").trigger('change');
        $(".findage3").trigger('change');
        $("#category_main_id").trigger('change');
        $(".money").trigger('keyup');
        // $('input:radio[name="type_id"]').trigger('change');
        $('.type_id').trigger('change');
        $('.deposit_withdraw').trigger('change');

    });
</script>
</body>

</html>
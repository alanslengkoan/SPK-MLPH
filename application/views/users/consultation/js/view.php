<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
    // untuk tambah & ubah data
    var untukProcess = function() {
        $(document).on('submit', '#form-consultation', function(e) {
            e.preventDefault();

            var nilai = $('[id="nilai"]');
            for (let i = 0; i < nilai.length; i++) {
                $(nilai[i]).attr('required', 'required');
            }

            if ($('#form-consultation').parsley().isValid() == true) {
                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#btn-process').attr('disabled', 'disabled');
                        $('#btn-process').html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        window.location.href = '<?= users_url() ?>consultation/results/' + response.id;

                        $('#btn-process').removeAttr('disabled');
                        $('#btn-process').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                })
            }
        });
    }();
</script>
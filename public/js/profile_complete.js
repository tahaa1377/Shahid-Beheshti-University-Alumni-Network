$(function () {

   // $('#inputDefault').val("");
    $('#non_rel_job').hide();


    $(document).on('click','#job_job',function () {


        $("[name=karmand_karafarin]").prop('disabled', false);
        $("[name=job_select]").prop('disabled', false);


    });

    $(document).on('click','#job_no , #job_study',function () {


        $("[name=karmand_karafarin]").prop('disabled', true);
        $("[name=job_select]").prop('disabled', true);

        $("[name=karmand_karafarin]").prop('checked', false);
        $("[name=job_select]").prop('checked', false);


        $('#inputDefault').val("");
        $('#non_rel_job').hide('slow');
        $('#non_rel_job1').hide('slow');

    });

    $(document).on('click','#no',function () {

        $('#non_rel_job').show('slow');
        $('#non_rel_job1').show('slow');
        $('#inputDefault').val("");
    });

    $(document).on('click','#yes',function () {

        $('#non_rel_job').hide('slow');
        $('#non_rel_job1').hide('slow');


    });

});
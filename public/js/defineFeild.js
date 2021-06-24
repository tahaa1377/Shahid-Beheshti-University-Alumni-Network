$(function () {


    $(document).on('change','#reg_Field',function () {


        let Group = $('#reg_Field option:selected').val();


        $.ajax('/fetchSubGroup', {
            type: 'post',
            dataType: 'json',
            data:{
                educationGroup:Group
            },
            success: function (data) {

                $('#reg_Academic_orientation').html('<option>زیرگروه تحصیلی</option>');
                for (let i=0; i<data.subGroup.length;i++){
                    $('#reg_Academic_orientation').append('<option>'+data.subGroup[i].subGroup+'</option>');

                }

            }
        })

    });


    $(document).on('change','#reg_Academic_orientation',function () {


        let subEducationGroup = $('#reg_Academic_orientation option:selected').val();


        $.ajax('/fetchField', {
            type: 'post',
            dataType: 'json',
            data:{
                subEducationGroup:subEducationGroup
            },
            success: function (data) {

                $('#reg_univercity').html('<option>رشته</option>');
                for (let i=0; i<data.field.length;i++){
                    $('#reg_univercity').append('<option>'+data.field[i].field+'</option>');

                }

            }
        })

    });



});
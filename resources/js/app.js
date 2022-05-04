require('./bootstrap');

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
if(urlParams.get('type')){
    const type = urlParams.get('type');
    document.getElementById('type').value = type;
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    $('#activity').on('change', function() {
        var activity_id = $(this).val();

       // console.log(activity_id);
        if(activity_id!=0) {
            document.getElementById('user').disabled = false;
            $.ajax({
                url: '/changeStudentList/'+activity_id,
                type: "GET",
                // data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(data) {
                    console.log(data);
                        if(data){
                            $('#user').empty();
                            $('#user').focus;
                            $.each(data, function(key, value){
                            $('select[name="user"]').append('<option value="'+ value.id +'">' + value.name +' '+ value.surname+'</option>');
                        });
                    }
                    else{
                        alert('fail')
                    $('#user').empty();
                    }
                }
            });
        }
        else{
        $('#user').empty();
        document.getElementById('user').disabled = true;
        }
    });
});

$(function () {
$('[data-toggle="tooltip"]').tooltip()
})

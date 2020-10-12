$(document).ready(function() {
   
    console.log('xd');

    $('#search').keyup(function(e) {
        let search = $('#search').val();
        $.ajax({
            url: 'task-search.php',
            type: 'POST',
            data: { search },
            success: function(response) {
                let task = JSON.parse(response);
                console.log(task);
            }
        });
    });

});
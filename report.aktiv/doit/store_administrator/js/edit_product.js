    $(document).ready(function() {



        $('#get_type').change(function() {
            var type = $(this).val();
            $('#get_category').load('./function/get_category.php', {
                type: type
            });
        });

        $('#get_category').change(function() {
            var category = $(this).val();
            $('#manufacturer').load('./function/get_category.php', {
                category: category
            });
        });
        
        $('#manufacturer').change(function() {
            var category = $('#get_category').val();
            var manufacturer = $(this).val();
            $('#model').load('./function/get_category.php', {
                manufacturer : manufacturer,
                category: category
            });
        });
 


        $("#opisanie").wysihtml5();
    });
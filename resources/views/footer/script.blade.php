<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function (){
        $('.add-button').on('click',function (e){
            e.preventDefault();
            let name = $('#name').val();
            let price = $('#price').val();

            $.ajax({
                url: "{{ route('add.product') }}",
                method: "POST",
                data: {
                    name: name,
                    price: price,
                },
                success: function(res) {
                    toastr.success('Product added successfully!');
                    // Assuming your modal has an ID like #myModal
                    $('#addModal').modal('hide');
                    $('.modal-backdrop').remove(); // Remove dark background
                    $('body').removeClass('modal-open'); // Allow scrolling again
                    $('body').css('padding-right', '');
                    $('.table').load(location.href+' .table');

                    $('#editForm')[0].reset(); // Reset the form
                    // Optionally reload or update your table without refresh
                    // location.reload(); // Simple: reload page to see updated data

                },
                error: function(xhr) {
                    toastr.error('Something went wrong.');
                }
            });
        });

        $(document).on('click', '#update-button', function () {
            // When clicking the edit button, load data into the modal
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');

            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#edit-price').val(price);
        });

// Handle form submit separately
        $(document).on('click', '.edit-button', function (e) {
            e.preventDefault();

            let id = $('#edit-id').val();        // Now get value from input field
            let name = $('#edit-name').val();
            let price = $('#edit-price').val();

            $.ajax({
                url: "{{ route('edit.product') }}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}', // important for POST method
                    id: id,
                    name: name,
                    price: price,
                },
                success: function(res) {
                    toastr.success('Product Updated successfully!');
                    $('#editModal').modal('hide'); // Hide the modal
                    $('.modal-backdrop').remove(); // Remove dark background
                    $('body').removeClass('modal-open'); // Allow scrolling again
                    $('body').css('padding-right', '');
                    $('.table').load(location.href+' .table');

                    $('#editForm')[0].reset(); // Reset the form
                    // Optionally reload or update your table without refresh
                    // location.reload(); // Simple: reload page to see updated data
                },
                error: function(xhr, status, error) {
                    toastr.error('Something went wrong.');
                    console.log(xhr.responseText); // Print any errors
                }
            });
        });

        $(document).on('click','.delete',function (e){
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm('Are you sure?')){
                $.ajax({
                    url: "{{ route('delete.product') }}",
                    method: "POST",
                    data: {
                        id: id,
                    },
                    success: function(res) {
                        if (res.status==='success'){
                            toastr.success('Product Deleted successfully!');
                            $('.table').load(location.href+' .table');
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong.');
                    }
                });
            }


        });

    });
</script>

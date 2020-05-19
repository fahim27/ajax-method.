

//// any application shouid  have to need delete oparation. here is a delete operation for laravel and make it with ajax and sweat alert and also use jqeary.


//delete function
//call from any blade file and pass the 2 parameter

//1.id | this is whic item are delete .like $category->id .because i want delete category .
//2.action  |  [like={{route($category.delete,$category->id)}}];


        async function confirmDelete(id, action) {

            const {value: confirm} = await Swal.fire({
				
				//first show alert 
                title: 'Are you sure delete category ?',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!"
            })
            // if confirm
            if (confirm) {
                if (id > 0) {
                    $.ajax({
                        url: action,
                        type: "GET",
                        dataType: 'json',
                        cache: false,
                        success: function (resp) {
                            console.log(resp);
                            if (resp.success == "OK") {
							
							//after success funtion if you can do any thing just what i you want.
                                Swal.fire({
                                    text: resp.message,
                                    type: 'success',
                                });
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: '<P style="color: red;">Oops...<p>',
                                    text: resp.errors,
                                    footer: '<b> Something Wrong</b>'
                                });
                            }
                        },
                        error: function (e) {

                            alert("some thing want wrong");
                        }
                    });
                }
            } else {
                Swal.fire({
                    type: 'info',
                    title: 'great',
                    text: 'This is safe',
                });
            }
        }
		
		
		
//many of application need to status active deactive .below is status deactivate method. It is call from any blade  file and pass just 2 parameter.

The 2 parameter is 
//1.id
//2.action 
		   // status deactivate function
        async function deactive(id, action) {

            const {value: confirm} = await Swal.fire({
                title: 'Are you sure Deactivate this ?',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!"
            })
            // if confirm
            if (confirm) {
                if (id > 0) {
                    $.ajax({
                        url: action,
                        type: "GET",
                        dataType: 'json',
                        cache: false,
                        success: function (resp) {
							
						//after success funtion if you can do any thing just what i you want.

                            console.log(resp);
                            if (resp.success == "OK") {
                                Swal.fire({
                                    text: resp.message,
                                    type: 'success',
                                });

                                //change <a> tag class
                                $('.table').find('#class_' + id).removeClass('btn-warning');
                                $('.table').find('#class_' + id).addClass('btn-primary');


                                //change icon
                                $('.table').find('#icon_' + id).addClass('fa-ban');
                                $('.table').find('#icon' + id).addClass('fa-check-circle');



                                //change status badge class
                                $('.table').find('#status_' + id).removeClass('badge-complete').text("Deactive");
                                $('.table').find('#status_' + id).addClass('badge-pending');

                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: '<P style="color: red;">Oops...<p>',
                                    text: resp.errors,
                                    footer: '<b> Something Wrong</b>'
                                });
                            }
                        },
                        error: function (e) {

                            alert("some thing want wrong");
                        }
                    });
                }
            } else {
                Swal.fire({
                    type: 'info',
                    title: 'great',
                    text: 'This is safe',
                });
            }
        }
		
		
		
		
        // status active function
        async function active(id, action) {

            const {value: confirm} = await Swal.fire({
                title: 'Are you sure active this ?',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!"
            })
            // if confirm
            if (confirm) {
                if (id > 0) {
                    $.ajax({
                        url: action,
                        type: "GET",
                        dataType: 'json',
                        cache: false,
                        success: function (resp) {
							
						//after success funtion if you can do any thing just what i you want.

                            console.log(resp);
                            if (resp.success == "OK") {
                                Swal.fire({
                                    text: resp.message,
                                    type: 'success',
                                });

                                //change <a> tag class
                                $('.table').find('#class_' + id).removeClass('btn-primary');
                                $('.table').find('#class_' + id).addClass('btn-warning');


                                //change icon
                                $('.table').find('#icon_' + id).addClass('fa-check-circle');
                                $('.table').find('#icon_' + id).addClass('fa-ban');



                                //change status badge class
                                $('.table').find('#status_' + id).removeClass('badge-pending').text("Active");
                                $('.table').find('#status_' + id).addClass('badge-complete');

                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: '<P style="color: red;">Oops...<p>',
                                    text: resp.errors,
                                    footer: '<b> Something Wrong</b>'
                                });
                            }
                        },
                        error: function (e) {

                            alert("some thing want wrong");
                        }
                    });
                }
            } else {
                Swal.fire({
                    type: 'info',
                    title: 'great',
                    text: 'This is safe',
                });
            }
        }
		
		
		
		//ajax from submit post method
		 $('#form').on('submit', function (event) {
            event.preventDefault();
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let formData = new FormData($(this)[0]);
            $.ajax({
                headers: {'X-CSRF-TOKEN': CSRF_TOKEN},
                url: $(this).attr('action'),
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-block').text('changing....');
                },
                success: function (resp) {
                    $('.btn-block').text('save change');
                    if (resp.success == "OK") {
                        Swal.fire({
                            type: 'success',
                            text: resp.message,
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: '<P style="color: red;">Oops...<p>',
                            text: resp.errors,
                            footer: '<b> Something Wrong</b>'
                        });
                    }
                },
                //error function
                error: function (e) {
                    $('.btn-block').text('save change');

                    alert("some thing want wrong");
                }
            });
        });
		
		
		
		
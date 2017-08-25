$(function () {
  $('body').delegate('#terms-form', 'submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var temsOfservice = $(this).find('div.panel-body').html();
    var formaction =  $(this).attr("action");
    var token = $(this).find("input[name=_token]").val();

    $.ajax({
      type: "POST",
      url: formaction,
      data: {'_token': token, 'terms':temsOfservice},
      cache: false,
      success: function(data){
        form.find('.alert').css('display','block');
      }
    });
  });
  $('body').delegate('#privacy-form', 'submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var privacypolicy = $(this).find('div.panel-body').html();
    var formaction =  $(this).attr("action");
    var token = $(this).find("input[name=_token]").val();

    $.ajax({
      type: "POST",
      url: formaction,
      data: {'_token': token, 'privacy':privacypolicy},
      cache: false,
      success: function(data){
        form.find('.alert').css('display','block');
      }
    });
  });
  $('body').delegate('#about-us-form', 'submit', function (e) {
    e.preventDefault();
    var form = $(this);
    var aboutus = $(this).find('div.panel-body').html();
    var formaction =  $(this).attr("action");
    var token = $(this).find("input[name=_token]").val();

    $.ajax({
      type: "POST",
      url: formaction,
      data: {'_token': token, 'aboutus':aboutus},
      cache: false,
      success: function(data){
        form.find('.alert').css('display','block');
      }
    });
  });

  $('.site-about-us-form-div-close-btn').on('click', function(){
    console.log('ddd');
    $('.login-register-formoverlay').css({visibility:'hidden',opacity:'0'})
  })
});

function delete_user(id){
  console.log(id);
  swal({
    title: "Are you sure?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete user!",
    cancelButtonText: "No, cancel plx!",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function (isConfirm) {
      if (isConfirm) {
        axios.post("/delete-user", {user_id:id})
        .then(function (response) {
            $("#userlist_"+ id).remove();
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        })
        .catch(function (error) {
          console.log(error);
        });
      } else {
          swal("Cancelled", "Your imaginary file is safe :)", "error");
      }
  });
};

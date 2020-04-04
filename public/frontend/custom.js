$('document').ready(function(){

  var username = $('#username').val();

  var url = location.origin + "/register/";
    
  $('#username').on('blur', function(){

//       $.get(url,function(data){
// alert(data);
//           if (data == 'ex') {

//             //$('#msg').html('<span class="text-success">the username alredy exsits </span>');
//           }else {
//             $('#msg').html('<span class="text-success">ok </span>');
//           }
//       });


    $.ajax({
      url: url,
      type: 'post',
      data: {
        'username' : username,
      },
      success: function(response){
        alert(response);
      }

    });
    });

});
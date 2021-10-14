// $(document).on('submit','.database_operation',function(){
//     var url=$(this).attr('action');
//     var data1=$(this).serialize();
//     $.post(url,data1,function(fb){
//         var resp=$.parseJSON(fb);
//         if(resp.status=='true')
//         {
//             alert(resp.message);
//             setTimeout(function(){
//                 window.location.href=resp.reload;
//             },1000);
//         }
//     });
//     return false;
// });
// $(document).on('click','.question_status',function(){
//     var subject_name=$(this).attr('data-id');
//     alert(subject_name);
//     $.get(BASE_URL='/admin/subject_status/'+subject_name,function(fb){
        
//     })
//  });




$(document).on('click','.subject_status',function(){
	var id=$(this).attr('data-id');
	$.get(BASE_URL+'/admin/subject_status/'+id,function(fb){
        location.reload(true);
		alert('Subject Status Successfully Changed');
	})
});


$(document).on('click','.exam_status',function(){
	var id=$(this).attr('data-id');
	
	$.get(BASE_URL+'/admin/exam_status/'+id,function(fb){
        location.reload(true);
		alert(fb);
	})
});

$(document).on('click','.question_status',function(){
	var id=$(this).attr('data-id');
    
	var type=$(this).attr('data-type');
    var total1=$(this).attr('total_m');
    var total_e=$(this).attr('total_e');
    var flag=$(this).attr('flag');
    var m1=$(this).attr('m1');
    var k=parseFloat(total1)+parseFloat(m1);
    if(flag=="0"){
        if(k <= parseFloat(total_e)){
            $.get(BASE_URL+'/admin/question_status/'+id+'/'+type,function(fb){
                location.reload(true);
                alert('Question Status Successfully Changed ');
            })
        }
        else{
            location.reload(true);
            alert('Status Update failed current Total Marks exceeds the Total Exam Marks ');
            
        }
    }
    else {
        $.get(BASE_URL+'/admin/question_status/'+id+'/'+type,function(fb){
            location.reload(true);
            alert('Question Status Successfully Changed ');
        })
    }
	
});






 $(document).ready(function(){  
   
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="lhs[]" placeholder="Enter here" class="form-control name_list" /></td><td><input type="text" name="rhs[]" placeholder="Enter Correct Answer" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
     
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
    //   $('#submit').click(function(){            
    //        $.ajax({  
    //             url:"name.php",  
    //             method:"POST",  
    //             data:$('#add_name').serialize(),  
    //             success:function(data)  
    //             {  
    //                  alert(data);  
    //                  $('#add_name')[0].reset();  
    //             }  
    //        });  
    //   });  
});



//onclick for exam
$(document).on('click','.exam_join',function(){
	
        localStorage.removeItem('saved_time');
    
	
    // alert('hello '+id);
    // $("M"+id).remove(); 
    // document.getElementById("M"+id).disabled = true;
	
});





//timer code
var time = $('.js-timeout').html();
var saved_time = localStorage.getItem('saved_time');
if(saved_time == null) {
    var new_time = new Date().getTime() + time*60000;
    time = new_time;
    console.log(time);
    localStorage.setItem('saved_time', new_time);
} else {
    time = saved_time;
    console.log(time);
}
var x = setInterval(() => {
    var now = new Date().getTime();
    var distance = time - now;
   // console.log(distance);
    var minutes = Math.floor(distance/60000);
    var seconds = Math.floor((distance % (1000*60)) / 1000);
    if(seconds<10)
        document.getElementById("countdown").innerHTML = minutes + ":0" + seconds;
    else
        document.getElementById("countdown").innerHTML = minutes + ":" + seconds;

    if(minutes <= 0 && seconds <=0) {
        clearInterval(x);
        localStorage.removeItem('saved_time');
        document.getElementById("countdown").innerHTML = "Time Up";
        document.form1.submit();
    }
},1000);


var prefEntries=performance.getEntriesByType("navigation");
if(prefEntries[0].type==="back_forward"){

    location.reload(true);
}



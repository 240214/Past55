$(document).ready(function(){

    $('input[property]').click(function() {
        var value = $(this).attr('property');
        var url = $(this).attr('data-ref');
        var del_url = $(this).attr('data-del');


        $.get(url, function (data){
           var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
           M.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');
        }).done(function (data) {
            if(data == "liked")
            {
               var confrm = confirm("Already saved! Do you want to delete from save list?");
               if(confrm == true)
               {
                   $.get(del_url, function (data)
                   {
                       $('.zmdi-favorite-outline').show();
                       $('.zmdi-favorite').hide();
                       return false;
                   }).fail(function () {
                       alert("fail! Some problem with remove property from save list. please try letter");


                       //

                   }).error(function (data) {
                       console.log(data);

                   });
               }
               else
               {
                   $('.zmdi-favorite-outline').hide();
                   $('.zmdi-favorite').show();
                   return false;
               }
            }
          var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
          M.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');

        }).fail(function () {
            alert("Please Login or Signup");
            $('.zmdi-favorite-outline').show();
            $('.zmdi-favorite').hide();

            //

        }).error(function (data) {
            console.log(data);

        });

    });
    $('input[agents]').click(function() {
            var value = $(this).attr('agents');
            var url = $(this).attr('data-ref');
            var del_url = $(this).attr('data-del');


            $.get(url, function (data)
            {
                //var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
                // M.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');
            }).done(function (data) {
                if(data == "liked")
                {
                    var confrm = confirm("Already saved! Do you want to delete from save list?");
                    if(confrm == true)
                    {
                        $.get(del_url, function (data)
                        {
                            $('.zmdi-favorite-outline').show();
                            $('.zmdi-favorite').hide();
                            return false;
                        }).fail(function () {
                            alert("fail! Some problem with remove agents from save list. please try letter");


                            //

                        }).error(function (data) {
                            console.log(data);

                        });
                    }
                    else
                    {
                        $('.zmdi-favorite-outline').hide();
                        $('.zmdi-favorite').show();
                        return false;
                    }
                }
                // var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
                //  M.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');

            }).fail(function () {
                alert("Please Login or Signup");
                $('.zmdi-favorite-outline').show();
                $('.zmdi-favorite').hide();

                //

            }).error(function (data) {
                console.log(data);

            });

        });
    $('#reviewbtn').click(function(){

        $('#reviewblc').removeClass('hidden');
        $('#reviewList').addClass('hidden');

        $('#reviewSubmit').removeClass('hidden');
        $('#reviewbtn').addClass('hidden');

    });
    $('.remSaveProp').click(function(){

        var del_url = $(this).attr('data-del');
        var id = $(this).attr('data-val');



        $.get(del_url, function (data)
        {
            //var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
            // M.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');
        }).done(function (data) {

            $('#savedList'+id).hide();
        }).fail(function () {
            alert("Fail. Sorry please try after some time");


        }).error(function (data) {
            console.log(data);

        });

    });
    $('.remSaveAge').click(function(){

        var del_url = $(this).attr('data-del');
        var id = $(this).attr('data-val');



        $.get(del_url, function (data)
        {
            //var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
            // M.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');
        }).done(function (data) {

            $('#savedListAgent'+id).hide();
        }).fail(function () {
            alert("Fail. Sorry please try after some time");


        }).error(function (data) {
            console.log(data);

        });

    });
    $('.leads').click(function() {
    var leads = $(this).attr('leads');
     var data_url = $(this).attr('data-ref');

     $.get(data_url, function (data)
     {
         //var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
         // M.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');
     }).done(function (data) {

         alert("done")
     }).fail(function () {
         alert("Fail. Sorry please try after some time");


     }).error(function (data) {
         console.log(data);

     });
    });
    //leads_del
    $('.leads_del').click(function() {
        var leads = "#leads"+$(this).attr('data-val');
        var data_url = $(this).attr('data-del');

        $.get(data_url, function (data)
        {
            //var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
            // M.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');
        }).done(function (data) {
           var old = $('.leads-total').text();
            $('.leads-total').text(old-1);
            $(leads).animate({left:800,display:"none"},500,function () {
                $(leads).hide();
            });
        }).fail(function () {
            alert("Fail. Sorry please try after some time");

        }).error(function (data) {
            console.log(data);

        });
    });
    //task done
    $('.taskDone').click(function() {
        var taskId = $(this).attr('task');
        var data_url = $(this).attr('data-ref')+"/"+taskId;
       // alert(data_url);

        $.get(data_url, function (data)
        {
            //var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
            // Materialize.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');
        }).done(function (data) {
            // var old = $('.leads-total').text();
            // $('.taskId-total').text(old-1);
            // $(taskId).animate({left:800,display:"none"},500,function () {
            //     $(leads).hide();
            // });
        }).fail(function () {
            alert("Fail. Sorry please try after some time");

        }).error(function (data) {
            console.log(data);

        });
    });
    //task delete
    $('.taskDelete').click(function() {
        var confrm = confirm('Are You Sure Delete this Task???');
        if(confrm == true)
        {
            var taskId = $(this).attr('task');
            var data_url = $(this).attr('data-ref')+"/"+taskId;

            $.get(data_url, function (data)
            {
                //var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
                // Materialize.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');
            }).done(function (data) {
                var old = $('.task-total').text();
                $('.task-total').text(old-1);
                $(".task"+taskId).animate({left:800,display:"none"},500,function () {
                    $(".task"+taskId).hide();
                });
            }).fail(function () {
                alert("Fail. Sorry please try after some time");

            }).error(function (data) {
                console.log(data);

            });
        }

    });

    $('.contactDel').click(function() {
        var div_id = $(this).attr('data-val');
        var URL_f = $(this).attr('data-ref');

//contact
        var data_url =URL_f;

        $.get(data_url, function (data)
        {
            //var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
            // Materialize.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');
        }).done(function (data) {
            var old = $('#totalContacts').text();
            $('#totalContacts').text(old-1);
            $(".contact"+div_id).animate({left:600,display:"none"},500,function () {
                $(".contact"+div_id).hide();
            });
        }).fail(function () {
            alert("Fail. Sorry please try after some time");

        }).error(function (data) {
            console.log(data);

        });

       });

    $('.noteDel').click(function(){

        var cnfrm = confirm("Are you sure for delete this note?");
        if(cnfrm === true)
        {
            var id = $(this).attr('data-val');

            var del_url = $(this).attr('data-ref')+"/"+id;;


            $.get(del_url, function (data)
            {
                //var $toastContent = $('<span><i class="fa fa-check-circle-o"></i> &nbsp;' + data + '</span>');
                // Materialize.toast($toastContent, 3000, 'toost-unfriend yellow darken-3 white-text');
            }).done(function (data) {

                $("#noteblock"+id).animate({left:600,display:"none"},500,function () {
                    $("#noteblock"+id).hide();
                });
            }).fail(function () {
                alert("Fail. Sorry please try after some time");


            }).error(function (data) {
                console.log(data);

            });
        }

    });

    $('.property_wrap').click(function(){
        var value = $(this);
        $('.property_wrap').removeClass("property_wrap_active");
        value.addClass("property_wrap_active");
        $('#property-category_id').val(value.attr('data_value'));

        //alert(value.attr('data_value'));
        //$('#total').text('Product price: $1000');
    });

     $('.property_features').click(function(){
            var value = $(this);
            if(value.attr('class') == "col-lg-4 property_features")
            {
                // $('.property_features').removeClass("property_features_active");
                value.addClass("property_features_active");
                var inId = "#int"+value.attr('data_id');
                $(inId).val(value.attr('data_value'));
            }
            else
            {
                $(this).removeClass("property_features_active");
                // value.removeClass("property_features_active");
                var inId = "#int"+value.attr('data_id');
                $(inId).val("");
            }


            //alert(inId);
            //$('#total').text('Product price: $1000');
        });

     /*$('.zmdi').click(function(){
            var type = $(this).attr('data-tag');
            if(type == "listview")
            {
                $('.zmdi').removeClass('active');
                $(this).addClass('active');
                $('#content_wrap').removeClass('listings-grid');
                $('#content_block').removeClass('col-sm-12');
                $('#content_block').addClass('col-sm-8');
                $('#content_block').addClass('listings-list');
                $('.content_list').removeClass('col-sm-6');
                $('.content_list').removeClass('col-md-3');
                $('.listings-grid__main').addClass('pull-left ');
                $('').show();
                $('#show_in_list').removeClass('hidden');

            }
            else
            {
                $('.zmdi').removeClass('active');
                $(this).addClass('active');

                $('#content_wrap').addClass('listings-grid');
                $('#content_block').addClass('col-sm-12');
                $('#content_block').removeClass('col-sm-8');
                $('#content_block').removeClass('listings-list');
                $('.content_list').addClass('col-sm-6');
                $('.content_list').addClass('col-md-3');
                $('.listings-grid__main').removeClass('pull-left ');
                $('#show_in_list').addClass('hidden');
            }

//        $('.property_wrap').removeClass("property_wrap_active");
//        value.addClass("property_wrap_active");
//        $('#ad-category').val(value.attr('data_value'));

            //alert(value.attr('data_value'));
            //$('#total').text('Product price: $1000');
        });*/

     $('.citySet').click(function(){
       //  var city = $(this).attr('data-city');
         alert('hello');

        });

});

function demo_button(){
    alert('Edit/Delete action not allow in demo version.');
}

function citySearch(){
    var city = $('#citySearchInput').val();
    var URL_f = $('#citySearchInput').attr('data-ref');

    var data_url = URL_f+'/'+city;
    $("#cityWaiting").removeClass('hidden');
    $("#cityWaiting").addClass('show');
    $.get(data_url, function (data)
    {
        // alert('done');
        // $("#cityWaitingResult").html(data);
        //
        // $("#cityWaiting").removeClass('hidden');
        // $("#cityWaiting").addClass('show');

    }).done(function (data) {
        $("#cityWaiting").html(data);

    }).fail(function (data) {
        $("#cityWaiting").text('Fail: to load');

    }).error(function (data) {
        console.log(data);
        $("#cityWaiting").text('Error: '+data);

    });
}

function addToGroup(id) {
    //alert("hello");
    var GroupId = $('#addMemberToGroup'+id).val();
    var UserId = $('#gData'+id).attr('data-uId');
    var URL_f = $('#gData'+id).attr('data-ref');

    var data_url = URL_f+"/"+GroupId+"/"+UserId;
  //  alert(data_url);

    $.get(data_url, function (data)
    {
        $('#AddMemberSuccessText').text(data);
        $("#addToGroup1").modal('hide');
        $("#AddMemberSuccess").modal('show');
    }).done(function (data) {

        $('#AddMemberSuccessText').text(data);
        $("#addToGroup1").modal('hide');
        $("#AddMemberSuccess").modal('show');
    }).fail(function (data) {
        alert('fail');
        $('#AddMemberSuccessText').text(data);
        $("#addToGroup1").modal('hide');
        $("#AddMemberSuccess").modal('show');

    }).error(function (data) {
        console.log(data);

    });


}
function selstar(val,sel){
    for(var x=1;x<=val;x++)
    {
        $('#'+sel+x).removeClass('mdc-text-grey-300');
        $('#'+sel+x).addClass('mdc-text-yellow-800');

    }

}

function remstar(val,sel){
    for(var x=1;x<=val;x++)
    {
        var rated = $('#'+sel+x).attr('rated');
        if(rated != "1")
        {
            $('#'+sel+x).addClass('mdc-text-grey-300');
            $('#'+sel+x).removeClass('mdc-text-yellow-800');
        }

    }
}
function setrate(val,sel){
    for(var x=1;x<=val;x++)
    {
        $('#'+sel+x).removeClass('mdc-text-grey-300');
        $('#'+sel+x).addClass('mdc-text-yellow-800');
        $('#'+sel+x).attr('rated','1');
    }
    var corect = 1 + val;
    for(var x=corect;x<=5;x++)
    {
        $('#'+sel+x).addClass('mdc-text-grey-300');
        $('#'+sel+x).removeClass('mdc-text-yellow-800');
        $('#'+sel+x).attr('rated','0');
    }
    $('#'+sel).val(val);
}
function demoss(jsonData){

    for(var key in jsonData)
    {
        var jsd = jsonData[key];
        alert(jsd.date);

    }


}
function setCity(city) {
    var city = city;
    var URL_f = $('#citySearchInput').attr('data-ref-set');

    var data_url = URL_f+'/'+city;

    $("#"+city ).removeClass('zmdi-pin');
    $("#"+city ).addClass('zmdi-spinner zmdi-hc-spin');
    $.get(data_url, function (data)
    {
        // alert('done');
        // $("#cityWaitingResult").html(data);
        //
        // $("#cityWaiting").removeClass('hidden');
        // $("#cityWaiting").addClass('show');

    }).done(function (data) {
        $('.zmdi-check').removeClass('zmdi-check');
        $("#"+city ).removeClass('zmdi-spinner zmdi-hc-spin');
        $("#"+city ).addClass('zmdi-check');


        $("#dCity").text(city);
        $('.dropdown').removeClass('open');

    }).fail(function (data) {
        $('.dropdown').removeClass('open');
        $("#cityForm").text('Fail: to set');

    }).error(function (data) {
        console.log(data);
        $(".cityForm").text('Error: '+data);

    });

}

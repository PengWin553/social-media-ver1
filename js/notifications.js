$(document).ready(function(){

    // load new notifications

    // if the bell icon is clicked
    $(document).on('click', '.dropdown-toggle', function(){

        console.log('The notification icon is clicked.')

        // set the count to empty
        $('.count').html('');
        // pass the 'yes' value to the load_unseen_notification() function
        load_unseen_notification('yes');

    });

    // updating the view with notifications using ajax

    // store the 'yes' value in the view parameter
    // function load_unseen_notification(view = '')
    // {
    //     // make a post request to fetch.php by sending the 'yes' value
    //     $.ajax({
    //         url:"fetch.php",
    //         method:"POST",
    //         data:{view:view},
    //         dataType:"json",
    //         success:function(data)
    //         {
    //             $('.dropdown-menu').html(data.notification);
    //             if(data.unseen_notification > 0)
    //             {
    //                 $('.count').html(data.unseen_notification);
    //             }
    //         }
    //     });
    // }

    // load_unseen_notification();

    // // submit form and get new records =======================
  
    // setInterval(function(){
    //     load_unseen_notification();;
    // }, 5000);

});
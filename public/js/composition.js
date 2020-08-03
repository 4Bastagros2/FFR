$(function(){

var id_match = $('.global').data('idMatch');

var positions = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

$('.draggable').draggable({
    helper: "clone",
    containment: "document",
    zIndex: 100,
    revertDuration: 500,
    start: function(event, ui){
      // $(ui.helper).addClass("ui-helper");
    //   $(ui.helper).width($(".droppable").width());
    }
  });
  
  $('.droppable').droppable({
  
    activeClass: "ui-over",
    hoverClass: "droppable-over",
    accept: '.draggable',
    drop: function(event, ui) {
  
      id = $(ui.draggable).data('id');
      // idcard = $(this).attr('id');
      previous = ui.draggable.parent();

      // console.log($('.player_card', previous).attr('id')+$('.player_card', previous).html());
      
      
      // $(".global").data('idcard', idcard);
      
      // console.log(this);
      // console.log(previous);
      
      
      if(!$(this).is($(previous)))
      {
        // $(ui.draggable).one('shown.bs.popover', function(e) 
        // {
          //   $(".jail").css('visibility', 'visible');
          console.log('----------------------------');
          console.log(positions);
          
          console.log('---------------------------- id player');
          id_player = $(ui.draggable).data('idPlayer');
          console.log(id_player);
          id_position = $(this).data('idPosition');
          prev_position = ui.draggable.parent().data('idPosition');
          prev_player = positions[id_position];
          // console.log('id_player:'+id_player+' id_position')
          console.log('[data-id-player="'+prev_player+'"]');
          if(prev_player>0){
            positions[prev_position] = prev_player;
            $(previous).append($('[data-id-player="'+prev_player+'"]'));            
          } else {
            positions[prev_position] = 0;
          }
          $(this).append(ui.draggable.css({
            position: 'relative'
            // background: 'green'
          }));
          positions[id_position] = id_player;
          
          console.log(positions);
          console.log('----------------------------');
          //   $('#btn-cancel').one('click', function(e){
        //     // alert('cancel');
        //     $(previous)
        //     .append(ui.draggable.css({
        //       position: 'relative',
        //       background: 'green'
        //     }));          
        //     // $('[data-toggle="popover"]').popover('hide');
        //     $(".jail").css('visibility', 'hidden');
        //   });
          
        //   $('#btn-confirm').one('click', function() {
        //     // alert('confirm');
        $.ajax({
          method: "POST",
          url: `/match/composition/update/${id_match}`,
          data: { composition: positions }
        })
          .done(function( msg ) {
            alert( "composition sauvée : " + msg );
          });


            // $post(`/match/composition/update/${id_match}`, {
            //   method: 'POST',
            // }).then(function() 
            // {     
                // bootbox.alert({
                //   message: "Mise à jour de la position ok!",
                //   className: 'rubberBand animated',
                //   size: 'small'
                // });
                // $('[data-toggle="popover"]').popover('hide');
                // $(".jail").css('visibility', 'hidden');
              // });
            // });
    
        // });
  
        // $(ui.draggable).popover('show');
  
      }
        
        
    }
  });
  
  function init() {  
}
window.onload = function() {
    init();
};
// Tooltips Initialization

    
    // alert("blah");
    // main.classList.add("loading");
    // setTimeout(function() { main.classList.remove("loading"); }, 1800); 
      //$('[data-toggle="popover"]').popover()
    // $('[data-toggle="popover"]').popover();
  
    // $('[data-toggle="popover"]').on('shown.bs.popover', function () {
  
    //   $(".jail").css('visibility', 'visible');
    //   $('#btn-cancel').click(function () {
    //     $('[data-toggle="popover"]').popover('hide');
    //     $(".jail").css('visibility', 'hidden');
    //   });
    //   $('#btn-confirm').click(function (event) {
    //     alert('bla');
    //     // var id = event.data['id'];
    //     // var idcard = event.data['idcard'];
    //     var id = $(".global").data('id');
    //     var idcard = $(".global").data('idcard');
  
    //     fetch(`/position/${id}/${idcard}`, {
    //       method: 'POST',
    //     }).then(function () 
    //       {
    //       bootbox.alert({
    //         message: "Mise à jour de la position ok!",
    //         className: 'rubberBand animated',
    //         size: 'small'
    //       });
    //       $('[data-toggle="popover"]').popover('hide');
    //       $(".jail").css('visibility', 'hidden');
    //       });
    //     });
  
    // });

  
  
  
  
    
  
  
  
    //   if (bootbox.confirm("Êtes-vous sûr?", function (result) {
    //      if (result == false ){return}
    //       fetch(`/position/${id}/${idcard}`, {
    //         method: 'POST',
    //       }).then(function () {
    //         bootbox.alert({
    //           message: "Mise à jour de la position ok!",
    //           className: 'rubberBand animated',
    //           size: 'small'
    //         });
    //       })
  
    //     })) {
  
    //   }
    // }


  });
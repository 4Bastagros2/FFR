$('.draggable').draggable({
    helper: "clone",
    containment: "document",
    zIndex: 100,
    start: function(event, ui){
      // $(ui.helper).addClass("ui-helper");
      $(ui.helper).width($(".droppable").width());
    }
  });
  
  $('.droppable').droppable({
  
    activeClass: "ui-over",
    hoverClass: "droppable-over",
    accept: '.draggable',
    drop: function(event, ui) {
  
      id = $(".global").data('id');
      idcard = $(this).attr('id');
      previous = ui.draggable.parent();
  
      $(this)
      .append(ui.draggable.css({
        position: 'relative',
        background: 'green'
      }));
  
      $(".global").data('idcard', idcard);
  
      console.log(this);
      console.log(previous);
  
  
      if(!$(this).is($(previous)))
      {
        $(ui.draggable).one('shown.bs.popover', function(e) 
        {
          $(".jail").css('visibility', 'visible');
    
    
          $('#btn-cancel').one('click', function(e){
            // alert('cancel');
            $(previous)
            .append(ui.draggable.css({
              position: 'relative',
              background: 'green'
            }));          
            $('[data-toggle="popover"]').popover('hide');
            $(".jail").css('visibility', 'hidden');
          });
          
          $('#btn-confirm').one('click', function() {
            // alert('confirm');
            fetch(`/position/${id}/${idcard}`, {
              method: 'POST',
            }).then(function() 
            {     
                // bootbox.alert({
                //   message: "Mise à jour de la position ok!",
                //   className: 'rubberBand animated',
                //   size: 'small'
                // });
                $('[data-toggle="popover"]').popover('hide');
                $(".jail").css('visibility', 'hidden');
              });
            });
    
        });
  
        $(ui.draggable).popover('show');
  
      }
        
        
    }
  });
  
  function init() {  
    
    main.classList.add("loading");
    setTimeout(function() { main.classList.remove("loading"); }, 1800); 
  }
  window.onload = function() {
      init();
  };
  // Tooltips Initialization
  $(function () {
  
      //$('[data-toggle="popover"]').popover()
    $('[data-toggle="popover"]').popover();
  
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
  });
  
  
  
  
    
  
  
  
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
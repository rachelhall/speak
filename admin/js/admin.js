jQuery(document).ready(function($){

  /* Input Masks */
  // Company Info ZIP Code
  $('#company-address-zip').inputmask('99999');


  /* Image Field Logic */
  // Setup reset vars for image form field and editor state
  var gmf, og_editor = window.send_to_editor;

  // Get image ID and store it in the attach image field
  function attachMedia(x){
    // Open thickbox
    tb_show('','media-upload.php?TB_iframe=true');

    // Get data from the selected image
    window.send_to_editor = function(html){
      // Get the image string, get class that contains the image ID, get the ID
      var a = $('img',html),
        b = a['context'].substring(a['context'].indexOf('wp-image-')+9,a['context'].lastIndexOf('"')),
        c = a['context'].substring(a['context'].indexOf('src="')+5,a['context'].indexOf('" alt="'));

      // Add the ID to the image field and add the UI elements
      $(x).val(b);
      $(x).siblings('.remove-image').remove();
      $(x).after('<div class="remove-image" style="background-image:url(\''+c+'\');" title="remove image"><i class="material-icons">close</i></div>');

      // Close the thickbox and reset the editor state
      tb_remove();
      window.send_to_editor = og_editor;
    };

    return false;
  }

  // Set the field the ID will be stored, open the thickbox
  $('.speak-meta-box').on('click','.attach-image',function(){
    gmf = $(this).siblings('input');
    attachMedia(gmf);
  });

  // Clear the image field and reset the UI
  $('.speak-meta-box').on('click','.remove-image',function(){
    $(this).siblings('input').val('');
    $(this).remove();
  });


  /* Repeater Logic */
  // Add a clean row to a repeater
  $('.speak-meta-repeater').on('click','.add-repeater-row',function(){
    // Clone the repeater's placeholder row, get the index for the row, relabel the markup with the index
    var row = $(this).next('.repeater-clone').html(),
      index = ($(this).prev('fieldset').find('.repeater-row').length > 0)
        ? parseFloat($(this).prev('fieldset').find('.repeater-row').last().attr('data-index')) + 1
        : 0;
      row = row.split('replace_index').join(index);

    // Append the final clean row
    $(this).prev('fieldset').children('.repeater-rows').append('<li class="repeater-row sort-item" data-index="'+index+'">'+row+'</li>');
  });

  // Remove repeater row on confirm
  $('.speak-meta-repeater').on('click','.remove-row-btn',function(){
    if(confirm('Are you sure you wish to permanently delete this row?')){
      $(this).parents('.repeater-row').remove();
    }
  });

  // Make repeater rows sortable
  $('.speak-sortable').sortable({
    items: '> .sort-item',
    cursor: 'grabbing',
    handle: '.sort-handle'
  });


  /* Meta Box Conditional Logic */
  // Setup array of all elements to watch for changes
  var changers = [];
  $('.speak-conditions').each(function(){
    var conditions = $.parseJSON($(this).text());

    for(var x = 0; x < conditions.length; x++){
      if($.inArray(conditions[x]['selector'],changers) == -1){
        changers.push(conditions[x]['selector']);
      }
    }
  });

  // Validate values of fields, return false if any field doesn't match the required value
  function checkConditions(conditions){
    var show = true;

    for(var x = 0; x < conditions.length; x++){
      var selector = conditions[x]['selector'],
        value = conditions[x]['value'],
        relation = conditions[x]['relation'];

      if($(selector).length > 0){
        if(relation == 'is'){
          if(!$(selector).is(value)){
            show = false;
          }
        } else if(relation == 'isnot'){
          if($(selector).is(value)){
            show = false;
          }
        } else if(relation == '>'){
          if($(selector).val() <= value){
            show = false;
          }
        } else if(relation == '>='){
          if($(selector).val() < value){
            show = false;
          }
        } else if(relation == '<'){
          if($(selector).val() >= value){
            show = false;
          }
        } else if(relation == '<='){
          if($(selector).val() > value){
            show = false;
          }
        } else if(relation == '!' || relation == '!=' || relation == '!=='){
          if($(selector).val() == value){
            show = false;
          }
        } else if(relation == '=' || relation == '==' || relation == '==='){
          if($(selector).val() !== value){
            show = false;
          }
        }
      }
    }

    return show;
  }

  // On initial load fire a check for all condition fields and hide the respective meta boxes if needed
  $(window).load(function(){
    for(var x = 0; x < changers.length; x++){
      $('.speak-conditions:contains('+changers[x]+')').each(function(){
        var conditions = $.parseJSON($(this).text()),
          show = checkConditions(conditions);

        if(show === false){
          $(this).closest('.speak-toggleable').addClass('hddn');
        }
      });
    }
  });

  // Add listeners to condition field changes
  for(var x = 0; x < changers.length; x++){
    (function(el){
      $('body').on('change',el,function(){
        $('.speak-conditions:contains('+el+')').each(function(){
          var conditions = $.parseJSON($(this).text()),
            show = checkConditions(conditions);

          if(show === false){
            $(this).closest('.speak-toggleable').addClass('hddn');
          } else {
            $(this).closest('.speak-toggleable').removeClass('hddn');
          }
        });
      });
    })(changers[x]);
  }

});

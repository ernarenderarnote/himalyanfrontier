//jquery scripts for frontend 
$(document).ready(function(){
    //auto alert dismess
    $(".alert").delay(4000).slideUp(200, function() {
        $(this).modal('close');
    });
});
//display image preview while uploading
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#ImdID').attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
//display map preview while uploading
function mapURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#MapID').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
//feature image button trigger
$(".feature-img-btn").click(function (e) {
  $("input[name='feature_img']").trigger('click');
  e.preventDefault();
});

//map add script
$(".map-img-btn").click(function (e) {
    $("input[name='map']").trigger('click');
    e.preventDefault();
});

//gallery Images script
$(document).ready(function() {
  $(".ui-helper-hidden-accessible").remove();
  document.getElementById('pro-image').addEventListener('change', readImage, false);
  
  $( ".preview-images-zone" ).sortable();
  
  $(document).on('click', '.image-cancel', function() {
      let no = $(this).data('no');
      $(".preview-image.preview-show-"+no).remove();
  });
});



var num = 4;
function readImage() {
  if (window.File && window.FileList && window.FileReader) {
      var files = event.target.files; //FileList object
      var output = $(".preview-images-zone");

      for (let i = 0; i < files.length; i++) {
          var file = files[i];
          if (!file.type.match('image')) continue;
          
          var picReader = new FileReader();
          
          picReader.addEventListener('load', function (event) {
              var picFile = event.target;
              var html =  '<div class="preview-image preview-show-' + num + '">' +
                          '<div class="image-cancel" data-no="' + num + '">x</div>' +
                          '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                          '</div>';

              output.append(html);
              num = num + 1;
          });

          picReader.readAsDataURL(file);
      }
      //$("#pro-image").val('');
  } else {
      console.log('Browser not support');
  }
}

//datepicker
$('document').ready(function(){
  callDatepicker();
});
function callDatepicker(){
  $(".from-date").datepicker({
    //dateFormat: 'dd-mm-yy',
    onSelect: function (selected) {
      var dt ='';
      dt = new Date(selected);
      dt.setDate(dt.getDate());
      $('body').find(".to-date").datepicker({
     // 'dateFormat': 'dd-mm-yy',
      'minDate' : dt
      });
    }
  });
};
//funciton to add dynamic fiels
$(document).ready(function(){
  var num = $('[data-attr="from-date"]').length;
  $(document).on('click', '.addmore', function (ev) {
    num++;
    $(".datepicker").datepicker("destroy");
    var $clone = $(this).parents('.dynamic-schedule').clone(true);
    var $newbuttons = "<button type='button' class='mb-xs mr-xs btn btn-danger removemore'><i class='fa fa-remove'></i></button>";
    
    $clone.find('.datepicker').each(function(){
      var attrId = $(this).attr('id');
      $(this).val('');
      $(this).attr('id',attrId+num );
    });
    $clone.find("[data-attr='from-date']").each(function(){
       $(this).attr('name',"schedule["+num+"][from_date]")
    });
    $clone.find("[data-attr='to-date']").each(function(){
      $(this).attr('name',"schedule["+num+"][to_date]")
    });
    $clone.find('.input-group-btn').html($newbuttons);
    $('.dynamic-schedule:last').after($clone);
    callDatepicker();
  });

  $(document).on('click', '.removemore', function () {
    $(this).parents('.dynamic-schedule').remove();
  });
});
 


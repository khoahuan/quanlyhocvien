$(document).ready(function() {
    var base_url="/qltheodoi";
    $("#ma_khoa").change(function() {
        var ma_khoa = "";
        var ma_lop = "";
        $( "#ma_khoa  option:selected" ).each(function() {
          ma_khoa = $( this ).val();
        });
         $.post('theo_doi/change_class', {ma_khoa: ma_khoa}, function(data) {
            $('#ma_lop').html(data);
            $( "#ma_lop  option:selected" ).each(function() {
              ma_lop = $( this ).val();
            });
            $.post('theo_doi/change_quan_so', {ma_khoa: ma_khoa,ma_lop: ma_lop}, function(data) {
                console.log(data);
                $('#quan_so').val(data);
            });
        });
    });
    $("#ma_lop").change(function() {
        var ma_khoa = "";
        var ma_lop = "";
        $( "#ma_khoa  option:selected" ).each(function() {
          ma_khoa = $( this ).val();
        });
        $( "#ma_lop  option:selected" ).each(function() {
          ma_lop = $( this ).val();
        });
        $.post('theo_doi/change_quan_so', {ma_khoa: ma_khoa,ma_lop: ma_lop}, function(data) {
            console.log(data);
            $('#quan_so').val(data);
        });
    });
    //cap nhat lai  du page sinh vien
    $("#ma_khoa_student").change(function() {
      var ma_khoa = "";
      var ma_lop = "";
      $( "#ma_khoa_student  option:selected" ).each(function() {
        ma_khoa = $( this ).val();
      });
      $.post(base_url+'/student/change_class', {ma_khoa: ma_khoa}, function(data) {
        console.log(data);
        $('#ma_lop_student').html(data);
        $( "#ma_lop_student  option:selected" ).each(function() {
          ma_lop = $( this ).val();
          $.post(base_url+'/student/list_student', {ma_khoa: ma_khoa,ma_lop: ma_lop}, function(data) {
            console.log(data);
            $('#main_student').html(data);
            $('#class_name').html("DS LỚP "+ma_lop+'_'+ma_khoa);
          });
        });
        
      });

    });
    $("#ma_lop_student").change(function() {
      var ma_khoa = "";
      var ma_lop = "";
      $( "#ma_khoa_student  option:selected" ).each(function() {
        ma_khoa = $( this ).val();
      });
      $( "#ma_lop_student  option:selected" ).each(function() {
          ma_lop = $( this ).val();
        });
      $.post(base_url+'/student/list_student', {ma_khoa: ma_khoa,ma_lop :ma_lop}, function(data) {
        $('#main_student').html(data);
        $('#class_name').html("DS LỚP "+ma_lop+'_'+ma_khoa);
      });

    });
    $(".click-show-more").click(function() {
        ($(this).html() === "Ẩn ▲") ? ($(this).html("Hiện ▼"),$(".tbl_up").addClass("tbl_more")) :
               ($(this).html("Ẩn ▲"),$(".tbl_up").removeClass("tbl_more"));
    });

});

function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
    document.location = delUrl;
  }
}
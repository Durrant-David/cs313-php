function myAlert() {
  alert("Clicked!");
}

function changeColor() {
    var color = document.getElementById("color").value;
    document.getElementById("d1").style.color = color;
}

$(document).ready(function(){
  $("#btnColor").click(function(){
    var color = $("#txtColor").val();
    $("#color").css("color", color);
  });
  $("#btnHide").click(function(){
    $(".tHide").fadeToggle();
  });
});
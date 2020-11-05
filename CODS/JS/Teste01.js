/*
COD 01

const toggle = document.querySelector('.toggle-input');
const initialState = localStorage.getItem('toggleState') == 'true';
toggle.checked = initialState;

toggle.addEventListener('change', function() {
  localStorage.setItem('toggleState', toggle.checked);
});*/

$("#switch").click(function () {
  if ($("#fullpage").hasClass("night")) {
        $("#fullpage").removeClass("night");
        $("#switch").removeClass("switched");
  }
  else {
      $("#fullpage").addClass("night");
      $("#switch").addClass("switched");

  }
});


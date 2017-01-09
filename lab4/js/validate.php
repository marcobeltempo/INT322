
document.addEventListener("click", function check() {
var element = document.getElementById("MultipleOrder");
var no=document.getElementById("no_CheckBox");
var yes=document.getElementById("yes_CheckBox");

  element.style.visibility="hidden";
  if (yes.checked && no.checked) {
    yes.checked=false;
    no.checked=false;
  }
  if (yes.checked && no.checked==false) {
    element.style.visibility="visible";
  }
});

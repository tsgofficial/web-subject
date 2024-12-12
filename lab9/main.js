var leftArea = document.getElementById("left");
var leftCircle = leftArea.children[0];
var rightArea = document.getElementById("right");
var rightCircle = rightArea.children[0];
var vs = document.getElementById("vs");

function updateVsPosition() {
  var leftFlex = parseFloat(leftArea.style.flex) || 1;
  var rightFlex = parseFloat(rightArea.style.flex) || 1;
  var totalFlex = leftFlex + rightFlex;

  var vsPosition = (leftFlex / totalFlex) * 100;
  vs.style.left = vsPosition + "%";
}

leftArea.addEventListener("click", function () {
  var i = parseInt(leftCircle.innerText) + 1;
  var l = i + 1;
  leftCircle.innerText = i;
  leftArea.style.flex = l;
  updateVsPosition();
});

rightArea.addEventListener("click", function () {
  var i = parseInt(rightCircle.innerText) + 1;
  var l = i + 1;
  rightCircle.innerText = i;
  rightArea.style.flex = l;
  updateVsPosition();
});
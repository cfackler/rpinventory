<html><head>
<script type="text/javascript" src="modules/jquery/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  //do stuff when DOM is ready
  $("a.testclass").click(function(){
  alert("Hello world!");
  });
  
  $('.testDivClass').css("background-color", "#CCCCCC");

});
</script>
</head>

<body>
<div class="testDivClass" style="background-color:#000000">
<a href="poo.html" class="testclass">poop</a>
</div>
</body>
</html>

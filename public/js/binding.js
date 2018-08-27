
$(document).ready(function(){
    var bla1 = $('#myText1').val();
    var bla2 = $('#myText2').val();
    var bla3 = $('#Command').val();
    var bla = bla3+" "+bla1+" "+bla2;
    $('#Command').val(bla);
    $("#myText1").keyup(function(){
        var bla1 = $('#myText1').val();
        var bla2 = $('#myText2').val();
     
        var bla = bla3+" "+bla1+" "+bla2;
        $('#Command').val(bla);
    });
    
      $("#myText2").keyup(function(){
        var bla1 = $('#myText1').val();
        var bla2 = $('#myText2').val();
   
        var bla = bla3+" "+bla1+" "+bla2;
        $('#Command').val(bla);
    });
});

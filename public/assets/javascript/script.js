
	function previsualizar(sel) {
    if (sel.value=="1"){
      ocultar();
      $(".text-example").show();
    }else if (sel.value=="2") {
      ocultar();
      $(".select-example").show();
    }else if (sel.value=="3") {
      ocultar();
      $(".option-example").show();
    }else if (sel.value=="4") {
      ocultar();
      $(".check-example").show();
    }else{
      ocultar();
      $(".sino-example").show();
    }
  }

  function ocultar(){
    $(".text-example").hide();
    $(".select-example").hide();
    $(".option-example").hide();
    $(".check-example").hide();
    $(".sino-example").hide();
  }


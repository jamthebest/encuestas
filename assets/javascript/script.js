
	function previsualizar(sel) {
    if (sel.value=="1"){
      ocultar();
      $(".text-example").show();
    }else if (sel.value=="3") {
      ocultar();
      $(".select-example").show();
    }else if (sel.value=="4") {
      ocultar();
      $(".option-example").show();
    }else if (sel.value=="5") {
      ocultar();
      $(".check-example").show();
    }else if (sel.value=="2") {
      ocultar();
      $(".sino-example").show();
    }else if (sel.value=="6") {
      ocultar();
      $(".radio-otro-example").show();
    }else if (sel.value=="7") {
      ocultar();
      $(".check-otro-example").show();
    }
  }

  function ocultar(){
    $(".text-example").hide();
    $(".select-example").hide();
    $(".option-example").hide();
    $(".check-example").hide();
    $(".sino-example").hide();
    $(".radio-otro-example").hide();
    $(".check-otro-example").hide();
  }


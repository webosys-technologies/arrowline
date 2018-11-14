<script type="text/javascript">
	function chkEmpty(frm,field,msg){
		var inputVal=$("input[name='"+field+"']").val();//document.forms[frm][field].value;
                alert(inputVal);
		 if (inputVal == null || inputVal == "") {
			$("input[name='"+field+"']").parent().addClass("has-error has-feedback");
			$("input[name='"+field+"']").parent().find("span").addClass("fa fa-remove form-control-feedback");
			$("input[name='"+field+"']").parent().find("p").text(msg);
			return 1;
		}else{
			$("input[name='"+field+"']").parent().removeClass("has-error has-feedback");
			$("input[name='"+field+"']").parent().find("span").removeClass("fa fa-remove form-control-feedback");
			$("input[name='"+field+"']").addClass("abc");
			$("input[name='"+field+"']").parent().find("span").addClass("fa fa-check-square text-green form-control-feedback");
			$("input[name='"+field+"']").parent().find("p").text("");
			return 0;
		}
	}
        function chk(frm,field,msg){
		var inputVal=$("select[name='"+field+"']").val();//document.forms[frm][field].value;
//                alert(inputVal);
		 if (inputVal == null || inputVal == "") {
//			$("select[name='"+field+"']").parent().addClass("has-error has-feedback");
//			$("select[name='"+field+"']").parent().find("span").addClass("fa fa-remove form-control-feedback");
			$("select[name='"+field+"']").parent().find("p").text(msg);
			return 1;
		}else{
//			$("select[name='"+field+"']").parent().removeClass("has-error has-feedback");
//			$("select[name='"+field+"']").parent().find("span").removeClass("fa fa-remove form-control-feedback");
//			$("select[name='"+field+"']").addClass("abc");
//			$("select[name='"+field+"']").parent().find("span").addClass("fa fa-check-square text-green form-control-feedback");
			$("select[name='"+field+"']").parent().find("p").text("");
			return 0;
		}
	}

	function chkDrop(frm,field,msg){
        var inputVal=$('select[name=' + field + ']').val();
         if (inputVal == null || inputVal == "") {
            $("select[name='"+field+"']").parent().addClass("has-error has-feedback");
            $("select[name='"+field+"']").parent().find("p").text(msg);
            return 1;
        }else{
            $("select[name='"+field+"']").parent().removeClass("has-error has-feedback");
            $("select[name='"+field+"']").parent().find("p").text("");
            return 0;
        }
    }

    function chkGrandTotal(frm,field,msg){
		var inputVal=$("input[name='"+field+"']").val();//document.forms[frm][field].value;
		 if (inputVal == "0.00" || inputVal == "") {
			$("input[name='"+field+"']").parent().addClass("has-error has-feedback");
			$("input[name='"+field+"']").parent().find("span").addClass("fa fa-remove form-control-feedback");
			$("input[name='"+field+"']").parent().find("p").text(msg);
			return 1;
		}else{
			$("input[name='"+field+"']").parent().removeClass("has-error has-feedback");
			$("input[name='"+field+"']").parent().find("span").removeClass("fa fa-remove form-control-feedback");
			$("input[name='"+field+"']").addClass("abc");
			$("input[name='"+field+"']").parent().find("span").addClass("fa fa-check-square text-green form-control-feedback");
			$("input[name='"+field+"']").parent().find("p").text("");
			return 0;
		}
	}

	function chktxtArea(frm,field,msg){
		var inputVal=$("textarea[name='"+field+"']").val();//document.forms[frm][field].value;
		 if (inputVal == null || inputVal == "") {
			//$("textarea[name='"+field+"']").parent().addClass("has-error has-feedback");
			//$("textarea[name='"+field+"']").parent().find("span").addClass("fa fa-remove form-control-feedback");
			$("textarea[name='"+field+"']").parent().find("p").text(msg);
			return 1;
		}else{
			/*$("textarea[name='"+field+"']").parent().removeClass("has-error has-feedback");
			$("textarea[name='"+field+"']").parent().find("span").removeClass("fa fa-remove form-control-feedback");
			$("textarea[name='"+field+"']").addClass("abc");
			$("textarea[name='"+field+"']").parent().find("span").addClass("fa fa-check-square text-green form-control-feedback");*/
			$("textarea[name='"+field+"']").parent().find("p").text("");
			return 0;
		}
	}	
</script> 
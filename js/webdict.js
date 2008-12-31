/*************************************************
	Webdict

	@author: NGUYEN DAI Quy <vnpenguin@vnoss.org>
	@license: GPL
	@date: 27/Dec/2008

*************************************************/
var dictName = '';
function doSubmit(){
	$("#selDict").val(dictName);
	$("#bSubmit").trigger('click');
	return false;
}
// Show the word in nearbyWord list when clicking
function showWord ( id ){
	$("#qStr").val("");
	$("#wordId").val(id);
	$("#bSubmit").trigger('click');
	//return false;
}
function initDict (){
	$("#qStr").val('a');
	$("#selDict").val('en_vi');
	$("#bSubmit").trigger('click');
}

$(document).ready(function() {
	dictName = $("#selDict").val();
	$("#dName").text(dictName);
	$("#qStr").autocomplete(
		"query.php", {
			delay:30,
			minChars:3,
			matchSubset:1,
			matchContains:1,
			cacheLength:10,
			autoFill:true,
			extraParams: {d:dictName}
		}
	);
	$("#selDict").change(function () {
		dictName = $("#selDict").val();
		$("#dName").text(dictName);
	});
	$("#qStr").focus(function(){
		$(this).select();
		dictName = $("#selDict").val();
	});
	
	
	$("#wordList").change(function(){
		var id = $("#wordList").val();
		showWord ( id );
	});
	
	
});

//initDict();

		
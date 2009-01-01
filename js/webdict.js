/*------------------------------------------------------------------------
	WDict, another web-based dictionary

	@author  NGUYEN-DAI Quy <vnpenguin@vnoss.org>
	@license http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
	@date    Sun Jan  8 17:40:22 CET 2006
	@url     http://vnoss.org http://forum.vnoss.org 
--------------------------------------------------------------------------*/
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

		
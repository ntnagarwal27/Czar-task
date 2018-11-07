$(document).ready(function(){

$.ajax({
method:"GET",
url:"http://localhost/task-websites/controller/controller.php",
success:function(result){

//$('#directory').html(result);
var data = JSON.parse(result);
var root_data = data.root;
var removed = data.removed;
var added = data.added;
var modified = data.modified;
var list = '';
	root_data.forEach(function(data1){
	list += '<a  href="'+data1+'">'+data1+'</a><br>';
	});
	$('#directory').html('<ul>'+list+'</ul>');

	function getChanges(abc,added,modified)   // function to display the directory structure and changes
	{
		var listdata = Array.from(Object.keys(abc), k=>abc[k]);
		var added_data = Array.from(Object.keys(added), k=>added[k]);
		//var modified_data = Array.from(Object.keys(modified), k=>modified[k]);
		var list2 = '';
		listdata.forEach(function(data2){
		//console.log(data2);
		list2 += '<a  href="javascript:void(0)" class="text-danger">'+data2+'(Removed)</a><br>';
		});
		var list3 = '';
		added_data.forEach(function(data3){
		list3 += '<a  href="javascript:void(0)" class="text-success">'+data3+'(Added)</a><br>';
		});
		var list4 = '';
		modified.forEach(function(data4){
        list4 += '<a  href="javascript:void(0)" class="text-warning">'+data4+'(Modified)</a><br>';
		});
		var final_list = list2+list3+list4;
		$('#changesmade').html('<ul>'+final_list+'</ul>');
	}
getChanges(removed,added,modified);
}


});


});


$(document).ready(function(){

	$("#addItemForm").submit(function(event){
		var title=$("#title").val();
		var year=$("#year").val();
		var isbn=$("#isbn").val();
		var mediaType=$("#mediaType").val();
		var edition=$("#edition").val();
		var issueNo=$("#issueNo").val();
		var barcode=$("#barcode").val();
		var status=$("#status").val();
		var checkoutDur=$("#checkoutDur").val();
		var renewLim=$("#renewLim").val();
		// var tagsVal=[];
		// var tagsType=[];
		// for(var i = 0; i <numOfTags; i++){
		// 	var tagId= "#tag" + String(i);
		// 	var tagSelId ="#tagSelect" + String(i);
		// 	tagsVal[i]=$(tagId).val();
		// 	tagsType[i]=$(tagSelId).val();

		// }
		// var roles=[];
		// var fnames=[];
		// var lnames=[];
		// for (var i = 0; i < numOfContributors; i++) {
		// 	var roleId = "#role" + String(i);
		// 	var fnameId="#fname" + String(i);
		// 	var lnameId="#lname" + String(i);
		// 	roles[i]=$(roleId).val();
		// 	fnames[i]=$(fnameId).val();
		// 	lnames[i]=(lnameId).val();

		// }

		var arrayOfTags = [];
		for (var i = 0; i <= numOfTags; i++) {
			var tagId= "#tag" + String(i);
			var tagSelId ="#tagSelect" + String(i);
			var tagVal =$(tagId).val();
			var tagType=$(tagSelId).val();
			arrayOfTags[i] = {
				name: tagVal,
				type: tagType
			};
		}

		var jsonedTags = JSON.stringify(arrayOfTags);

		var arrayOfContributors = [];

		for (var i = 0; i <= numOfContributors; i++) {
			
				var roleId = "#role" + String(i);
				var fnameId="#fname" + String(i);
				var lnameId="#lname" + String(i);

				var role = $(roleId).val();
				var fname = $(fnameId).val();
				var lname =$(lnameId).val();
				arrayOfContributors[i]= {
					contributor: role,
					// role:{
					// 	first: fname,
					// 	last: lname
					// }
				};
				arrayOfContributors[i][role]={
					first: fname,
					last: lname
				};

		}

		var jsonedContributors = JSON.stringify(arrayOfContributors);

		var copyNo = $("#copyNo").val();
		var callNo = $('#callNo').val();
		var volume = $('#volume').val();


		$.ajax({
			type:"POST",
			data: {'title':title, 'year':year, 'isbn':isbn, 'media_type':mediaType, 'edition':edition, 'issue_no':issueNo, 'barcode':barcode,
			'status': status, 'checkoutDur': checkoutDur, 'renewLim':renewLim, 'tag':jsonedTags, 'contributor': jsonedContributors, 'copy_no': copyNo, 'call_no': callNo, 'volume': volume}, 
			url: "../../cls_scripts/add_item.php",
			success: function(data){
				var succFail = JSON.parse(data);
				alert(succFail);
			}
		});

		event.preventDefault();
	});


});

var numOfTags=0;
var numOfContributors=0;

// var tagForm= "<label for='tag'>Tags: </label>\
//               <select name='tag'>\
//               <option value='title'>Title</option>\
//               <option value='subject'>Subject</option>\
//               <option value='genre'>Genre</option>\
//               <option value='language'>Language</option>\
//               <option value='contributor'>Contributor</option>\
//               </select>\
//               <input type='text' id='tag' name='tag' class='tag' />";

// var contributorForm = "<label for='contributor'>Contributor: </label>\
//               <label for='role'>Role: </label>\
//               <input type='text' id='role' name='role' class='role'/>\
//               <label for='fname'>First Name: </label>\
//               <input type='text' id='fname' name='fname' class='fname' />\
//               <label for='lname'>Last Name: </label>\
//               <input type='text' id='lname' name='lname' class='lname' />";

function addTag(){
	numOfTags++;
	var tagForm= "<label for='tag" + String(numOfTags) +"'>Tags: </label>\
              <select name='tag" + String(numOfTags) +" id='tagSelect"+String(numOfTags) +">\
              <option value='title'>Title</option>\
              <option value='subject'>Subject</option>\
              <option value='genre'>Genre</option>\
              <option value='language'>Language</option>\
              <option value='contributor'>Contributor</option>\
              </select>\
              <input type='text' id='tag" + String(numOfTags) +"' name='tag" + String(numOfTags) +"' class='tag" + String(numOfTags) +"' />";
	$("#addTagButton").before(tagForm);
}

function addContributor(){
	numOfContributors++;
	var contributorForm = "<label for='contributor" + String(numOfContributors) + "'>Contributor: </label>\
              <label for='role" + String(numOfContributors) + "'>Role: </label>\
              <input type='text' id='role" + String(numOfContributors) + "' name='role" + String(numOfContributors) + "' class='role" + String(numOfContributors) + "'/>\
              <label for='fname" + String(numOfContributors) + "'>First Name: </label>\
              <input type='text' id='fname" + String(numOfContributors) + "' name='fname" + String(numOfContributors) + "' class='fname" + String(numOfContributors) + "' />\
              <label for='lname" + String(numOfContributors) + "" + String(numOfContributors) + "'>Last Name: </label>\
              <input type='text' id='lname" + String(numOfContributors) + "' name='lname" + String(numOfContributors) + "' class='lname" + String(numOfContributors) + "' />";
	$("#addContributorButton").before(contributorForm);
}
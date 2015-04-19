$(document).ready(function(){



});



var tagForm= "<label for='tag'>Tags: </label>\
              <select name='tag'>\
              <option value='title'>Title</option>\
              <option value='subject'>Subject</option>\
              <option value='genre'>Genre</option>\
              <option value='language'>Language</option>\
              <option value='contributor'>Contributor</option>\
              </select>\
              <input type='text' id='tag' name='tag' class='tag' />";

var contributorForm = "<label for='contributor'>Contributor: </label>\
              <label for='role'>Role: </label>\
              <input type='text' id='role' name='role' class='role'/>\
              <label for='fname'>First Name: </label>\
              <input type='text' id='fname' name='fname' class='fname' />\
              <label for='lname'>Last Name: </label>\
              <input type='text' id='lname' name='lname' class='lname' />";

function addTag(){
	$("#addTagButton").before(tagForm);
}

function addContributor(){
	$("#addContributorButton").before(contributorForm);
}
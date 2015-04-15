$(document).ready(function(){
	$("#checkoutSelect").hide();

	$('#patronId').keypress(function(e) {
    if(e.which == 13) {
    	
    	$("#patronSelect").hide();
    	$("#checkoutSelect").show();

    }
});

	$('#bookId').keypress(function(e) {
    if(e.which == 13) {
    	
        var result = addBook(this.value);
        
            }
            });

	$('button').click(function(){
        $("table input[type='checkbox']:checked").parent().parent().remove();
    });

});



rows = ["<tr> <td><input type='checkbox' ></td> <td>Harry Potter</td> <td>JK Rowling</td><td>0</td> <td>03/14/1999</td> </tr>", 
        "<tr> <td><input type='checkbox' ></td> <td>LOTR</td> <td>JRR Tolkien</td><td>1</td> <td>03/14/1999</td> </tr>",
        "<tr> <td><input type='checkbox'></td> <td>Interracial Hole Stretchers 2</td> <td>Dave</td><td>2</td> <td>03/14/1999</td> </tr>"];

function addBook(n){
    var newbook = rows[n];
    document.getElementById("checkoutTable").insertRow(-1).innerHTML = newbook;
}
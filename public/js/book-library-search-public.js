(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	  $( function() {

	    $( "#slider-range" ).slider({
	      range: true,
	      min: 0,
	      max: 500,
	      values: [ '', ''  ],
	      slide: function( event, ui ) {
	        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
	      }
	    });
	    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
	      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
		  } );

	  	
	  //$(this).slider('value',$(this).parent().find(".inputNumber").val());
})( jQuery );

jQuery(function($){

	function star_rat(value){
			//alert(value);
			var rate = '';
			for (var j = 0; j < 5 ; j++) {
			    if( j < value ){
			    	 rate += '<i class="fa fa-star" data-rating="'+ (j+1) +'"></i>';		
			    }else{
			    	 rate += '<i class="fa fa-star-o" data-rating="'+ (j+1) +'"></i>';
			    }
			}	 
			 return rate;
	  	}

	$('#filter').submit(function(){
		var filter = $('#filter');
		var bookname = $('.book-name').val();
		var author = $('.author').val();
		var publisher = $('.publisher').val();
		var rating = $('.rating').val();
		//var price = $('#amount').val();
		var min_price = $( "#slider-range" ).slider( "values", 0 );
	 	var max_price = $( "#slider-range" ).slider( "values", 1 );
	 	//alert(min_price);
		$.ajax({
			url:filter.attr('action'),
			dataType : "json",
			data:{
				action: 'myfilter', 
				bookname : bookname,
				author : author,
				publisher : publisher,
				rating : rating,
				min_price : min_price,
				max_price : max_price
			 }, // form data
			type:filter.attr('method'), // POST
			beforeSend:function(xhr){
				filter.find('button').text('Processing...'); // changing the button label
			},
			success : function(response) {
            var mafs = $("#response").empty();
            if(response) {
            	var html  = "<table>";
              		 	html  += "<tr>";
              		 	html  += "<th>No.</th>";
              		 	html  += "<th>Book Name</th>";
              		 	html  += "<th>Price</th>";
              		 	html  += "<th>Author</th>";
              		 	html  += "<th>Publisher</th>";
              		 	html  += "<th>Rating</th>";
              		 	html  += "</tr>";
              			
                for(var i = 0; i < response.length; i++) {
              		html  += "<tr id='movie-" + response[i].id + "'>";
              		html  += "<td>"+ [i] + "</td>";
              		html  += "<td> <a href='"+response[i].permalink+"'>"+ response[i].title + "</a></td>";
              		html  += "<td>"+ response[i].price + "</td>";
              		html  += "<td>"+ response[i].author + "</td>";
              		html  += "<td>"+ response[i].publisher + "</td>";
              		html  += "<td><div class='simple-rating star-rating'>"+ star_rat(response[i].rating) + "</div></td>";
              		html  += "</tr>";      
                }
                html  += "</table>"
                $("#response").append(html);
            } else {
            	var html  = "<table>";
              		 	html  += "<tr>";
              		 	html  += "<th>No.</th>";
              		 	html  += "<th>Book Name</th>";
              		 	html  += "<th>Price</th>";
              		 	html  += "<th>Author</th>";
              		 	html  += "<th>Publisher</th>";
              		 	html  += "<th>Rating</th>";
              		 	html  += "</tr>";
                html += "<tr class='no-result'><td>No matching Book found. Try a different filter or search keyword</td></tr>";
                html  += "</table>";
                $("#response").append(html);
            }
        }
		});
		return false;
	});

});



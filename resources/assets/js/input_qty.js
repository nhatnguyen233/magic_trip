// Quantity buttons
	function qtySum(){
    var adults = document.getElementsByName('adults');
    var childrens = document.getElementsByName('childrens');

    var number_of_adults = 0;
    for(var i=0;i<adults.length;i++){
        if(parseInt(adults[i].value))
            number_of_adults += parseInt(adults[i].value);
    }
    var number_of_childrens = 0;
    for(var j=0;j<childrens.length;j++){
        if(parseInt(childrens[j].value))
            number_of_childrens += parseInt(childrens[j].value);
    }
    var cardQty = document.querySelector(".qtyTotal");
        cardQty.innerHTML = parseInt(number_of_adults) + parseInt(number_of_childrens);
	}
	qtySum();

	$(function() {

	   $(".qtyButtons input").after('<div class="qtyInc"></div>');
	   $(".qtyButtons input").before('<div class="qtyDec"></div>');
	   $(".qtyDec, .qtyInc").on("click", function() {

		  var $button = $(this);
		  var oldValue = $button.parent().find("input").val();

		  if ($button.hasClass('qtyInc')) {
			 var newVal = parseFloat(oldValue) + 1;
		  } else {
			 // don't allow decrementing below zero
			 if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			 } else {
				newVal = 0;
			 }
		  }

		  $button.parent().find("input").val(newVal);
		  qtySum();
		  $(".qtyTotal").addClass("rotate-x");

	   });

	   function removeAnimation() { $(".qtyTotal").removeClass("rotate-x"); }
	   const counter = document.querySelector(".qtyTotal");
	   counter.addEventListener("animationend", removeAnimation);

	});

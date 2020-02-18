		$(document).ready(function() {
			$("#logoParade").smoothDivScroll({ 
				autoScrollingMode: "always", 
				autoScrollingDirection: "endlessLoopRight", 
				autoScrollingStep: 1, 
				autoScrollingInterval: 25 
			});

			// Logo parade event handlers
//			$("#logoParade").bind("mouseover", function() {
//				$(this).smoothDivScroll("stopAutoScrolling");
//			}).bind("mouseout", function() {
//				$(this).smoothDivScroll("startAutoScrolling");
//			});

		});
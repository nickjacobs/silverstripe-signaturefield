import SignaturePad from "signature_pad";

jQuery.entwine("signature", function($) {

	$("input.signature.no-sigpad").entwine({
		onmatch: function() {
			var $input = this; // = jquery object
			var $canvas = $('<canvas></canvas>');
			// insert canvas & create pad
			$input.after($canvas);

            // Dynamically set the canvas width to match its parent
            // var updateCanvasWidth = function() {
            //     var parentWidth = $canvas.parent().width(); // Get the parent element's width
            //     $canvas.attr('width', parentWidth); // Set canvas width
            //     $canvas.attr('height', 200); // Set canvas height if needed
            // };

            // Update canvas width initially and on window resize
            //updateCanvasWidth();
            //$(window).on('resize', updateCanvasWidth);

            var signaturePad = new SignaturePad($canvas[0]);
			if(this.val()!=''){
				signaturePad.fromDataURL(this.val());
			}
			signaturePad.addEventListener("endStroke",() => {
                $input.val( signaturePad.toDataURL() );
            });
			// add clear button
			var $clearbtn = $('<div class="signaturefield-clear-btn"><span>Clear</span></div>');
			$clearbtn.click(function(event){
				signaturePad.clear();
				$input.val('');
			});
			// insert button
			$canvas.after($clearbtn);

			// Monkey patch to expose svg data (http://me.dt.in.th/page/JavaScript-override/)
			// https://github.com/szimek/signature_pad/issues/44
//			var originalSaveResults = test.saveResults
//			test.saveResults = function(filepath) {
//				var returnValue = originalSaveResults.apply(this, arguments)
//				var planpath = filepath.replace('.xml', '_plan.xml')
//				console.log('Save test plan to ' + planpath)
//				return returnValue
//			}

//			// Returns signature image as data URL
//			signaturePad.toDataURL();
//
//			// Draws signature image from data URL
//			signaturePad.fromDataURL("data:image/png;base64,iVBORw0K...");
//
//			// Clears the canvas
//			signaturePad.clear();
//
//			// Returns true if canvas is empty, otherwise returns false
//			signaturePad.isEmpty();
//
//			// Unbinds all event handlers (onunmatch?)
//			signaturePad.off();
		},

	});
});


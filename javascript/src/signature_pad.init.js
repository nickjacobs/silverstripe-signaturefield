import SignaturePad from "signature_pad";

jQuery.entwine("signature", function($) {

	$("input.signature.no-sigpad").entwine({
		onmatch: function() {
			var $input = this; // = jquery object
            var $canvas = $('<canvas class="signature-canvas"></canvas>');
			// insert canvas & create pad
			$input.after($canvas);

            // Dynamically set the canvas width to match its parent
            function syncCanvasSize() {
                const canvas = $canvas[0];
                const rect = canvas.getBoundingClientRect();

                if (rect.width > 0 && rect.height > 0) {
                    canvas.width = rect.width;
                    canvas.height = rect.height;
                }
            }

            // Defer initial sync until after layout
            $(function () {
                requestAnimationFrame(syncCanvasSize);
            });

            $(window).on('resize', syncCanvasSize);
            $input.on('focus', syncCanvasSize);

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


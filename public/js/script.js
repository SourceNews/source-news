/*
 * Return the start and end of the current selection, undefines otherwise.
 */
function getSelectionCharOffsetsWithin() {
	var start = 0, end = 0;
	var sel, range, priorRange;
	if (typeof window.getSelection != "undefined") {
		range = window.getSelection().getRangeAt(0);
		if (range.startContainer !== range.endContainer) {
			console.log("Not the same");
			return;
		}
		if (range.toString().length === 0) {
			console.log("Nothing selected");
			return;
		}
		priorRange = range.cloneRange();
		priorRange.selectNodeContents(range.startContainer);
		priorRange.setEnd(range.startContainer, range.startOffset);
		start = priorRange.toString().length;
		end = start + range.toString().length;
		return {
			start: start,
			end: end
		};
	} else if (typeof document.selection != "undefined" &&
			(sel = document.selection).type != "Control") {
		alert("Please use Chrome or Firefox");
		return;
	}
}

/*
 * Run the callback when something has been selected with the data
 * passed in containing the paragraph id and the start and end character
 * position
 */
function addSelectListener(callback) {
	$(document.body).bind('mouseup', function(e){
		var sel = getSelectionCharOffsetsWithin();
		sel.name = e.target.getAttribute("name");
		callback(sel)
	});
}

$(function(){
	$( "textarea" ).each(function(){
		$(this).autosize({append:"\n"})
	});
});

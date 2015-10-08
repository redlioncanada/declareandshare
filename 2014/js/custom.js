function disable(obj) {
	obj.prop('disabled', true);
	obj.prop('checked', false);
	obj.parent().addClass("disabled");
	obj.siblings().css( "cursor", "not-allowed" );
}

function enable(obj) {
	obj.prop('disabled', false);
	obj.parent().removeClass("disabled");
	obj.siblings().removeAttr('style');
}

function submatrix(inputName, data) {
	var thereCanBeOnlyOne = (data.length === 1);
	$( "input[name='"+inputName+"']" ).each(function() {
		var classCheck = false;
		for (var index = 0; index < data.length; ++index) {
			if ($(this).parent().hasClass(data[index])) {
				classCheck = true;
			}
		}
		if (!classCheck) {
			disable($(this));
		} else if (thereCanBeOnlyOne) {
			$(this).prop('checked', true);
		}
	});
}

$(function() {
	var parsed_data;
	
	$("a[data-toggle=popover]").popover({html: true}).click(function(e) {
        e.preventDefault();
     });
	
	$('label > input').on('click', function() {
		var inputName = $(this).attr('name');
		var inputValue = $(this).attr('value');
		
		$( "input[name='"+inputName+"']" ).each(function() {
			var iteratedValue = $(this).attr('value');
			if (inputValue !== iteratedValue) {
				disable($(this));
			} else {
				enable($(this));
			}
		});

		$.post( "/welcome/api", $('form').serialize())
				.done(function( data ) {
					parsed_data = JSON.parse(data);
					if (inputName !== 'config') { submatrix("config", parsed_data.config); }
					if (inputName !== 'bowl') { submatrix("bowl", parsed_data.bowl); }
					if (inputName !== 'power') { submatrix("power", parsed_data.power); }
					if (inputName !== 'capacity') { submatrix("capacity", parsed_data.capacity); }
					if (inputName !== 'color') { submatrix("color", parsed_data.color); }
					//console.log(parsed_data);
					var empty = false;
        
			        if(!$("input:radio[name=config]").is(":checked")){
			            empty = true;
			        }
			        if(!$("input:radio[name=bowl]").is(":checked")){
			            empty = true;
			        }
			        if(!$("input:radio[name=power]").is(":checked")){
			            empty = true;
			        }
			        if(!$("input:radio[name=capacity]").is(":checked")){
			            empty = true;
			        }
			        if(!$("input:radio[name=color]").is(":checked")){
			            empty = true;
			        }
								
			        if (empty) {
			            $('#submit').attr('disabled', 'disabled');
			        } else {
			            $('#submit').removeAttr('disabled');
			        }
				});
        
	});
	
	$('#reset, #reset-bottom').on('click', function(e) {
		e.preventDefault();
		$('label > input').each(function() {
			enable($(this));
			$(this).prop('checked', false);
		});
		$(this).blur();
	});

});
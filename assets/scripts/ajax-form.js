function successAjax(func, result)
{
	func(result);
}

$('.save-new-card').on('click', function()
	{
		var data = $("#ajaxformcreate").serialize();

		if ($('#InputHeader').val() != "" && $('#InputDescription').val() != "")
		{
			sendAjaxForm('ajaxform/create', data, function(response) {
				$('.close-btn').click();
				window.location.reload();	
			})
		}	
	}
);

$('.card-open').on('click', function(event)
	{
		let classes = event.target.className;

		var data = "element=" + classes;

		sendAjaxForm('ajaxform/get', data, function(response) {
			$('#exampleModalLabel').append(response.header);
			$('#open-modal-body').append(response.description);
			ym(88521028,'reachGoal','234854512');
		})
	}
);

var modal = document.getElementById('exampleModal')
modal.addEventListener('hidden.bs.modal', function (event) {
	$('#exampleModalLabel').empty();
	$('#open-modal-body').empty();
})

function sendAjaxForm(url, data, method)
{
    $.ajax({
    	type: "POST", url: url, data: data,
        
		success: function(response) {
        	result = $.parseJSON(response);
        	successAjax(method, result);
    	}
 	});
}
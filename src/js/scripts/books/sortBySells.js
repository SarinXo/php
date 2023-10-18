'use strict'

export function getJson(callback)
{
	$.ajax({
		type: 'GET',
		url: '/php/scripts/books/sortBySells.php',
		success: function(json)
		{
			callback(JSON.parse(json));
		}
	});
}
'use strict'

export function getJson(offset, rowsCount, callback)
{
	$.ajax({
		type: 'GET',
		url: './php/scripts/books/read.php',
		data: { offset: offset, rowsCount: rowsCount },
		success: function(json)
		{
			callback(JSON.parse(json));
		}
	});
}
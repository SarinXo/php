'use strict'

export function getJson(searchType, searchQuery, callback)
{
	$.ajax({
		type: 'GET',
		url: '/php/scripts/books/search.php',
		data: { searchType: searchType, searchQuery: searchQuery },
		success: function(json)
		{
			callback(JSON.parse(json));
		}
	});
}
'use strict'

import { getJson as booksSearchJson } from './books/search.js';
import { getView as booksCreateView } from './books/view.js';

$(document).ready(function()
{
	$('#search-books').on('submit', function(event)
	{
		event.preventDefault();

		var formData = $('#search-books').serializeArray();

		booksSearchJson(formData[0]['value'], formData[1]['value'], function(json)
		{
			$('#books').html(booksCreateView(json));
			$('#books').append(`<i>Найдено записей: ${json.length}.</i>`);
		});
	});
});
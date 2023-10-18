'use strict'

import { getJson as booksReadJson } from './books/read.js';
import { getView as booksCreateView } from './books/view.js';

$(document).ready(function()
{
	var offset = 0;
	var count = 3;
	booksReadJson(offset, count, function(json)
	{
		$('.books').append(booksCreateView(json));
	});

	var loading = false;
	$(window).scroll(function()
	{
		if ($(window).scrollTop() == $(document).height() - $(window).height())
		{
			if(loading === false)
			{
				loading = true;
				offset += count;

				booksReadJson(offset, count, function(json)
				{
					$('.books').append(booksCreateView(json));
				});

				loading = false;
			}
		}
	});
});
let users = []

function getDataUsers() {
	$.ajax({
		url: "http://localhost:3000/items",
		success: function (data) {
			users = data;
			render(data);
		}
	});
}

getDataUsers();

function render(data) {
	let content = '';
	for (let i = 0; i < data.length; i++) {
		const user = data[i];
		let creation_date = new Date(user.creation_date * 1000);
		content += `
		<tr>
		<td>
		<img src="${user.profile_image}" alt="${user.profile_image}"/>
		</td>
		<td>
		<a href = "${user.link}">${user.display_name}</a>
		</td>
		<td>
		${user.reputation}
		</td>
		<td>
		<a href = "${user.website_url}">${user.website_url}</a>
		</td>
		<td>
		${creation_date.toLocaleString('vi')}
		</td>
		</tr>
		`;

		$('#data-users').html(content);
	}
}

function sort(th) {
	//làm mờ  icon sort
	let asc = $('.asc');
	let dsc = $('.dsc');
	asc.css('opacity', '0.3');
	dsc.css('opacity', '0.3');
		 	
	//Lấy ra tên cột cần sort
	thElement = $(th);
	let name = thElement.attr('data-name');

	//Lấy ra chiều đang sort (0 chưa sort, 1: sort theo chiều asc. 2 dsc)
	let order = thElement.attr('data-order');

	switch (order) {
		case '0': 
		 	thElement.attr('data-order', '1')
		 	thElement.find('.asc').css('opacity', '1')

		 	if (name === 'display_name') {
		 		users.sort(function (a,b) {
		 			return a.display_name.localeCompare(b.display_name)
		 		})
		 	} else if (name === 'user_id') {
		 		users.sort(function (a,b) {
		 			return a.user_id - b.user_id
		 		})
		 	} else if (name === 'creation_date') {
		 		users.sort(function(a,b) {
		 			return a.creation_date - b.creation_date
		 		})
		 	}
		 	render(users);
		 	break;

		case '1':
		 	thElement.attr('data-order', '0')
		 	thElement.find('.dsc').css('opacity', '1')
		 	thElement.find('.asc').css('opacity', '0.3')

		 	if (name === 'display_name') {
				users.sort(function(a,b) {
	 				return b.display_name.localeCompare(a.display_name)
		 		})
		 	} else if (name = 'user_id') {
		 		users.sort(function(a,b) {
		 			return b.user_id - a.user_id
		 		})
		 	} else if (name = 'creation_date') {
		 		users.sort(function(a,b) {
		 			return b.creation_date - a.creation_date
		 		})
		 	}
		 	render(users);
		 	break;

	}	 	
}

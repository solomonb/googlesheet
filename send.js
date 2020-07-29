let form = document.getElementById('form');

form.addEventListener('submit', function(event) {
	let name = this.querySelector('[name="name"]').value;
	let surname = this.querySelector('[name="surname"]').value;
	let age = this.querySelector('[name="age"]').value;
	
	let formData = new FormData();
	formData.set('name', name);
	formData.set('surname', surname);
	formData.set('age', age);
	
	let promise = fetch('save.php', {
		method: 'POST',
		body: new FormData(this),
	});
	
	promise.then(
			response => {
				return response.text();
			}
		).then(
			text => {
				alert(text);
			}
		).catch(error => console.error(error));
	event.preventDefault();	
	
});
	
	
	
	
	
	


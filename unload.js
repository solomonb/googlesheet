let elem = document.getElementById('unload');
	
	function handler() {	
		let promise = fetch('unload.php');
		
		promise.then(
			response => {
				return response.text();
			}
		).then(
			text => {
				alert(text);
			}
		).catch(error => console.error(error));
			
		
	 };	
  
  elem.addEventListener("click", handler);
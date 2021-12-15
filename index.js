const form = document.getElementById('form');
const userid = document.getElementById('userid');
const password = document.getElementById('password');

form.addEventListener('submit', e => {
	e.preventDefault();
	checkInputs();
});

function checkInputs() {
	const useridValue = userid.value.trim();
	const passwordValue = password.value.trim();

	if(useridValue === '') {
		setError(userid, 'UserID cannot be blank');
	} else {
		setSuccess(userid);
	}

	if(passwordValue === '') {
		setError(password, 'Password cannot be blank');
	} else {
		setSuccess(password);
	}
}

function setError(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccess(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}

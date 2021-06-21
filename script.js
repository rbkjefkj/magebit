const form = document.getElementById('form');
const button = document.getElementById('button');
const email = document.getElementById('input');
const checkbox = document.getElementById('checkbox');
const small = document.getElementById('small');
const small2 = document.getElementById('small2');

form.addEventListener('input', (e) => { //keydown event would lag 1 char behind what's actually in the input
	checkInput();
});

form.addEventListener('submit', (e) => {
	if (!checkbox.checked) {
		e.preventDefault();
		small2.innerText = 'You must accept the terms and conditions';
		disableButton();
	} else {
		small2.innerText='';
		enableButton();
		//handleRes();
	}
});

function handleRes() {

}

function disableButton() {
	button.classList.remove('enabled');
	button.disabled = true;
}

function enableButton() {
	button.disabled = false;
	button.className = 'enabled';
}

function checkInput() {
	const emailValue = email.value.trim();
	//const checkboxValue = checkbox.value

	if (emailValue === '') {
		setErrorFor(email, 'Email address is required');
		disableButton();
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'Please provide a valid email address');
		disableButton();
	} else if (isColombian(emailValue)) {
		setErrorFor(email, 'We are not accepting subscriptions from Colombia emails');
		disableButton();
	} else {
		setSuccessFor(email);
	}
}

function setErrorFor(input, message) {
	if (input === email) {
		small.innerText = message;
		small.className = 'err';
	}

	//select relevant small element, i think ill need separate functions for each small
	//small.innerText = message;
	//add error class to small like small.className = 'form-control error';
}

function setSuccessFor(input) {
	small.innerText = '';
	button.disabled = false;
	button.className = 'enabled';
}

function isEmail(email) {
 return /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email);
}

function isColombian(email) {
	return /.co$/.test(email);
}

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const step1 = document.getElementById('step1');
const fwd_btn = document.getElementById('signUp1');
const bwd_btn = document.getElementById('signUp2');


signUpButton.addEventListener('click', () => {
	container.classList.add("left-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("left-panel-active");
    step1.classList.remove("next-page");
});

fwd_btn.addEventListener('click', function(e) {
    e.preventDefault();
    step1.classList.add("next-page");
});

bwd_btn.addEventListener('click', function(e) {
    e.preventDefault();
    step1.classList.remove("next-page");
});
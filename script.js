document.addEventListener("DOMContentLoaded", function() {
    const signUpButton = document.getElementById('signUpButton');
    const signInButton = document.getElementById('signInButton');
    const signup = document.getElementById('signup');
    const signIn = document.getElementById('signIn');

    // Show the sign-up form and hide the sign-in form
    signUpButton.addEventListener('click', () => {
        signup.style.display = 'block';
        signIn.style.display = 'none';
    });

    // Show the sign-in form and hide the sign-up form
    signInButton.addEventListener('click', () => {
        signIn.style.display = 'block';
        signup.style.display = 'none';
    });

    // Initially display the sign-in form
    signIn.style.display = 'block';
    signup.style.display = 'none';
});

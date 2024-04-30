const signUpButton = document.getElementById('signUp')
const signInButton = document.getElementById('signIn')
const containerBis = document.getElementById('containerBis')

signUpButton.addEventListener('click', () => {
    containerBis.classList.add("right-pannel-active")
})

signInButton.addEventListener('click', () => {
    containerBis.classList.remove("right-pannel-active")
})
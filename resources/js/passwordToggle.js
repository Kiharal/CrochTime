
const toggleBtn = document.getElementById('viewPass')
toggleBtn.addEventListener('click', () => {

    const input = document.getElementById('passwordBox')
    const hideEye = document.getElementById('show-hide')
    const showEye = document.getElementById('show-seen')
    const show = input.type === 'password'
    console.log(show)
    input.type = show ? 'text' : 'password'
    showEye.classList.toggle('hidden', show)
    hideEye.classList.toggle('hidden', !show)
})

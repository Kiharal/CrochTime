
document.addEventListener('click', event => {
    const toggleBtn = event.target.closest('#viewPass')

    if(toggleBtn){
        const input = toggleBtn.closest('div').querySelector('#input')
        const show = input.type === 'password'
        const showEye = toggleBtn.closest('div').querySelector('#show-seen')
        const hideEye = toggleBtn.closest('div').querySelector('#show-hide')
        input.type = show ? 'text' : 'password'
        showEye.classList.toggle('hidden', show)
        hideEye.classList.toggle('hidden', !show)
    }
})

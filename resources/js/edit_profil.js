const informasiPribadiBtn = document.querySelector('#informasiPribadiBtn');
const editPasswordBtn = document.querySelector('#editPasswordBtn');
const informasiForm = document.querySelector('#informasiForm');
const passwordForm = document.querySelector('#passwordForm');
const indicator = document.querySelector('#indicator');

informasiPribadiBtn.addEventListener('click', () => {
    indicator.style.transform = 'translateX(0)';
    informasiForm.classList.remove('hidden');
    passwordForm.classList.add('hidden');
});

editPasswordBtn.addEventListener('click', () => {
    indicator.style.transform = 'translateX(100%)';
    informasiForm.classList.add('hidden');
    passwordForm.classList.remove('hidden');
});
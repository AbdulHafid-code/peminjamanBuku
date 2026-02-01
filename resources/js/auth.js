const container = document.querySelector('.container');
const loginMoveBtn = document.querySelector('.login-move-btn');
const registerMoveBtn = document.querySelector('.register-move-btn');
const showPasswordBtns = document.querySelectorAll('.show-password-btn');

registerMoveBtn.addEventListener('click', () => {
    container.classList.add('active');
});

loginMoveBtn.addEventListener('click', () => {
    container.classList.remove('active');
});

showPasswordBtns.forEach((btn) => {
    btn.addEventListener('click', () => {

        const input = btn
            .closest('.input-box')
            .querySelector('.show-password-input');

        if (input.type === 'password') {
            input.type = 'text';
            btn.classList.remove('bxs-show');
            btn.classList.add('bxs-hide');
        } else {
            input.type = 'password';
            btn.classList.remove('bxs-hide');
            btn.classList.add('bxs-show');
        }
    });
});

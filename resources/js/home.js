const hamburgerNavbar = document.querySelector(".hamburger-navbar");
const navbar = document.querySelector(".navbar-element");
const sections = document.querySelectorAll("section");
const navLinks = document.querySelectorAll(".link-nav a");
const navItems = document.querySelectorAll(".link-nav");
const visiMisiIndicator = document.querySelectorAll("#visimisiindicator");
const visibtn = document.querySelectorAll("#visibtn");
const misibtn = document.querySelectorAll("#misibtn");
const visicontent = document.querySelectorAll("#visicontent");
const misicontent = document.querySelectorAll("#misicontent");
const contentBoxVisiMisi = document.querySelectorAll("#contentBoxVisiMisi");

// ketika scroll maka akan di tambahkan class tersebut
window.addEventListener('scroll', () => {
    const scrollTop = window.scrollY;
    if(scrollTop > 30) {
        navbar.classList.add('scroll')
    } else {
        navbar.classList.remove('scroll')
    }
})

hamburgerNavbar.addEventListener('click', () => {
    hamburgerNavbar.classList.toggle('active')
    document.querySelector(".nav-link-mobile").classList.toggle('active');
});


// filter gelap terang
const html = document.documentElement;
const btn = document.getElementById('dark-light');

if (localStorage.getItem('theme')) {
	html.setAttribute('data-theme', localStorage.getItem('theme'));
}

btn.addEventListener('click', e => {
	e.preventDefault();

	let theme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
	html.setAttribute('data-theme', theme);
	localStorage.setItem('theme', theme);
});
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


// window.addEventListener("scroll", () => {
//     const enableSectionScroll = navbar.dataset.sectionScroll === "true";

//     // ❌ Kalau sectionscriptjs = false → STOP
//     if (!enableSectionScroll) return;
//     const scrollY = window.scrollY;

//     const navItems = document.querySelectorAll(".link-nav");

//     sections.forEach(section => {
//         const offsetTop = section.offsetTop - 100;
//         const height = section.offsetHeight;
//         const id = section.getAttribute("id");

//         if (scrollY >= offsetTop && scrollY < offsetTop + height) {
//             navItems.forEach(item => item.classList.remove("active"));

//             document.querySelectorAll(`.link-nav a[href="#${id}"]`)
//                 .forEach(link => {
//                     link.parentElement.classList.add("active");
//                 });
//         }
//     });
// });

// const addClassNodeList = (list, c) => list.forEach(el => el.classList.add(c));
// const removeClassNodeList = (list, c) => list.forEach(el => el.classList.remove(c));
// const setStyleNodeList = (list, prop, value) => list.forEach(el => el.style[prop] = value);

// let currentVisiMisi = "misi";
// let isAnimatingVisiMisi = false;

// function switchTabVisiMisi(tab) {
//     if (isAnimatingVisiMisi || tab === currentVisiMisi) return;
//     isAnimatingVisiMisi = true;

//     addClassNodeList(contentBoxVisiMisi, "fade-out");

//     setTimeout(() => {
//         if (tab === "visi") {
//             removeClassNodeList(visicontent, "hidden");
//             addClassNodeList(misicontent, "hidden");

//             addClassNodeList(visibtn, "text-white");
//             removeClassNodeList(misibtn, "text-white");

//             setStyleNodeList(visiMisiIndicator, "transform", "translateX(0%)");

//         } else {
//             addClassNodeList(visicontent, "hidden");
//             removeClassNodeList(misicontent, "hidden");

//             removeClassNodeList(visibtn, "text-white");
//             addClassNodeList(misibtn, "text-white");

//             setStyleNodeList(visiMisiIndicator, "transform", "translateX(100%)");
//         }

//         removeClassNodeList(contentBoxVisiMisi, "fade-out");
//         addClassNodeList(contentBoxVisiMisi, "fade-in");

//         setTimeout(() => {
//             removeClassNodeList(contentBoxVisiMisi, "fade-in");
//             currentVisiMisi = tab;
//             isAnimatingVisiMisi = false;
//         }, 500);

//     }, 300);
// }
// switchTabVisiMisi("visi");

// visibtn.forEach(e => {
//     e.addEventListener('click', () => switchTabVisiMisi('visi'))
// })
// misibtn.forEach(e => {
//     e.addEventListener('click', () => switchTabVisiMisi('misi'))
// })

// // function toShortNumber(num) {
// //     num = Number(String(num).replace(/[^\d]/g, "")); // bersihkan dulu

// //     if (num >= 1_000_000_000) return (num / 1_000_000_000).toFixed(1).replace(/\.0$/, "") + "B";
// //     if (num >= 1_000_000) return (num / 1_000_000).toFixed(1).replace(/\.0$/, "") + "M";
// //     if (num >= 1_000) return (num / 1_000).toFixed(1).replace(/\.0$/, "") + "k";

// //     return num.toString(); // kalau < 1000 tetap angka biasa
// // }

// // function potongText(text, limit) {
// //     if (!text || typeof text !== "string") return "";
// //     if (!limit || isNaN(limit) || limit <= 0) return text;

// //     text = text.trim();

// //     return text.length > limit
// //         ? text.substring(0, limit) + "..."
// //         : text;
// // }

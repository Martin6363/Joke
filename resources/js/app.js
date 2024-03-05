import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Get the elements
const aside = document.getElementById('aside');
const dashboardLeftNav = document.getElementById('dashboard_left_nav');

// let parent = aside.parentElement;
// let parentOffsetLeft = parent.offsetLeft;
// let parentOffsetRight = parent.offsetWidth;
// Calculate initial offset positions
// const asideOffsetTop = aside.getBoundingClientRect().top + window.scrollY;

// window.addEventListener('scroll', function() {
//     if (window.scrollY >= asideOffsetTop) {
//         aside.classList.add('aside-fixed');
//         dashboardLeftNav.classList.add('dashboard_left_nav-fixed');
//         aside.style.right = (parentOffsetRight) + 'px';
//         dashboardLeftNav.style.left = (parentOffsetLeft) + 'px';
//     } else {
//         aside.classList.remove('aside-fixed');
//         dashboardLeftNav.classList.remove('dashboard_left_nav-fixed');
//     }
// });

const menu_pop = document.querySelector('#menu-bars');
const navbar = document.querySelector('.header .navbar');

menu_pop.addEventListener = ('click', () => {
    menu_pop.classList.toggle('fa-times');
    navbar.classList.toggle('active');
});


const faqs = document.querySelectorAll('.faq');

faqs.forEach(faq => {
    faq.addEventListener('click', () => {
        faq.classList.toggle('active');
    });
});

const tickets = document.querySelectorAll('.ticket');

tickets.forEach(ticket => {
    ticket.addEventListener('click', () => {
        ticket.classList.toggle('active');
    });
});


const swiper = new Swiper(".home-slider", {
    loop:true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

/* Popups for Register */
const openPopupBtn = document.querySelectorAll('[data-popup-target]');
const closePopupBtn = document.querySelectorAll('[data-popup-close]');
const overlay = document.getElementById('popup_overlay');

openPopupBtn.forEach(input => {
    console.log(input);
    input.addEventListener('click', () => {
        const messages = document.querySelector(input.dataset.popupTarget);
        openPopup(messages);
    });
});

closePopupBtn.forEach(input => {
    input.addEventListener('click', () => {
        const messages = input.closest('.messages');
        closePopup(messages);
    });
});

function openPopup(messages) {
    if (messages == null) return;
    messages.classList.add('active');
    overlay.classList.add('active');
}

function closePopup(messages) {
    if (messages == null) return;
    messages.classList.remove('active');
    overlay.classList.remove('active');
}
// Menu
const menu_pop = document.querySelector('#menu-bars');
const navbar = document.querySelector('.header .navbar');

console.log(menu_pop);

menu_pop.addEventListener('click', () => {
    console.log('click');
    menu_pop.classList.toggle('fa-times');
    navbar.classList.toggle('active');
});


// Faqs
const faqs = document.querySelectorAll('.faq');

faqs.forEach(faq => {
    faq.addEventListener('click', () => {
        faq.classList.toggle('active');
    });
});



// Ticket
const tickets = document.querySelectorAll('.ticket');

tickets.forEach(ticket => {
    ticket.addEventListener('click', () => {
        ticket.classList.toggle('active');
    });
});


// User
const users = document.querySelectorAll('.user');

users.forEach(user => {
    user.addEventListener('click', () => {
        user.classList.toggle('active');
    });
});


// Swiper
const swiper = new Swiper(".home-slider", {
    loop:true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });


// uploaded image
let input_img = document.getElementById('file-image');
let img_name = document.getElementById('file-image-name');

input_img.addEventListener('change', () => {
    let inputImage = document.querySelector('input[type=file]').files[0];
    img_name.innerText = inputImage.name;
});



// uploaded files
document.getElementById('files').addEventListener('change', handleFileSelect);

function handleFileSelect(event) {
  let files = event.target.files;
  let fileList = document.getElementById('file-list');

  fileList.innerHTML = ''; // Clear existing file list

  for (const i = 0; i < files.length; i++) {
    let listItem = document.createElement('li');
    listItem.textContent = files[i].name;
    fileList.appendChild(listItem);
  }
}

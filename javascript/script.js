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
})

function toggleOptions() {
    var customMessageTextarea = document.getElementById("message");
    var predefinedAnswersSelect = document.getElementById("faq-answers");
    var faqAnswerInput = document.querySelector('input[name="faq_answer"]');

    if (customMessageTextarea.style.display === "none") {
      customMessageTextarea.style.display = "block";
      predefinedAnswersSelect.style.display = "none";
      faqAnswerInput.value = ""; // Clear the value if switching to custom message
    } else {
      customMessageTextarea.style.display = "none";
      predefinedAnswersSelect.style.display = "block";
      faqAnswerInput.value = predefinedAnswersSelect.value; // Set the selected option value as the input value
    }
  }

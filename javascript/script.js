// Menu
const menu_pop = document.querySelector('#menu-bars');
const navbar = document.querySelector('.header .navbar');

if (menu_pop != null) {
    menu_pop.addEventListener('click', () => {
        console.log('click');
        menu_pop.classList.toggle('fa-times');
        navbar.classList.toggle('active');
    });
}


// Faqs
const faqs = document.querySelectorAll('.faq');
if (faqs != null) {
    faqs.forEach(faq => {
        faq.addEventListener('click', () => {
            faq.classList.toggle('active');
        });
    });
}


// Ticket
const tickets = document.querySelectorAll('.ticket');

if (tickets != null) {
    tickets.forEach(ticket => {
        ticket.addEventListener('click', () => {
            ticket.classList.toggle('active');
        });
    });
}

// User
const users = document.querySelectorAll('.user');

if (users != null) {

    users.forEach(user => {
        user.addEventListener('click', () => {
            user.classList.toggle('active');
        });
    });
}

// Swiper
const swiper = new Swiper(".home-slider", {
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

// Mota FAQ
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



// uploaded image
let input_img = document.getElementById('file-image');
let img_name = document.getElementById('file-image-name');

if (input_img != null) {

    input_img.addEventListener('change', () => {
        let inputImage = document.querySelector('input[id=file-image]').files[0];
        img_name.innerText = inputImage.name;
    });

}
// uploaded files

let uploaded_files = document.getElementById('up_files');
if (uploaded_files != null) {
    uploaded_files.addEventListener('change', handleFileSelect);
}

function handleFileSelect(event) {
    let files = event.target.files;
    let fileList = document.getElementById('file-list');

    fileList.innerHTML = ''; // Clear existing file list

    for (let i = 0; i < files.length; i++) {
        let listItem = document.createElement('li');
        listItem.textContent = files[i].name;
        fileList.appendChild(listItem);
    }
}


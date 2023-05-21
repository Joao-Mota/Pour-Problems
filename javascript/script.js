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



/* Sorting tables class="table-sortable" - table to sort/ column to sort / bool for asc or desc */
function sortTableByColumn(table, column, asc = true){
    const dirModifier = asc ? 1 : -1;
    const tBody = table.tBodies[0];
    const rows = Array.from(tBody.querySelectorAll("tr"));

    // Sort each row
    const sortedRows = rows.sort((a, b) => {
        const colum = column + 1;
        const aColText = a.querySelector('td:nth-child('+ colum +')').textContent.trim();
        const bColText = b.querySelector('td:nth-child('+ colum +')').textContent.trim();

        return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
    });

    // Remove all existing tr from the table
    while(tBody.firstChild){
        tBody.removeChild(tBody.firstChild);
    }

    // Re-add the newly sorted rows
    tBody.append(...sortedRows);

    // Remember how the column is sorted
    table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
    table.querySelector("th:nth-child("+ (column + 1) +")").classList.toggle("th-sort-asc", asc);
    table.querySelector("th:nth-child("+ (column + 1) +")").classList.toggle("th-sort-desc", !asc);
}

document.querySelectorAll(".table-sortable th").forEach(headerCell => {

    headerCell.addEventListener("click", () => {

        const tableElement = headerCell.parentElement.parentElement.parentElement;
        const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
        const currentIsAscending = headerCell.classList.contains("th-sort-asc");

        sortTableByColumn(tableElement, headerIndex, !currentIsAscending);

    });

});
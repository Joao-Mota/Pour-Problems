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

/* Popups for Register */
const openPopupBtn = document.querySelectorAll('[data-popup-target]');
const closePopupBtn = document.querySelectorAll('[data-popup-close]');
const overlay = document.getElementById('popup_overlay');

openPopupBtn.forEach(input => {
    // input.addEventListener('click', (e) => {
    //     const messages = document.querySelector(input.dataset.popupTarget);
    //     openPopup(messages);
    //     e.preventDefault();
    // });
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

// function make_chat_dialog_box(user_id)
// {
//   var modal_content = '<div id="user_dialog_'+user_id+'" class="user_dialog" title="Chat">';
//   modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+user_id+'" id="chat_history_'+user_id+'">';
//   modal_content += '</div>';
//   modal_content += '<div class="form-group">';
//   modal_content += '<textarea name="chat_message_'+user_id+'" id="chat_message_'+user_id+'" class="form-control"></textarea>';
//   modal_content += '</div><div class="form-group" align="right">';
//   modal_content+= '<button type="button" name="send_message" id="'+user_id+'" class="btn btn-info send_chat">Send Message</button></div></div>';
//   $('#chat').html(modal_content);
// }

function make_chat_dialog_box(ticket_id, client_id, datetime, id)
{
  var modal_content = '<section class="ticket-form">';
  modal_content += '<form method="post" class="signup-form">';
  modal_content += '<div class="input-box"><span> Message: </span><textarea name="message" id="message" cols="60" rows="8"></textarea></div>';
  modal_content += '<button type="button" id=chat_history_"'+client_id+'" data-ticket_id="'+ticket_id+'" data-client_id="'+client_id+'" data-datetime="'+datetime+'" data-id="'+id+'" name="send_message" class="send_message">Send Message</button>';
  modal_content += '</form>';
  modal_content += '</section>';

  $('#chat').html(modal_content);
}

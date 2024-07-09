let loginModal = document.getElementById("loginModal");
let signupModal = document.getElementById("signupModal");
// for opening login modal 
function openLoginModal(){
    loginModal.style.display = 'block';
}
// for closing login modal
function closeLoginModal(){
    loginModal.style.display = 'none';
}

// to open signup modal 
function openSignupModal(){
    signupModal.style.display = 'block';
}

// to  close signup modal 
function closeSignupModal(){
    signupModal.style.display = 'none';
}



const products = document.getElementById("products");
const allProducts = ["Laptops", "Mobile Phones", "Smart Watches"];
let arrayIndex = 0;
let charIndex = 0;
let typingDelay = 150;
let erasingDelay = 100;
let newTextDelay = 2000
function type(){
    if (charIndex < allProducts[arrayIndex].length){
        products.textContent += allProducts[arrayIndex].charAt(charIndex);
        charIndex++;
        setTimeout(type, typingDelay);
    }
    else{
        setTimeout(erase, newTextDelay);
    }
}

function erase(){
    if(charIndex > 0){
        products.textContent = allProducts[arrayIndex].substring(0, charIndex - 1);
        charIndex--;
        setTimeout(erase, erasingDelay);
    }
    else{
        arrayIndex = (arrayIndex + 1) % allProducts.length;
        setTimeout(type, typingDelay)
    }
}

document.addEventListener("DOMContentLoaded", () => {
    setTimeout(type, newTextDelay);
});

// to diplay the go to top button if user scrolls downward 
document.addEventListener("DOMContentLoaded", function() {
    var hiddenDiv = document.getElementById('goToTop');
    var topSection = document.getElementById('top');

    // Function to check if an element is in viewport
    function isInViewport(elem) {
        var bounding = elem.getBoundingClientRect();
        return (
            bounding.top >= 0 &&
            bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight)
        );
    }

    // Function to handle scroll event
    function handleScroll() {
        if (isInViewport(topSection)) {
            hiddenDiv.style.display = 'none';
        } else {
            hiddenDiv.style.display = 'block';
        }
    }

    handleScroll();

    window.addEventListener('scroll', handleScroll);
});

// to open feedbback form 
let feedbackForm = document.getElementById("feedbackForm");
function openFeedbackForm(){
    feedbackForm.style.display = "block";
    feedbackForm.style.width = "22rem";
}
function closeFeedbackForm(){
    feedbackForm.style.display = "none";
}

// script for rating section 
document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
      star.addEventListener('click', () => {
        const rating = star.getAttribute('data-value');
        setRating(rating);
      });
    });
  });
  
  function setRating(rating) {
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
      if (parseInt(star.getAttribute('data-value')) <= rating) {
        star.classList.add('selected');
      } else {
        star.classList.remove('selected');
      }
    });
  
    // Display the rating value (you can customize this part)
    const ratingText = document.querySelector('.rating-text');
    ratingText.textContent = `You rated us ${rating} out of 5`;
  }
  
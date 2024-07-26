document.addEventListener("DOMContentLoaded", () => {
    let loginModal = document.getElementById("loginModal");
    let signupModal = document.getElementById("signupModal");
    let feedbackForm = document.getElementById("feedbackForm");
    let myCart = document.getElementById("myCart");
    let products = document.getElementById("products");
    let allProducts = ["Laptops", "Mobile Phones", "Smart Watches"];
    let arrayIndex = 0;
    let charIndex = 0;
    let typingDelay = 150;
    let erasingDelay = 100;
    let newTextDelay = 2000;
    let hiddenDiv = document.getElementById('goToTop');
    let topSection = document.getElementById('top');

    function openLoginModal(){
        loginModal.style.display = 'block';
        signupModal.style.display = 'none';
    }

    function closeLoginModal(){
        loginModal.style.display = 'none';
    }

    function openSignupModal(){
        signupModal.style.display = 'block';
        loginModal.style.display = 'none';
    }

    function closeSignupModal(){
        signupModal.style.display = 'none';
    }

    function togglePassword() {
        let passwordInput = document.getElementById("password");
        let cPasswordInput = document.getElementById("cPassword");
        let showPasswordCheckbox = document.getElementById("showPasswordCheckbox");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            cPasswordInput.type = "text";
            showPasswordCheckbox.checked = true;
        } else {
            passwordInput.type = "password";
            cPasswordInput.type = "password";
            showPasswordCheckbox.checked = false;
        }
    }

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
            setTimeout(type, typingDelay);
        }
    }

    setTimeout(type, newTextDelay);

    function isInViewport(elem) {
        var bounding = elem.getBoundingClientRect();
        return (
            bounding.top >= 0 &&
            bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight)
        );
    }

    function handleScroll() {
        if (isInViewport(topSection)) {
            hiddenDiv.style.display = 'none';
        } else {
            hiddenDiv.style.display = 'block';
        }
    }

    handleScroll();
    window.addEventListener('scroll', handleScroll);

    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    function openFeedbackForm(){
        feedbackForm.style.display = "block";
        feedbackForm.style.width = "22rem";
    }

    function closeFeedbackForm(){
        feedbackForm.style.display = "none";
    }

    function openMyCart(){
        myCart.style.display = "block";
    }

    function closeMyCart(){
        myCart.style.display = "none";
    }

    document.addEventListener('click', function(event) {
        var dropdownContent = document.getElementById("droppedDownContent");
        var userDropdown = document.querySelector('.userDropdown');
        
        if (dropdownContent && !userDropdown.contains(event.target)) {
            dropdownContent.style.display = "none";
        }
    });

    function toggleDropdown(event) {
        event.stopPropagation(); // Prevent the document click listener from immediately hiding the dropdown
        var dropdownContent = document.getElementById("droppedDownContent");
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    }

    function showPassword(){
        let passwordInput = document.getElementById("password");
        let checkbox = document.getElementById("checkboxInput");
        checkbox.checked = !checkbox.checked;

        if(passwordInput.type == "password"){
            passwordInput.type = "text";
        }
        else{
            passwordInput.type = "password";
        }
    }

    function showPassword1(){
        let passwordInput = document.getElementById("loginPassword");
        let checkbox = document.getElementById("checkbox");

        checkbox.checked = !checkbox.checked;

        if(passwordInput.type == "password"){
            passwordInput.type = "text";
        }
        else{
            passwordInput.type = "password";
        }
    }

    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = star.getAttribute('data-value');
            setRating(rating);
        });
    });

    function setRating(rating) {
        stars.forEach(star => {
            if (parseInt(star.getAttribute('data-value')) <= rating) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });

        const ratingText = document.querySelector('.rating-text');
        ratingText.textContent = `You rated us ${rating} out of 5`;
    }
});

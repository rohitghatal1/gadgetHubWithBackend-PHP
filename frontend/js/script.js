
document.addEventListener("DOMContentLoaded", () => {
    let products = document.getElementById("products");
    let allProducts = ["Laptops", "Mobile Phones", "Smart Watches"];
    let arrayIndex = 0;
    let charIndex = 0;
    let typingDelay = 150;
    let erasingDelay = 100;
    let newTextDelay = 2000;
    let hiddenDiv = document.getElementById('goToTop');
    let topSection = document.getElementById('top');

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


    document.addEventListener('click', function(event) {
        var dropdownContent = document.getElementById("droppedDownContent");
        var userDropdown = document.querySelector('.userDropdown');
        
        if (dropdownContent && !userDropdown.contains(event.target)) {
            dropdownContent.style.display = "none";
        }
    });

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

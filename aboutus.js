$(document).ready(function () {
    const $backToTopButton = $('#backToTopButton');

   
    $backToTopButton.text('⬆️ Back to Top'); 
    console.log($backToTopButton.text()); 

    
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 200) {
            
            $backToTopButton.fadeIn();
        } else {
            $backToTopButton.fadeOut();
        }
    });

    
    $backToTopButton.on('click', function () {
        $('html, body').animate({ scrollTop: 0 }, 800, function () {
            alert('U kthyet në fillim të faqes!'); 
        });
    });

   
    $backToTopButton.hover(
        function () {
            $(this).css('background-color', 'pink'); 
        },
        function () {
            $(this).css('background-color', '#d70768'); 
        }
    );
});

$(document).ready(function () {
    const canvas = document.getElementById('aboutCanvas');
    const ctx = canvas.getContext('2d');

    let x = 0; 
    const y = canvas.height / 2; 

    
    function animateText() {
        ctx.clearRect(0, 0, canvas.width, canvas.height); 

      
        const gradient = ctx.createLinearGradient(0, 0, canvas.width, 0);
        gradient.addColorStop(0, '#ffb2d6'); 
        gradient.addColorStop(1, '#d70768'); 

    
        ctx.font = '30px Georgia, Cursive';
        ctx.fillStyle = gradient; 
        ctx.textAlign = 'center';
        ctx.shadowColor = '#d70768'; 
        ctx.shadowBlur = 10;

        
        ctx.fillText('Aromé', x, y);

        x += 1.5; 
       
        if (x > canvas.width + 50) {
            x = -50; 
        }

        requestAnimationFrame(animateText); 
    }

    animateText(); 
});


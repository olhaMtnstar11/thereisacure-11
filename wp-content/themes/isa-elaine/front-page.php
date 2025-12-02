<?php get_header(); ?>


<div class="scroll-container">
<?php
get_template_part('template-parts/home/content', 'hero');

//get_template_part('template-parts/home/content', 'partners2');

get_template_part('template-parts/home/content', 'map');
		get_template_part('template-parts/home/content', 'childhood-dementia');

	get_template_part('template-parts/home/content', 'story');
	
	
	
	get_template_part('template-parts/home/content', 'line');
	
	get_template_part('template-parts/home/content', 'navigation-section');
	
	
// get_template_part('template-parts/home/content', 'goal');
	

	get_template_part('template-parts/home/content', 'partners');



	
	
	
//get_template_part('template-parts/home/content', 'news');

//get_template_part('template-parts/home/content', 'mission');






//get_template_part('template-parts/home/content', 'science');


//get_template_part('template-parts/home/content', 'faq');
//get_template_part('template-parts/home/content', 'key-points');
//get_template_part('template-parts/home/content', 'board');

get_template_part('template-parts/home/content', 'poem');




get_template_part('template-parts/home/content', 'two-cols');

?>
    <div class="scroll-section">
        <?php get_footer();?>
    </div>




</div>


<!-- Vertical Pager -->
<div class="scroll-pager">
    <button data-target="0"></button>
    <button data-target="1"></button>
    <button data-target="2"></button>

    <button data-target="3"></button>
    <button data-target="4"></button>
    <button data-target="5"></button>
    <button data-target="6"></button>
    <button data-target="7"></button>
    <button data-target="8"></button>
    <button data-target="9"></button>
    <button data-target="10"></button>

    <button data-target="11"></button>
    <button data-target="12"></button>
    <button data-target="13"></button>
</div>



<style>
    .scroll-pager {
        position: fixed;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 10px;
        z-index: 100;
    }

    .scroll-pager button {
        width: 12px;
        height: 12px;
        background: #ccc;
        border: none;
        border-radius: 1px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .scroll-pager button.active {
        background: #0867E8; /* active color */
    }
    /* Desktop only */
    @media screen and (min-width: 1025px) {
        /* Hide scroll container scrollbar */
        .scroll-container {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE 10+ */
        }
        .scroll-container::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Edge */
        }
    }




    @media (max-width: 966px) {
        .scroll-pager {
            display: none;
        }
    }





</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.querySelector('.scroll-container');
        const sections = document.querySelectorAll('.scroll-section');
        const pagerButtons = document.querySelectorAll('.scroll-pager button');

        // Highlight active section on scroll
        container.addEventListener('scroll', () => {
            const scrollTop = container.scrollTop;
            sections.forEach((sec, i) => {
                const offset = sec.offsetTop;
                if (scrollTop >= offset - window.innerHeight / 2 && scrollTop < offset + window.innerHeight / 2) {
                    pagerButtons.forEach((btn) => btn.classList.remove('active'));
                    pagerButtons[i].classList.add('active');
                }
            });
        });

        // Jump to section on button click
        pagerButtons.forEach((btn, i) => {
            btn.addEventListener('click', () => {
                container.scrollTo({
                    top: sections[i].offsetTop,
                    behavior: 'smooth',
                });
            });
        });
    });

</script>
<?php if (isset($banner_images) && !empty($banner_images)) { ?>
<div class="container mx-auto px-4 pt-3">
    <div class="grid grid-cols-1 md:grid-cols-7 gap-4 mt-4">
        <div class="md:col-span-4 rounded-lg shadow-xl overflow-hidden relative" style="height: 350px;">
            <div id="image-carousel" class="relative w-full h-full">
                <?php foreach ($banner_images as $key => $banner_img): ?>
                    <img class="carousel-item w-full h-full object-cover absolute top-0 left-0 transition-opacity duration-3000 ease-in-out <?php echo $key === 0 ? 'opacity-100' : 'opacity-0'; ?>" src="<?php echo base_url($banner_img->dir_path . $banner_img->img_name); ?>" alt="Banner <?php echo $key+1; ?>">
                <?php endforeach; ?>
            </div>
        </div>

        <div class="md:col-span-3">
            <div class="bg-white rounded-lg shadow-xl overflow-hidden flex flex-col h-full">
                <div class="bg-indigo-700 text-white text-center font-bold p-4">
                    <h4 class="m-0">NOTICE BOARD</h4>
                </div>
                <div class="p-3 overflow-y-hidden relative flex-grow" style="height: 350px;">
                    <div id="notices-list-container" class="h-full relative overflow-hidden">
                        <ul id="notice-list" class="list-none m-0 p-0 absolute top-0 left-0 w-full" style="transform: translateY(0);">
                            <?php
                            if (!empty($banner_notices)) {
                                foreach ($banner_notices as $notice) {
                                    $date_string = date('d-m-Y', strtotime($notice['date']));
                                    $title = $notice['title'];
                                    $notice_url = isset($notice['url']) ? $notice['url'] : '#';
                                    $is_new = (strtotime($notice['date']) > strtotime('-7 days')) ? true : false;
                            ?>
                                    <li class="py-2 border-b border-gray-200 last:border-b-0">
                                        <div class="flex justify-between items-center mb-1">
                                            <div class="text-sm text-gray-500"><?php echo $date_string; ?></div>
                                            <?php if ($is_new) { ?>
                                                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">NEW</span>
                                            <?php } ?>
                                        </div>
                                        <a href="<?php echo $notice_url; ?>" class="text-blue-600 font-medium hover:text-blue-800 transition-colors duration-300 text-base">
                                            <?php echo $title; ?>
                                        </a>
                                    </li>
                            <?php }
                            } else { ?>
                                <li class="text-center text-gray-500 py-4">No news available.</li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="p-4 text-center">
                    <a href="<?php echo base_url('news'); ?>" class="bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg hover:bg-indigo-800 transition-colors duration-300">VIEW ALL</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-8">
        <div class="flex justify-center">
            <a href="https://aparnapublicschool.in/site/userlogin" class="flex flex-col items-center justify-center p-4 bg-gradient-to-b from-red-500 to-red-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 w-full h-full text-center">
                <span class="bg-white rounded-full p-3 mb-2">
                    <i class="fa fa-bell text-red-500 text-2xl"></i>
                </span>
                <div>Online Fee</div>
            </a>
        </div>
        <div class="flex justify-center">
            <a href="https://aparnapublicschool.in/page/syllabus" class="flex flex-col items-center justify-center p-4 bg-gradient-to-b from-yellow-400 to-yellow-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 w-full h-full text-center">
                <span class="bg-white rounded-full p-3 mb-2">
                    <i class="fa fa-book text-yellow-500 text-2xl"></i>
                </span>
                <div>Curriculum</div>
            </a>
        </div>
        <div class="flex justify-center">
            <a href="https://aparnapublicschool.in/examresult" class="flex flex-col items-center justify-center p-4 bg-gradient-to-b from-green-500 to-green-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 w-full h-full text-center">
                <span class="bg-white rounded-full p-3 mb-2">
                    <i class="fa fa-list-alt text-green-500 text-2xl"></i>
                </span>
                <div>Results</div>
            </a>
        </div>
        <div class="flex justify-center">
            <a href="#" class="flex flex-col items-center justify-center p-4 bg-gradient-to-b from-blue-500 to-blue-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 w-full h-full text-center">
                <span class="bg-white rounded-full p-3 mb-2">
                    <i class="fa fa-tv text-blue-500 text-2xl"></i>
                </span>
                <div>Smart Class</div>
            </a>
        </div>
        <div class="flex justify-center">
            <a href="https://aparnapublicschool.in/online_admission" class="flex flex-col items-center justify-center p-4 bg-gradient-to-b from-gray-500 to-gray-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 w-full h-full text-center">
                <span class="bg-white rounded-full p-3 mb-2">
                    <i class="fa fa-file-text text-gray-500 text-2xl"></i>
                </span>
                <div>Online Admissin</div>
            </a>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden flex flex-col">
            <div class="card-header text-white text-center font-bold p-4 bg-blue-600">
                <h5 class="m-0">ABOUT OUR SCHOOL</h5>
            </div>
            <div class="p-4 flex-grow">
                <img src="https://aparnapublicschool.in/uploads/gallery/media/1755060263-1377132877689c1827c53d8!school%20building.jpg?1755060482" alt="School Building" class="w-full h-48 object-cover rounded-md mb-4">
                <p id="school-message-short">
                    Aparna Public School was established in 2016 with the mission of providing the best education to the pupils of the colliery belt in association with Aparna Sachin Education Institute. The school offers education from Nursery to Class XII (Senior Secondary) and is affiliated with the Central Board of Secondary Education (CBSE).
                </p>
                <p class="hidden" id="school-message-full">
                    Set amidst an exuberant and lush green environment spanning 3 acres, it is conveniently located near the Dhanbad-Govindpur Road highway.
                    At Aparna Public School, we provide contemporary and progressive schooling with an unwavering commitment to high-quality education. Equipped with state-of-the-art facilities, the school aims to nurture students into ambassadors of positive change, empowering them to contribute towards building a better future. With a well-balanced blend of curricular and co-curricular activities, along with community service, the teaching-learning process is enriched, ensuring holistic development.
                </p>
                <div class="text-right mt-4">
                    <button id="school-read-more-btn" class="btn-link text-blue-600 font-bold hover:text-blue-800 transition-colors duration-300">Read More</button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden flex flex-col">
            <div class="bg-green-500 text-white text-center font-bold p-4">
                <h5 class="m-0">CHAIRMAN'S MESSAGE</h5>
            </div>
            <div class="p-4 flex-grow">
                <img src="https://aparnapublicschool.in/uploads/gallery/media/1755060356-924961283689c18844483f!chairman.jpg?1755060736" alt="Chairman" class="w-full h-48 object-cover rounded-md mb-4">
                <p id="chairman-message-short">
                    "Education is the most powerful weapon which you can use to change the world." - Nelson Mandela
                </p>
                <p class="hidden" id="chairman-message-full">
                    It is my pleasure to welcome you to Aparna Public School. Our mission is to provide an enriching and supportive environment where every child can grow and reach their full potential.
                </p>
                <div class="text-right mt-4">
                    <button id="chairman-read-more-btn" class="btn-link text-blue-600 font-bold hover:text-blue-800 transition-colors duration-300">Read More</button>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-xl overflow-hidden flex flex-col">
            <div class="bg-yellow-500 text-white text-center font-bold p-4">
                <h5 class="m-0">Director's Message</h5>
            </div>
            <div class="p-4 flex-grow">
                <img src="https://aparnapublicschool.in/uploads/gallery/media/1755157704-1664442431689d94c85aad8!ks.jpeg?1755157914" alt="ASEI" class="w-full h-48 object-contain rounded-md mb-4 bg-white">
                <p id="asei-message-short">
                    Our school is dedicated to develop our students a better citizens who will empower the country with economic growth, reduction of poverty strengthening global standing through innovation and skilled workforce development during national progress.
                </p>
                <p class="hidden" id="asei-message-full">
                    Our school is dedicated to develop our students a better citizens who will empower the country with economic growth, reduction of poverty strengthening global standing through innovation and skilled workforce development during national progress.
                </p>
                <div class="text-right mt-4">
                    <button id="asei-read-more-btn" class="btn-link text-blue-600 font-bold hover:text-blue-800 transition-colors duration-300">Read More</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto mt-8 px-4">
    <div class="bg-white rounded-lg shadow-xl overflow-hidden p-6 text-center">
        <h3 class="text-2xl font-bold text-gray-800 uppercase">INSIDE SCHOOL</h3>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 text-center">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="card-header text-white text-center font-bold p-4 bg-gradient-to-r from-green-600 to-green-500">
                <h5 class="m-0">EVENTS</h5>
            </div>
            <div class="p-4">
                <div class="mb-4">
                    <a href="https://aparnapublicschool.in/page/bal-utsav-2023" class="font-semibold text-gray-800">
                        <img src="https://aparnapublicschool.in/uploads/gallery/media/1686820691-1828066767648ad7530ee79!DSC_3261.JPG?1686924439" alt="Bal Utsav" class="w-full h-48 object-cover rounded-md mb-4">
                        Bal Utsav
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="card-header text-white text-center font-bold p-4 bg-gradient-to-r from-emerald-500 to-emerald-400">
                <h5 class="m-0">ACHIEVEMENTS</h5>
            </div>
            <div class="p-4">
                <div class="mb-4">
                    <a href="https://aparnapublicschool.in/page/international-yoga-day-celebration" class="font-semibold text-gray-800">
                        <img src="https://aparnapublicschool.in/uploads/gallery/media/1718946997-128191011466750cb59dd82!WhatsApp%20Image%202024-06-21%20e.jpg?1718947126" alt="International Yoga Day" class="w-full h-48 object-cover rounded-md mb-4">
                        International Yoga Day
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="card-header text-white text-center font-bold p-4 bg-gradient-to-r from-teal-400 to-teal-300">
                <h5 class="m-0">SOCIAL AWARENESS</h5>
            </div>
            <div class="p-4">
                <div class="mb-4">
                    <a href="https://aparnapublicschool.in/page/earth-day" class="font-semibold text-gray-800">
                        <img src="https://aparnapublicschool.in/uploads/gallery/media/1745380109-14092089526808630d4ab90!3.jpeg?1745380190" alt="Earth Day" class="w-full h-48 object-cover rounded-md mb-4">
                        Earth Day
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 text-center">
        <a href="#" class="bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg hover:bg-indigo-800 transition-colors duration-300">READ MORE ...</a>
    </div>
</div>

<div class="container mx-auto mt-8 px-4">
    <div class="bg-white rounded-lg shadow-xl overflow-hidden p-6 text-center">
        <h3 class="text-2xl font-bold text-gray-800 uppercase">OUR MISSION, VISION & GOALS</h3>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 text-center">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden flex flex-col">
            <div class="card-header text-white text-center font-bold p-4 bg-purple-800">
                <h5 class="m-0 text-lg">OUR MISSION</h5>
            </div>
            <div class="p-4 flex-grow text-justify">
                <img src="https://aparnapublicschool.in/uploads/gallery/media/1755143631-259248963689d5dcff0f7c!mission.jpeg?1755143658" alt="Mission Image" class="w-full h-48 object-cover rounded-md mb-4">
                <div class="p-4 bg-purple-100 rounded-lg border-l-4 border-purple-500">
                    <p id="mission-message-short" class="text-gray-800 font-semibold leading-relaxed">
                        We aim to provide a safe and happy environment where every individual is recognized, valued, and supported, ensuring that diverse needs are acknowledged, accepted, and met.
                    </p>
                    <p class="hidden text-gray-800 font-semibold leading-relaxed" id="mission-message-full">
                        We aim to provide a safe and happy environment where every individual is recognized, valued, and supported, ensuring that diverse needs are acknowledged, accepted, and met. Additionally, we seek to empower each child to become independent, develop a sense of responsibility for themselves, and foster respect for others and their surroundings.
                    </p>
                </div>
                <div class="text-right mt-4">
                    <button id="mission-read-more-btn" class="btn-link text-blue-600 font-bold hover:text-blue-800 transition-colors duration-300">Read More</button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden flex flex-col">
            <div class="card-header text-white text-center font-bold p-4 bg-purple-600">
                <h5 class="m-0 text-lg">OUR VISION</h5>
            </div>
            <div class="p-4 flex-grow text-justify">
                <img src="https://aparnapublicschool.in/uploads/gallery/media/1755143724-1142760442689d5e2c3a52e!vision-1.jpg?1755143738" alt="Vision Image" class="w-full h-48 object-cover rounded-md mb-4">
                <div class="p-4 bg-purple-100 rounded-lg border-l-4 border-purple-500">
                    <p id="vision-message-short" class="text-gray-800 font-semibold leading-relaxed">
                        Our vision is for each child to develop a natural curiosity for learning, discover their interests, and grow in their love for knowledge.
                    </p>
                    <p class="hidden text-gray-800 font-semibold leading-relaxed" id="vision-message-full">
                        Our vision is for each child to develop a natural curiosity for learning, discover their interests, and grow in their love for knowledge. We also strive to build strong families through parental support, fellowship, and skills training.
                    </p>
                </div>
                <div class="text-right mt-4">
                    <button id="vision-read-more-btn" class="btn-link text-blue-600 font-bold hover:text-blue-800 transition-colors duration-300">Read More</button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden flex flex-col">
            <div class="card-header text-white text-center font-bold p-4 bg-purple-400">
                <h5 class="m-0 text-lg">OUR GOALS</h5>
            </div>
            <div class="p-4 flex-grow text-justify">
                <img src="https://aparnapublicschool.in/uploads/gallery/media/1755144161-471230886689d5fe188cd0!goal.jpeg?1755144175" alt="Goals Image" class="w-full h-48 object-cover rounded-md mb-4">
                <div class="p-4 bg-purple-100 rounded-lg border-l-4 border-purple-500">
                    <p id="goals-message-short" class="text-gray-800 font-semibold leading-relaxed">
                        Today, we all have equal access to information, and the power balance has shifted. Likewise, the speed at which we need to update our knowledge and skills has increased.
                    </p>
                    <p class="hidden text-gray-800 font-semibold leading-relaxed" id="goals-message-full">
                        Today, we all have equal access to information, and the power balance has shifted. Likewise, the speed at which we need to update our knowledge and skills has increased. Learning and growing together is an effective way to build strong relationships and foster a healthy, supportive atmosphere.
                    </p>
                </div>
                <div class="text-right mt-4">
                    <button id="goals-read-more-btn" class="btn-link text-blue-600 font-bold hover:text-blue-800 transition-colors duration-300">Read More</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto mt-8 px-4">
    <div class="bg-gradient-to-r from-blue-400 via-indigo-600 to-violet-500 rounded-lg shadow-xl overflow-hidden p-6 text-center">
        <h3 class="text-2xl font-bold text-white uppercase">HAPPY BIRTHDAY</h3>
    </div>
    <div class="relative overflow-hidden mt-4">
        <div id="birthday-carousel" class="flex transition-transform duration-500 ease-in-out">
            <div class="flex-none w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 p-2">
                <div class="bg-white rounded-lg shadow-md p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">12 Aug</p>
                    <img src="https://placehold.co/100x100/FFF/000?text=🎂" alt="Birthday" class="w-20 h-20 mx-auto rounded-full mb-2">
                    <h6 class="font-bold text-sm">YASHIKA PANDEY</h6>
                </div>
            </div>
            <div class="flex-none w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 p-2">
                <div class="bg-white rounded-lg shadow-md p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">12 Aug</p>
                    <img src="https://placehold.co/100x100/FFF/000?text=🎂" alt="Birthday" class="w-20 h-20 mx-auto rounded-full mb-2">
                    <h6 class="font-bold text-sm">ABHINAV ROY</h6>
                </div>
            </div>
            <div class="flex-none w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 p-2">
                <div class="bg-white rounded-lg shadow-md p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">12 Aug</p>
                    <img src="https://placehold.co/100x100/FFF/000?text=🎂" alt="Birthday" class="w-20 h-20 mx-auto rounded-full mb-2">
                    <h6 class="font-bold text-sm">TANAY SINGH</h6>
                </div>
            </div>
            <div class="flex-none w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 p-2">
                <div class="bg-white rounded-lg shadow-md p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">12 Aug</p>
                    <img src="https://placehold.co/100x100/FFF/000?text=🎂" alt="Birthday" class="w-20 h-20 mx-auto rounded-full mb-2">
                    <h6 class="font-bold text-sm">RANVEER SINGH</h6>
                </div>
            </div>
            <div class="flex-none w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 p-2">
                <div class="bg-white rounded-lg shadow-md p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">12 Aug</p>
                    <img src="https://placehold.co/100x100/FFF/000?text=🎂" alt="Birthday" class="w-20 h-20 mx-auto rounded-full mb-2">
                    <h6 class="font-bold text-sm">ADITYA RAJ</h6>
                </div>
            </div>
            <div class="flex-none w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 p-2">
                <div class="bg-white rounded-lg shadow-md p-4 text-center">
                    <p class="text-xs text-gray-500 mb-1">12 Aug</p>
                    <img src="https://placehold.co/100x100/FFF/000?text=🎂" alt="Birthday" class="w-20 h-20 mx-auto rounded-full mb-2">
                    <h6 class="font-bold text-sm">SHREYA GUPTA</h6>
                </div>
            </div>
        </div>
        <div class="absolute inset-y-0 left-0 flex items-center">
            <button id="birthday-prev" class="bg-gray-800 text-white p-2 rounded-full shadow-lg opacity-50 hover:opacity-100 transition-opacity">
                <i class="fa fa-chevron-left"></i>
            </button>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center">
            <button id="birthday-next" class="bg-gray-800 text-white p-2 rounded-full shadow-lg opacity-50 hover:opacity-100 transition-opacity">
                <i class="fa fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>
<?php } ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Slower Image Carousel
    const carouselItems = document.querySelectorAll('#image-carousel .carousel-item');
    let currentImageIndex = 0;

    function showNextImage() {
        if (carouselItems.length <= 1) return;
        carouselItems[currentImageIndex].classList.remove('opacity-100');
        carouselItems[currentImageIndex].classList.add('opacity-0');
        currentImageIndex = (currentImageIndex + 1) % carouselItems.length;
        carouselItems[currentImageIndex].classList.remove('opacity-0');
        carouselItems[currentImageIndex].classList.add('opacity-100');
    }

    if (carouselItems.length > 1) {
        setInterval(showNextImage, 5000);  
    }

    // 2. Reliable Marquee script for notices
    const noticesContainer = document.getElementById('notices-list-container');
    const noticeList = document.getElementById('notice-list');
    let marqueeInterval;

    if (noticesContainer && noticeList) {
        // Clone the list to create a seamless loop
        const clone = noticeList.cloneNode(true);
        noticeList.appendChild(clone);
        
        let position = 0;
        const scrollSpeed = 0.5; // Controls the speed (smaller number = slower scroll)

        function startMarquee() {
            pauseMarquee(); // Clear any existing interval before starting a new one
            marqueeInterval = setInterval(() => {
                position -= scrollSpeed;
                if (position <= -noticeList.scrollHeight / 2) {
                    position = 0; // Reset to the beginning of the first list
                }
                noticeList.style.transform = `translateY(${position}px)`;
            }, 20); // The smaller the number, the smoother the scroll
        }

        function pauseMarquee() {
            clearInterval(marqueeInterval);
        }

        // Start the marquee if the content overflows
        if (noticeList.scrollHeight > noticesContainer.clientHeight) {
            startMarquee();
        }

        // Pause/Resume on hover
        noticesContainer.addEventListener('mouseenter', pauseMarquee);
        noticesContainer.addEventListener('mouseleave', startMarquee);
    }

    // 3. Read More functionality
    const readMoreBtns = document.querySelectorAll('.btn-link');
    readMoreBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const fullMessageId = btn.id.replace('-read-more-btn', '-message-full');
            const shortMessageId = btn.id.replace('-read-more-btn', '-message-short');
            
            const fullMessage = document.getElementById(fullMessageId);
            const shortMessage = document.getElementById(shortMessageId);
            
            if (fullMessage && shortMessage) {
                fullMessage.classList.toggle('hidden');
                shortMessage.classList.toggle('hidden');
                btn.textContent = fullMessage.classList.contains('hidden') ? 'Read More' : 'Read Less';
            }
        });
    });

    // 4. Birthday carousel functionality
    const birthdayCarousel = document.getElementById('birthday-carousel');
    const prevBtn = document.getElementById('birthday-prev');
    const nextBtn = document.getElementById('birthday-next');

    if (birthdayCarousel && prevBtn && nextBtn) {
        nextBtn.addEventListener('click', () => {
            birthdayCarousel.scrollBy({ left: birthdayCarousel.firstElementChild.offsetWidth, behavior: 'smooth' });
        });

        prevBtn.addEventListener('click', () => {
            birthdayCarousel.scrollBy({ left: -birthdayCarousel.firstElementChild.offsetWidth, behavior: 'smooth' });
        });
    }
});
</script>
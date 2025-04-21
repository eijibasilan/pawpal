<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { h, ref, onMounted, onUnmounted } from 'vue';

defineOptions({
    layout: h(UserLayout),
});

const currentPage = ref(0);
const currentDeal = ref(0);

let autoSlideInterval;
let resumeTimeout;

const startAutoSlide = () => {
    clearInterval(autoSlideInterval);
    autoSlideInterval = setInterval(() => {
        nextDeal();
    }, 3000);  // Auto slides every 3 seconds
};

const handleIndicatorClick = (index: number) => {
    currentDeal.value = index;
    stopAutoSlide();
    resumeTimeout = setTimeout(() => {
        startAutoSlide();
    }, 8000);  // Resumes auto-slide after 8 seconds
};

onMounted(() => {
    startAutoSlide();  // Starts the auto-slide when component mounts
});

onUnmounted(() => {
    stopAutoSlide();  // Cleans up when component unmounts
});

const nextBrands = () => {
    currentPage.value = currentPage.value === 0 ? 1 : 0;
};

const prevBrands = () => {
    currentPage.value = currentPage.value === 0 ? 1 : 0;
};

const stopAutoSlide = () => {
    clearInterval(autoSlideInterval);
    clearTimeout(resumeTimeout);
};

const nextDeal = () => {
    currentDeal.value = (currentDeal.value + 1) % 5;
};

const prevDeal = () => {
    currentDeal.value = (currentDeal.value - 1 + 5) % 5;
    // Remove the stopAutoSlide and startAutoSlide calls
};
</script>

<!-- Wag galawin sa taas-->
<!-- HTML Here:-->

<template>
    <div class="page-wrapper">
        <div class="content-overlay">
            <!-- Main content -->
            <div class="hero-section">
                <div class="hero-image-container">
                    <img src="/images/cute-pets.jpg" alt="Cute pets" class="hero-image">
                </div>
                <h1 class="main-title">You & Your Pets Are Invited!</h1>
                <p class="subtitle">Get a chance to win exciting prizes!</p>
            </div>

            <!-- Deals Section -->
            <div class="deals-section">
                <div class="deals-slider">
                    <button class="slider-nav prev" @click="prevDeal">‹</button>
                    <div class="deals-container">
                        <!-- First slide -->
                        <div class="deal-slide" v-show="currentDeal === 0">
                            <div class="deal-content">
                                <div class="deal-image-container">
                                    <img src="/images/deals/calibra.jpg" alt="Calibra" class="deal-image">
                                </div>
                                <button class="shop-button">Shop CALIBRA®</button>
                            </div>
                        </div>
                        
                        <!-- Second slide -->
                        <div class="deal-slide" v-show="currentDeal === 1">
                            <div class="deal-content">
                                <div class="deal-image-container">
                                    <img src="/images/deals/royal.png" alt="Royal Canin" class="deal-image">
                                </div>
                                <button class="shop-button">Shop ROYAL CANIN®</button>
                            </div>
                        </div>
                        
                        <!-- Third slide -->
                        <div class="deal-slide" v-show="currentDeal === 2">
                            <div class="deal-content">
                                <div class="deal-image-container">
                                    <img src="/images/deals/farmina.jpg" alt="farmina" class="deal-image">
                                </div>
                                <button class="shop-button">Shop FARMINA®</button>
                            </div>
                        </div>
                        
                        <!-- Fourth slide -->
                        <div class="deal-slide" v-show="currentDeal === 3">
                            <div class="deal-content">
                                <div class="deal-image-container">
                                    <img src="/images/deals/gourmet.jpg" alt="gourmet" class="deal-image">
                                </div>
                                <button class="shop-button">Shop GOURMET®</button>
                            </div>
                        </div>
                        
                        <!-- Fifth slide -->
                        <div class="deal-slide" v-show="currentDeal === 4">
                            <div class="deal-content">
                                <div class="deal-image-container">
                                    <img src="/images/deals/spring.jpg" alt="spring" class="deal-image">
                                </div>
                                <button class="shop-button">Shop Special Offers®</button>
                            </div>
                        </div>
                    </div>
                    <button class="slider-nav next" @click="nextDeal">›</button>
                    
                    <div class="slide-indicators">
                        <button 
                            v-for="n in 5" 
                            :key="n"
                            :class="['indicator', { active: currentDeal === n - 1 }]"
                            @click="handleIndicatorClick(n - 1)"
                        ></button>
                    </div>
                </div>
            </div>

            <div class="services-section">
                <div class="service-card">
                    <span class="service-icon">🐾</span>
                    <h3>Pet Wellness & Grooming</h3>
                </div>
                <div class="service-card">
                    <span class="service-icon">🏠</span>
                    <h3>Pet Hotel & Boarding</h3>
                </div>
                <div class="service-card">
                    <span class="service-icon">🦴</span>
                    <h3>Pet Food & Accessories</h3>
                </div>
            </div>
            
            <div class="brands-section">
                <h2 class="brands-title">Featured Brands</h2>
                <div class="brands-container">
                    <button class="nav-button prev" @click="prevBrands">‹</button>
                    <div class="brands-grid">
                        <div class="brand-item" v-show="currentPage === 0">
                            <img src="/images/brands/bearing.png" alt="Bearing" />
                            <p>Bearing</p>
                        </div>
                        <div class="brand-item" v-show="currentPage === 0">
                            <img src="/images/brands/special.png" alt="Special" />
                            <p>Special Dog/Cat</p>
                        </div>
                        <div class="brand-item" v-show="currentPage === 0">
                            <img src="/images/brands/pedigree.png" alt="Pedigree" />
                            <p>Pedigree</p>
                        </div>
                        <div class="brand-item" v-show="currentPage === 0">
                            <img src="/images/brands/goodest.png" alt="Goodest" />
                            <p>Goodest</p>
                        </div>
                        <div class="brand-item" v-show="currentPage === 0">
                            <img src="/images/brands/whiskas.png" alt="Whiskas" />
                            <p>Whiskas</p>
                        </div>
                        <div class="brand-item" v-show="currentPage === 0">
                            <img src="/images/brands/royalcanin.png" alt="RoyalCanin" />
                            <p>Royal Canin</p>
                        </div>
                        <div class="brand-item" v-show="currentPage === 0">
                            <img src="/images/brands/monello.png" alt="Monello" />
                            <p>Monello</p>
                        </div>
                        <div class="brand-item" v-show="currentPage === 1">
                            <img src="/images/brands/maxwell.png" alt="Maxwell" />
                            <p>Maxwell</p>
                        </div>
                        <div class="brand-item" v-show="currentPage === 1">
                            <img src="/images/brands/snacky.png" alt="Snacky" />
                            <p>Snacky</p>
                        </div>
                        <div class="brand-item" v-show="currentPage === 1">
                            <img src="/images/brands/doggo.png" alt="Doggo" />
                            <p>Doggo</p>
                        </div>
                    </div>
                    <button class="nav-button next" @click="nextBrands">›</button>
                </div>
            </div>
            
            <!-- Keep only the footer section -->
            <!-- Inside the footer-section div, after footer-content div -->
            <div class="footer-section">
                <div class="footer-content">
                    <div class="footer-column">
                        <h3>Shopping with us</h3>
                        <ul>
                            <li><a href="/about-us" >About Us</a></li>
                            <li><a href="/prescription" >Prescription Regulations</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-column">
                        <h3>Help & support</h3>
                        <ul>
                            <li><a href="/help-centre">Help Centre</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                            <li><a href="/faq">FAQ</a></li>
                            <li><a href="/how-to-register-your-pet">How To Register Your Pet</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-column">
                        <h3>Educational</h3>
                        <ul>
                            <li><a href="/pet-care">Pet Care Hub</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-column">
                        <h3>Connect with us</h3>
                        <ul>
                            <li><a href="tel:01379640052"><i class="fas fa-phone"></i> 0929 494 4937</a></li>
                            <li><a href="https://www.facebook.com/PeppaPetsPH" target="_blank"><i class="fab fa-facebook"></i> Facebook</a></li>
                            <li><a href="https://instagram.com/peppapets" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Add this footer-bottom section -->
                <div class="footer-bottom">
                    <ul class="policy-links">
                        <li><a href="/terms-and-conditions">Terms & Conditions</a></li>
                        <li><a href="/terms-of-use">Terms of Website Use</a></li>
                        <li><a href="/cookie-policy">Cookie Policy</a></li>
                        <li><a href="/privacy-policy">Privacy Policy</a></li>
                        <li><a href="/vet-medicines">Registered Internet Retailer of Veterinary Medicines</a></li>
                        <li><a href="/secretary">Secretary of State</a></li>
                        <li><a href="/sitemap">Sitemap</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Remove unnecessary image containers */
.background-image,
.map-container,
.map-image {
    display: none;
}

/* Keep the content overlay with solid color */
.content-overlay {
    background-color: rgba(51, 153, 255, 0.8);
}

.page-wrapper {
    position: relative;
    min-height: 100vh;
    width: 100%;
    overflow: hidden;
}

.background-image {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    object-fit: cover;
    z-index: -1;
}

.content-overlay {
    position: relative;
    min-height: 100vh;
    width: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    padding: 2rem;
}

/* Remove these styles */
.decorative-elements,
.paw,
.bone {
    display: none;
}

/* Update overlay background */
.content-overlay {
    background-color: rgba(255, 255, 255, 0.9);
}

/* Adjust the content overlay */
.content-overlay {
    position: relative;
    min-height: 100vh;
    width: 100%;
    background-color: rgba(51, 153, 255, 0.8); /* Changed to semi-transparent blue */
    padding: 2rem;
    overflow: hidden;
}

/* For better contrast with blue background */
.main-title {
    color: #ffffff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

.subtitle {
    color: #ffffff;
}

.service-card, .contact-section, .hero-section {
    background-color: rgba(255, 255, 255, 0.95);
}

.logo-container {
    text-align: center;
    margin-bottom: 2rem;
}

.logo {
    max-width: 200px;
    height: auto;
}

.hero-image-container {
    width: 300px;
    height: 300px;
    margin: 0 auto 2rem;
    border-radius: 50%;
    overflow: hidden;
    border: 8px solid #4682b4;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.map-container {
    margin-top: 2rem;
    border-radius: 10px;
    overflow: hidden;
}

.map-image {
    width: 100%;
    max-width: 500px;
    height: auto;
}

.landing-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Arial', sans-serif;
}

.hero-section {
    text-align: center;
    padding: 4rem 0;
    background-color: #f0f8ff;
    border-radius: 15px;
    margin-bottom: 3rem;
}

.main-title {
    color: #ff8c00;
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.subtitle {
    color: #4682b4;
    font-size: 1.5rem;
}

.services-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.service-card {
    background-color: white;
    padding: 2rem;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.service-card:hover {
    transform: translateY(-5px);
}

.service-card i {
    font-size: 2.5rem;
    color: #4682b4;
    margin-bottom: 1rem;
}

.service-card h3 {
    color: #333;
    font-size: 1.2rem;
}

/* Remove these style blocks */
.contact-section {
    text-align: center;
    background-color: #f0f8ff;
    padding: 3rem;
    border-radius: 15px;
}

.contact-section h2 {
    color: #4682b4;
    margin-bottom: 1.5rem;
}

.phone {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 1rem;
}

.address, .social {
    color: #666;
    margin-bottom: 0.5rem;
}

.contact-title {
    color: #4682b4;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
}
</style>

<style scoped>
/* Update contact section styles */
.phone, .address, .social {
    font-weight: 700;
    color: #333;
    margin-bottom: 1rem;
}

.phone {
    font-size: 1.5rem;
}
</style>

<style scoped>
.service-icon {
    font-size: 2.8rem;
    display: block;
    margin-bottom: 1rem;
    color: #4682b4;
}

.service-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* Remove the old icon styles */
.service-card i {
    display: none;
}
</style>

<style scoped>
.contact-title {
    color: #4682b4;
    font-size: 2rem;    /* Reduced from 2.5rem */
    font-weight: 700;   /* Slightly reduced weight but still bold */
    margin-bottom: 1.5rem;
    text-transform: uppercase;
}
</style>

<style scoped>
.footer-section {
    background-color: #f5f5f5;
    padding: 3rem 2rem;
    margin-top: 3rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-column h3 {
    color: #333;
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.footer-column ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-column ul li {
    margin-bottom: 0.8rem;
}

.footer-column ul li a {
    color: #666;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-column ul li a:hover {
    color: #4682b4;
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .footer-content {
        grid-template-columns: 1fr;
    }
}
</style>

<style scoped>
.footer-bottom {
    border-top: 1px solid #ddd;
    margin-top: 2rem;
    padding-top: 2rem;
}

.policy-links {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1.5rem;
    list-style: none;
    padding: 0;
    margin: 0;
}

.policy-links li a {
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.policy-links li a:hover {
    color: #4682b4;
}

@media (max-width: 768px) {
    .policy-links {
        gap: 1rem;
        text-align: center;
    }
    
    .policy-links li {
        flex: 0 0 auto;
    }
}
</style>

<style scoped>
.brands-section {
    background-color: white;
    padding: 3rem 2rem;
    margin: 2rem 0;
    border-radius: 15px;
}

.brands-title {
    text-align: center;
    color: #333;
    font-size: 2rem;
    margin-bottom: 2rem;
}

.brands-container {
    position: relative;
    display: flex;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

.brands-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 2rem;
    padding: 0 3rem;
    transition: transform 0.3s ease;
}

.brand-item {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: opacity 0.3s ease;
}

.brand-item img {
    width: 150px;
    height: 80px;
    object-fit: contain;
    margin-bottom: 1rem;
    transition: transform 0.3s ease;
}

.brand-item:hover img {
    transform: scale(1.2); /* Adds zoom effect on hover */
}

@media (max-width: 768px) {
    .brand-item img {
        width: 130px;
        height: 70px;
    }
}

@media (max-width: 480px) {
    .brand-item img {
        width: 120px;
        height: 65px;
    }
}
.brand-item p {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
    font-weight: 500;
}

.nav-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(70, 130, 180, 0.1);
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 24px;
    color: #4682b4;
    cursor: pointer;
    transition: all 0.3s ease;
}

.nav-button:hover {
    background: rgba(70, 130, 180, 0.2);
}

.prev {
    left: 0;
}

.next {
    right: 0;
}

@media (max-width: 1024px) {
    .brands-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-width: 768px) {
    .brands-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 480px) {
    .brands-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

<style scoped>
.deals-section {
    padding: 0;
    margin: 2rem 0;
    border-radius: 15px;
    background: transparent;
}

.deals-slider {
    position: relative;
    max-width: 1400px;
    margin: 0 auto;
}

.deals-container {
    position: relative;
    width: 100%;
}

.deal-slide {
    width: 100%;
    padding: 0;
    background: transparent;
}

.deal-content {
    text-align: center;
}

.deal-image-container {
    max-width: 1200px;
    margin: 0 auto;
}

.deal-image {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.3);
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    font-size: 30px;
    color: white;
    cursor: pointer;
    z-index: 2;
}

.slider-nav:hover {
    background: rgba(0, 0, 0, 0.5);
}

.slider-nav.prev {
    left: 10px;
}

.slider-nav.next {
    right: 10px;
}

.slide-indicators {
    position: absolute;
    bottom: 80px;  /* Changed from 20px to move indicators up */
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    padding: 1rem 0;
    z-index: 5;
}

.indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    border: 2px solid white;  /* Added white border for better visibility */
    cursor: pointer;
    transition: all 0.3s ease;
}

.indicator.active {
    background: white;
    transform: scale(1.2);
}


.shop-button {
    background: #ffd700;
    color: #1b4332;
    border: none;
    padding: 1rem 2.5rem;
    border-radius: 25px;
    font-size: 1.2rem;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 3;
    background: linear-gradient(to right, #ffd700, #ffed4a);
    border: 2px solid #e6c200;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.shop-button:hover {
    background: linear-gradient(to right, #ffed4a, #ffd700);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    border-color: #ffd700;
}

.shop-button:active {
    transform: translateY(1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.deal-content {
    text-align: center;
    position: relative;
    z-index: 2;
}


</style>